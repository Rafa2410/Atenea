<?php

namespace App\Form;

use App\Entity\SubtipoCuestion;
use App\Entity\TipoCuestion;
use App\Form\TipoCuestionType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class SubtipoCuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', TextType::class, ['label' => 'Descripcion del subtipo'])
            ->add('tipo', EntityType::class, array('class' => TipoCuestion::class, 'choice_label' => 'descripcion'))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => SubtipoCuestion::class,
            ]
        );
    }
}
