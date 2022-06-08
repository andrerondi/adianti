<?php

class AlunosForm extends TPage{

    private $from;

    public function __construct(){
        parent::__construct();

        $this->form = new BootstrapFormBuilder('form_alunos');

        $nome = new TEntry('nome');
        $cursos = new TDBCombo('curso_id', 'sample', 'Cursos', 'id', 'nome');

        $this->form->addFields([new TLabel('Nome: ')], [$nome]);
        $this->form->addFields([new TLabel('Curso: ')], [$cursos]);

        $this->form->addAction('Save', new TAction(array($this, 'onSave')));

        parent::add($this->form);
    }

    public function onSave(){
        try {
            TTransaction::open('sample');
            $data = $this->form->getData('Alunos');
            $data->store();
            TTransaction::close();

        } catch (Exception $e) {
            new TMessage('error', $e->getMessage());
        }
    }
}