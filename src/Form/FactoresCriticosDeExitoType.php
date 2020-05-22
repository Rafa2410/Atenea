<?php

namespace App\Form;

use App\Entity\Aspecto;
use App\Entity\FactoresPotencialesDeExito;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FactoresCriticosDeExitoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha_alta', DateType::class, ['widget' => 'single_text'])
            ->add('fecha_baja', DateType::class, ['widget' => 'single_text'])
            ->add(
                'descripcion',
                TextareaType::class,
                [
                    'attr' => [
                        'placeholder' => 'Introduce una breve descripción',
                        'class'       => 'materialize-textarea',
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => FactoresPotencialesDeExito::class,
            ]
        );
    }
}
