<?php

namespace App\Form;

use App\Entity\Cuestion;
use App\Entity\SubtipoCuestion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
