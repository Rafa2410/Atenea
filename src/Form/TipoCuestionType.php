<?php

namespace App\Form;

use App\Entity\TipoCuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TipoCuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', TextType::class, ['label' => 'Descripcion del tipo'])
            ->add(
                'save',
                SubmitType::class,
                [
                    'label' => $options['label'],
                    'attr'  => [
                        'class' => 'btn waves-effect waves-light',
                    ],
                ]
            )->add(
                'cancel',
                SubmitType::class,
                [
                    'label' => 'Cancelar',
                    'attr'  => [
                        'class' => 'btn waves-effect waves-light red',
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => TipoCuestion::class,
            ]
        );
    }
}
