<?php

namespace App\Form;

use App\Entity\TipoCuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TipoCuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('interno')*/
            ->add('descripcion')
            ->add('Nuevo', SubmitType::class)
            ->add('Editar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TipoCuestion::class,
        ]);
    }
}