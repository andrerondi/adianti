<?php

class Cursos extends TRecord{

    const TABLENAME = 'cursos';
    const PRIMARYKEY = 'id';
    const IDPOLICY = 'serial'; // max ou serial

    public function __construct($id = null){
        parent::__construct($id);

        parent::addAttribute('nome');
    }
}