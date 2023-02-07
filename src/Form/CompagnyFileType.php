<?php

namespace App\Form;

use App\Entity\CategoryFile;
use App\Entity\CompagnyFile;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class CompagnyFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'label' => 'Choix du fichier',
                'download_label' => 'Télécharger le fichier',
                'asset_helper' => true,
            ])
            // ->add('compagny')
            ->add('categoryFile', EntityType::class, [
                "class" => CategoryFile::class,
                'label' => "Choisir la catégorie associé à ce fichier :"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompagnyFile::class,
        ]);
    }
}
