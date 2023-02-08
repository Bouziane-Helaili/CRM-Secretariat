<?php

namespace App\Form;

use App\Entity\CategoryFile;
use App\Entity\UserFile;
use App\Repository\CategoryFileRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UserFileType extends AbstractType
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
            
            // ->add('user')
            ->add('categoryFile', EntityType::class, [
                "class" => CategoryFile::class,
                'label' => "Choisir la catégorie associé à ce fichier :",
                "query_builder"=> function (CategoryFileRepository $er) {
                    return $er->createQueryBuilder('c')
                    ->andWhere("c.type = :type")
                    ->setParameter("type", CategoryFile::STAGIAIRE);
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserFile::class,
        ]);
    }
}
