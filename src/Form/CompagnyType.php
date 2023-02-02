<?php

namespace App\Form;

use App\Entity\Compagny;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompagnyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compagnyName')
            ->add('leaderName')
            ->add('leaderFirstName')
            ->add('address')
            ->add('additionalAddress')
            ->add('zipCode')
            ->add('city')
            ->add('mail')
            ->add('phone')
            ->add('siretNumber')
            ->add('comment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compagny::class,
        ]);
    }
}
