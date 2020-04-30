<?php

namespace App\Form;

use App\Entity\UnidadDeGestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class UnidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, [
                'attr' => [
                    'placeholder' => 'Introduce el nombre',                    
                ]
            ])
            ->add('descripcion', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Introduce una breve descripción',
                    'class' => 'materialize-textarea'
                ]
            ])
            ->add('tipo', ChoiceType::class, [                
                'choices' => ['Corporación' => 1, 'Empresa' => 2, 'Emplazamiento' => 3],
                'attr' => [
                    'class' => 'browser-default'
                ],                
            ])
            ->add('unidadDeGestion', EntityType::class, [                
                'class' => UnidadDeGestion::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.id', 'DESC');
                },
                'choice_label' => 'nombre',
                'attr' => [
                    'class' => 'browser-default'
                ],
            ])
            ->add('guardar', SubmitType::class, [
                'attr' => [
                    'class' => 'btn waves-effect waves-light'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UnidadDeGestion::class,
        ]);
    }
}
