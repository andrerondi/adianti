<?php

class AlunosList extends TPage {
    private $datagrid;
    private $loaded;

    public function __construct(){
        parent::__construct();

        $this->datagrid = new TQuickGrid();

        $this->datagrid->addQuickColumn('#', 'id', 'left', 30);
        $this->datagrid->addQuickColumn('Nome', 'nome', 'left', 150);

        $this->datagrid->createModel();

        parent::add($this->datagrid);
    }

    public function onReload($params){
        try {
            TTransaction::open('sample');

            $alunos = Alunos::getObjects();

            $this->datagrid->addItems($alunos);

            TTransaction::close();

        } catch (Exception $e) {
            new TMessage('error', $e->getMessage());
        }
    }

    public function show(){
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'], array('onReload', 'onSearch'))))){
            if (func_num_args() > 0){
                $this->onReload( func_get_arg(0) );
            }else{
                $this->onReload();
            }
        }
        parent::show();
    }
}