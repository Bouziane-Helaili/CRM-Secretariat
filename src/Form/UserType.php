<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UserFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            // ->add('roles')
            // ->add('password')
            ->add('name', TextType::class, [
                'label' => "Nom de l'employé"
            ])
            ->add('firstName', TextType::class, [
                'label' => "Prénom de l'employé"
            ])
            // ->add('IsFirstLogin')
            ->add('address', TextType::class, [
                'label' => "Adresse"
            ])
            ->add('additionalAddress', TextType::class, [
                'label' => "Complément d'adresse"
            ])
            ->add('zipCode', NumberType::class, [
                'label' => 'Code postal'
            ])
            ->add('city', TextType::class, [
                'label' => "Ville"
            ])
            ->add('phone', NumberType::class, [
                'label' => 'Téléphone'
            ])
            // ->add('dateOfBirth')
            ->add('ssNumber', NumberType::class, [
                'label' => 'Numéro Sécurité Sociale'
            ])
            ->add('comment', TextareaType::class, [
                'label' => "Commentaire"
            ])
            ->add('userFiles', CollectionType::class, [
                'entry_type' => UserFileType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
