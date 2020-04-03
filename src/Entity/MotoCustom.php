<?php

namespace App\Entity;

use App\Entity\Moto;
use App\Interfaces\ConsumiInterface;

class MotoCustom extends AbstractMoto implements ConsumiInterface {

    const TIPO = 'moto';

    public function __construct($id, $tipologia, $marca, $modello, $potenza, $prezzo, $peso, $cilindrata, $cx){
        $this->setId($id);
        $this->setTipo(self::TIPO);
        $this->setTipologia($tipologia);
        $this->setMarca($marca);
        $this->setModello($modello);
        $this->setPotenza($potenza);
        $this->setPrezzo($prezzo);
        $this->setPeso($peso);
        $this->setCilindrata($cilindrata);
        $this->setCx($cx);
        
        //echo "Sono nel costruttore di MotoCustom \n";
    }

    public function getCo2(){
        return floatval($this->getPeso() * $this->getCilindrata() * $this->getCx() * 1.5 / 1000);
    }
    public function getporte(){
        return "N/A";
    }
    public function print($column, $glue = '|'){
        $publicProperties = call_user_func('get_object_vars', $this);
        $output = [];

        foreach($column as $key){
            $va = isset($publicProperties[$key]) ? $publicProperties[$key] : '-';
            $output[] = $va;
        }

        return implode($glue, $output). $glue . $this->getCo2();
    }
}