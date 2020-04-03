<?php

namespace App\Entity;

use App\Entity\AbstractVeicolo;

abstract class AbstractAuto extends AbstractVeicolo{

    protected $porte;

    public function getPorte(){
        return $this->porte;
    } 

    public function setPorte($porte){
        $this->porte = $porte;
    } 

}