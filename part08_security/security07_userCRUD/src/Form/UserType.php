<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Twig\Error\RuntimeError;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
//            ->add('roles')
            ->add('Roles', ChoiceType::class, [
                'required' => true,
                'multiple' => true,
                'expanded' => false,
                'choices' => [
                    'ROLE_USER' => 'ROLE_USER',
                    'ROLE_TEACHER' => 'ROLE_TEACHER',
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                ],
            ])
            ->add('password')
        ;

//        $builder->get('Roles')
//            ->addModelTransformer(new CallbackTransformer(
//                function ($rolesArray) {
//                    return count($rolesArray)? $rolesArray[0]: null;
//                },
//                function ($rolesString) {
//                    return [$rolesString];
//                }
//            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
