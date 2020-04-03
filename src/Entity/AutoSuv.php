<?php

namespace App\Entity;

use App\Entity\AutoUtilitaria;

class AutoSuv extends AutoUtilitaria {

    public function getCo2(){
        return floatval($this->getPeso() * $this->getCilindrata() * $this->getCx() * 1.5 / 1000);
    }

}