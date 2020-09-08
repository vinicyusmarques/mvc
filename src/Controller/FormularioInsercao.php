<?php

namespace Alura\Cursos\Controller;

class FormularioInsercao extends ControllerHtml implements InterfaceControllerRequisicao
{
    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('cursos/formulario.php',[
            'titulo' => 'Novo Curso'
        ]);
    }
}