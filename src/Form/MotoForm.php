<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class MotoForm extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
        ->add('id', NumberType::class)
        ->add('tipo',TextType::class)
        ->add('tipologia',TextType::class)
        ->add('marca',TextType::class)
        ->add('modello',TextType::class)
        ->add('potenza',NumberType::class)
        ->add('prezzo',NumberType::class)
        ->add('peso',NumberType::class)
        ->add('cx',NumberType::class)
        ->add('save',SubmitType::class);
    }
}

?>