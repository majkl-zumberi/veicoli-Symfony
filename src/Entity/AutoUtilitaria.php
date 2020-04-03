<?php

namespace App\Entity;

use App\Entity\Auto;
use App\Interfaces\ConsumiInterface;

class AutoUtilitaria extends AbstractAuto implements ConsumiInterface {

    const TIPO = 'auto';

    public function __construct($id, $tipologia, $marca, $modello, $potenza, $prezzo, $peso, $cilindrata, $cx, $porte){
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
        $this->setPorte($porte);
        //echo "Sono nel costruttore di AutoUtilitaria \n";
    }

    public function getCo2(){
        return floatval($this->getPeso() * $this->getCilindrata() * $this->getCx() / 1000);
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