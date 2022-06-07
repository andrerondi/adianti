<?php

class Alunos extends TRecord{

    const TABLENAME = 'alunos';
    const PRIMARYKEY = 'id';
    const IDPOLICY = 'serial';

    private $cursos;

    public function __construct($id = null){
        parent::__construct($id);

        parent::addAttribute('nome');
        parent::addAttribute('curso_id');
    }

    public function get_cursos(){
        
        if(empty($this->cursos))
            $this->cursos = new Cursos($this->curso_id);
            
        return $this->cursos;
    }
}