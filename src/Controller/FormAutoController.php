<?php

namespace App\Controller;

use App\Entity\AutoUtilitaria;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\AutoForm;

 
    class FormAutoController extends AbstractController{

        public function formAuto(Request $request){
    
        $id = 1;
        $tipologia = "berlina";
        $marca = "Audi";
        $modello ="Q7";
        $potenza = 7000;
        $prezzo = 70000;
        $peso = 4200;
        $cilindrata = 3500;
        $cx = 10;
        $porte = 5;


        $entity = new AutoUtilitaria($id, $tipologia, $marca, $modello, $potenza, $prezzo, $peso, $cilindrata, $cx, $porte); 
        
        $form = $this->createForm(AutoForm::class, $entity);
        $form->handleRequest($request);
        
        return $this->render('form-auto.html.twig', 
            [
            'form' => $form->createView(),
            ]
        );
    }
 
}

?>