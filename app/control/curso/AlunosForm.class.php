<?php

class AlunosForm extends TPage{

    private $from;

    public function __construct(){
        parent::__construct();

        $this->form = new BootstrapFormBuilder();

        $nome = new TEntry('nome');
        $cursos = new TDBCombo('curso_id', 'sample', 'Cursos', 'id', 'nome');

        $this->form->addFields([new TLabel('Nome: ')], [$nome]);
        $this->form->addFields([new TLabel('Curso: ')], [$cursos]);

        parent::add($this->form);
    }
}