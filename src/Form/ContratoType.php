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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
                        ->orderBy('u.id', 'DESC');
                },
                'choice_label' => 'nombre',
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
            'data_class' => Contrato::class,
        ]);
    }
}