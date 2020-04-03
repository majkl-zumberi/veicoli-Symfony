<?php

namespace App\Entity;

abstract class AbstractVeicolo {

    protected $id;

    protected $tipo;

    protected $tipologia;

    protected $marca;

    protected $modello;

    protected $potenza;

    protected $prezzo;

    protected $peso;

    protected $cilindrata;

    protected $cx;

    public function getId(){
        return $this->id;
    } 

    public function setId($id){
        $this->id = $id;
    } 

    public function getTipo(){
        return $this->tipo;
    } 

    public function setTipo($tipo){
        $this->tipo = $tipo;
    } 

    public function getTipologia(){
        return $this->tipologia;
    } 

    public function setTipologia($tipologia){
        $this->tipologia = $tipologia;
    } 

    public function getMarca(){
        return $this->marca;
    } 

    public function setMarca($marca){
        $this->marca = $marca;
    } 

    public function getModello(){
        return $this->modello;
    } 

    public function setModello($modello){
        $this->modello = $modello;
    } 

    public function getPotenza(){
        return $this->potenza;
    } 

    public function setPotenza($potenza){
        $this->potenza = $potenza;
    } 

    public function getPrezzo(){
        return $this->prezzo;
    } 

    public function setPrezzo($prezzo){
        $this->prezzo = $prezzo;
    } 

    public function getPeso(){
        return $this->peso;
    } 

    public function setPeso($peso){
        $this->peso = $peso;
    } 

    public function getCilindrata(){
        return $this->cilindrata;
    } 

    public function setCilindrata($cilindrata){
        $this->cilindrata = $cilindrata;
    } 

    public function getCx(){
        return $this->cx;
    } 

    public function setCx($cx){
        $this->cx = $cx;
    } 

    public function print($column, $glue = '|'){
        $publicProperties = call_user_func('get_object_vars', $this);
        $output = [];

        foreach($column as $key){
            $va = isset($publicProperties[$key]) ? $publicProperties[$key] : '-';
            $output[] = $va;
        }

        return implode($glue, $output);
    }

}