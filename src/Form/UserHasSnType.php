<?php

namespace App\Form;

use App\Entity\UserHasSn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserHasSnType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accessToken')
            ->add('name')
            ->add('lastname')
            ->add('photo')
            ->add('socialNetworksId')
            ->add('userId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserHasSn::class,
        ]);
    }
}
