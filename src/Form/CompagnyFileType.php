<?php

namespace App\Form;

use App\Entity\CompagnyFile;
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
                'download_uri' => 'download uri..',
                'download_label' => 'Télécharger le fichier',
                'asset_helper' => true,
            ])
            // ->add('compagny')
            ->add('categoryFile')
            ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompagnyFile::class,
        ]);
    }
}
