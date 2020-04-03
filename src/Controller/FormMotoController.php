<?php

namespace App\Controller;

use App\Entity\MotoCustom;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\MotoForm;

 
    class FormMotoController extends AbstractController{

        public function formMoto(Request $request){
    
        $id = 1;
        $tipologia = "Custom";
        $marca = "Harley";
        $modello ="modello ";
        $potenza = 55 ;
        $prezzo = 2000;
        $peso = 100;
        $cilindrata = 230;
        $cx = 46;


        $entity = new MotoCustom($id, $tipologia, $marca, $modello, $potenza, $prezzo, $peso, $cilindrata, $cx); 
        
        $form = $this->createForm(MotoForm::class, $entity);
        $form->handleRequest($request);
        
        return $this->render('form-moto.html.twig', 
            [
            'form' => $form->createView(),
            ]
        );
    }
 
}

?>