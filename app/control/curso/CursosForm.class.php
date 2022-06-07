<?php

class CursosForm extends TWindow
{
    private $form;

    function __construct(){
        parent::__construct();
        $this->form = new BootstrapFormBuilder();

        $nome = new TEntry('nome');

        $this->form->addFields([new TLabel('Nome:')],[$nome]);

        $this->form->addAction('gravar', new TAction(array($this, 'onSave')), 'fa:check-circle-o green');

        parent::add($this->form);
    }

    function onSave(){
        
        try{

            TTransaction::open('sample');
            $data = $this->form->getData();

            $cursos = new Cursos();
            $cursos->nome = $data->nome;
            $cursos->store();

            new TMessage('info', "Curso {$cursos->nome} incluso com sucesso !!!");

            TTransaction::close();

        }catch(Exception $e){

            new TMessage('error', $e->getMessage());
        }
    }
}