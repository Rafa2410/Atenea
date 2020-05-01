<?php

namespace App\Form;

use App\Entity\Cuestion;
use App\Entity\SubtipoCuestion;
use App\Form\SubtipoCuestionType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', TextType::class, ['label' => 'Descripcion de la cuestion'])
            ->add(
                'subtipo',
                EntityType::class,
                array('class' => SubtipoCuestion::class, 'choice_label' => 'descripcion')
            )
            ->add(
                'save',
                SubmitType::class,
                [
                    'label' => $options['label'],
                    'attr'  => [
                        'class' => 'btn waves-effect waves-light',
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Cuestion::class,
            ]
        );
    }
}
