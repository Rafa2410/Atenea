<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('apellidos', TextType::class)
            ->add('telefono', TextType::class)
            ->add('email', EmailType::class)
            ->add('fecha_alta', DateType::class, ['widget' => 'single_text'])
            //->add('password', PasswordType::class)
            ->add(
                'password',
                RepeatedType::class,
                [
                    'type'            => PasswordType::class,
                    'required'        => true,
                    'first_options'   => ['label' => 'Password'],
                    'second_options'  => ['label' => 'Repite Password'],
                    'invalid_message' => 'Los passwords deben coincidir!',
                    'row_attr'        => ['class' => 'red']
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Usuario::class,
            )
        );
    }
}

?>