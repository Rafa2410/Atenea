<?php

namespace App\Form;

use App\Entity\Aspecto;
use App\Entity\Cuestion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AspectoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion', TextType::class, ['label' => 'Descripcion del aspecto'])
            ->add(
                'cuestiones',
                EntityType::class,
                array(
                    'class'        => Cuestion::Class,
                    'choice_label' => 'descripcion',
                    'multiple'     => true,
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Aspecto::class,
            ]
        );
    }
}
