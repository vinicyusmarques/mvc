<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\Common\Persistence\ObjectRepository;

class RealizaLogin implements InterfaceControllerRequisicao
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ObjectRepository
     */
    private $repositoryUsuarios;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositoryUsuarios = $this->entityManager->getRepository(Usuario::class);
    }

    public function processaRequisicao(): void
    {
        $email = filter_input(
            INPUT_POST,
            'email',
            FILTER_VALIDATE_EMAIL
        );

        if(is_null($email) || $email === false){
            echo "E-mail inválido";
            exit();
        }

        $senha = filter_input(
        INPUT_POST,
        'senha',
        FILTER_SANITIZE_STRING
        );

        /**
         * @var Usuario $usuario
         */
        $usuario = $this->repositoryUsuarios->findOneBy(['email' => $email]);


        if(is_null($usuario) || !$usuario->senhaEstaCorreta($senha)){
            echo "E-mail ou senha inválido.";
            return;
        }

        header('Location: /listar-cursos');
    }
}