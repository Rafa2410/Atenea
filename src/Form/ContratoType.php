<?php

namespace App\Form;

use App\Entity\Contrato;
use App\Entity\UnidadDeGestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ContratoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha_alta', DateType::class, ['widget' => 'single_text', 'data' => new \DateTime()])
            ->add('fecha_baja', DateType::class, ['widget' => 'single_text', 'data' => new \DateTime()])
            ->add('descripcion', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Introduce una breve descripción',
                    'class' => 'materialize-textarea'
                ]
            ])
            ->add('unidad_id', EntityType::class, [
                'class' => UnidadDeGestion::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.tipo = 1')
                        ->orderBy('u.id', 'DESC');
                },
                'choice_label' => 'nombre',
                'attr' => [
                    'class' => 'browser-default'
                ],
            ])            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contrato::class,
        ]);
    }
}