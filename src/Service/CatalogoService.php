<?php
namespace App\Service;

use App\Interfaces\TipologiaInterface;
use App\Entity\AutoSuv;
use App\Entity\AutoUtilitaria;
use App\Entity\MotoCustom;

class CatalogoService {

    const SORT_BY_MARCA = 'marca';
    const SORT_BY_TIPOLOGIA = 'tipologia';
    const SORT_BY_PREZZO = 'prezzo';
    const SORT_BY_CO2 = 'co2';

    const SORT_ASC = 'asc';
    const SORT_DISC = 'disc';

    const FILTER_BY_MARCA = 'marca';
    const FILTER_BY_TIPOLOGIA = 'tipologia';
    const FILTER_BY_PREZZO = 'prezzo';

    private $catalogs;
    private $tabella_inquinamento;


    public function setTabellaInquinamento($tabella_inquinamento){
        $this->tabella_inquinamento = $tabella_inquinamento;
    }

    public function build($auto_items, $moto_items){
        
        $this->catalogs = [];

        $is_suv = FALSE;
        
        //costruisco catalogo auto
        $id = 1;
        for ($i=0; $i < $auto_items; $i++) { 

            $is_suv = rand(0,1);    //genero TRUE FALSE per creare casualmente suv o auto normali
            $tipologia = $this->getRandomTipologia('auto');
            $marca = $this->getRandomMarca('auto');
            $modello = $this->getRandomString(5);
            $potenza = rand(70, 200); 
            $prezzo = rand(15000, 50000);
            $peso = rand(1000, 3000); 
            $cilindrata = rand(1400, 3000);
            $cx = rand(3,8);
            $porte = rand(3,5);

            if($is_suv){
                $this->catalogs[] = new AutoSuv($id, $tipologia, $marca, $modello, $potenza, $prezzo, $peso, $cilindrata, $cx, $porte);
            }else{
                $this->catalogs[] = new AutoUtilitaria($id, $tipologia, $marca, $modello, $potenza, $prezzo, $peso, $cilindrata, $cx, $porte);
            }
            $id++;
        }

        //costruisco catalogo moto
        for ($i=0; $i < $moto_items; $i++) { 
            # code...
            $is_suv = rand(0,1);    //genero TRUE FALSE per creare casualmente suv o auto normali
            $tipologia = $this->getRandomTipologia('moto');
            $marca = $this->getRandomMarca('moto');
            $modello = $this->getRandomString(5);
            $potenza = rand(70, 200); 
            $prezzo = rand(10000, 20000);
            $peso = rand(800, 1500); 
            $cilindrata = rand(1400, 3000);
            $cx = rand(3,8);

            $this->catalogs[] = new MotoCustom($id, $tipologia, $marca, $modello, $potenza, $prezzo, $peso, $cilindrata, $cx);
            $id++;
        }
        return $this->catalogs;
    } 


    public function print($sort_by = NULL, $orientation = self::SORT_ASC, $filter = NULL, $value = '', $glue = '|'){

        if($filter && $value == NULL){
            return 'Wrong filter value!';
        }

        $list = [];

        //filtro la lista
        if($filter){
            $list = $this->filter($filter, $value);
        }else{
            $list = $this->catalogs;
        }

        //ordina la lista
        if($sort_by){
            $this->sort($list, $sort_by, $orientation);
        }
        return $list;
    }

    private function getGruppoInquinamento(\App\Interfaces\ConsumiInterface $item){
        $co2 = $item->getCo2();
        // $prezzo = $item->getPrezzo();
        foreach($this->tabella_inquinamento as $key => $limit){
            if($limit['da'] <= $co2 && $co2 < $limit['a']){
                return $key;
            }
        }
    }

    private function sort(&$items, $field, $orientation = self::SORT_ASC){
        $method = 'get'.ucfirst($field);

        usort($items, function ($item1, $item2) use ($method) {
            $reflectionMethod1 = new \ReflectionMethod(get_class ($item1), $method);
            $v1 = $reflectionMethod1->invoke($item1);

            $reflectionMethod2 = new \ReflectionMethod(get_class ($item2), $method);
            $v2 = $reflectionMethod2->invoke($item2);

            return $v1 <=> $v2;
        });

        if($orientation != self::SORT_ASC){
            $items = array_reverse($items);
        }
    }

    private function filter($field, $value){
        $filtered = [];
        $method = 'get'.ucfirst($field);

        foreach($this->catalogs as $item){
            $reflectionMethod = new \ReflectionMethod(get_class ($item), $method);
            $v = $reflectionMethod->invoke($item);

            if($v == $value){
                $filtered[] = $item;
            }
        }

        return $filtered;
    }

    private function getRandomTipologia($tipo = 'auto'){

        $tip_auto = [
            TipologiaInterface::AUTO_SUV,
            TipologiaInterface::AUTO_UTILITARIA,
            TipologiaInterface::AUTO_FUORISTRADA,
            TipologiaInterface::AUTO_BERLINA,
        ];

        $tip_moto = [
            TipologiaInterface::MOTO_CUSTOM,
            TipologiaInterface::MOTO_STRADA,
        ];

        $tip = ($tipo == 'auto') ? $tip_auto : $tip_moto;

        $case = rand(0,count($tip)-1);
        return $tip[$case];
    }

    private function getRandomMarca($tipo = 'auto'){
        $brand_auto = [
            'Mercedes',
            'Bmw',
            'Audi',
            'Renault',
            'Volkswagen',
            'Nissan',
        ];

        $brand_moto = [
            'Bmw',
            'Honda',
            'Harkey',
        ];

        $brand = ($tipo == 'auto') ? $brand_auto : $brand_moto;

        $case = rand(0,count($brand)-1);
        return $brand[$case];
    }

    private function getRandomString($len = 5){
        return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, rand(5,5+$len));
    }

}