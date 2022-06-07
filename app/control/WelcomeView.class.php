<?php
/**
 * WelcomeView
 *
 * @version    1.0
 * @package    control
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class WelcomeView extends TPage
{
   private $form;

   function __construct(){
       parent::__construct();
       $this->form = new BootstrapFormBuilder();

       $nome = new TEntry('nome');

       $this->form->addFields([new TLabel('Nome:')], [$nome]);

       $this->form->addAction('mostrar nome', new TAction(array($this, 'onSave')), 'fa:check-circle-o green');

       parent::add($this->form);
   }

   function onMostrar(){
       $data = $this->form->getData();

       new TMessage('info', "A nome digitado é {$data->nome}");
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
