<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\ORM\Query\Expr\Select;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom du stagiaire"
            ])
            ->add('firstName', TextType::class, [
                'label' => "Prénom du stagiaire"
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
             ->add('email')
            ->add('ssNumber', NumberType::class, [
                'label' => 'Numéro Sécurité Sociale'
            ])
            ->add('comment', TextareaType::class, [
                'label' => "Commentaire"
            ])
            ->add('status', null, [
                'label' => "Statuts"
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
