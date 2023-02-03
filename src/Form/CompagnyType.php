<?php

namespace App\Form;

use App\Entity\Compagny;
use App\Entity\CompagnyFile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;


class CompagnyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compagnyName', TextType::class, [
                'label' => "Nom de l'entreprise"
            ])
            ->add('leaderName', TextType::class, [
                'label' => "Nom du Responsable"
            ])
            ->add('leaderFirstName', TextType::class, [
                'label' => "Prénom du responsable"
            ])
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
            ->add('mail')
            ->add('phone', NumberType::class, [
                'label' => 'Téléphone'
            ])
            ->add('siretNumber', NumberType::class, [
                'label' => 'Numéro de SIRET'
            ])
            ->add('comment', TextareaType::class, [
                'label' => "Commentaire"
            ])
            ->add('compagnyFiles', CollectionType::class, [
                'entry_type' => CompagnyFileType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compagny::class,
        ]);
    }
}
