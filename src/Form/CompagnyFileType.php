<?php

namespace App\Form;

use App\Entity\CategoryFile;
use App\Entity\CompagnyFile;
use App\Repository\CategoryFileRepository;
use Doctrine\ORM\Mapping\Entity;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
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
                'delete_label' => 'Effacer ce fichier',
                'label' => 'Choix du fichier',
                'download_label' => 'Télécharger le fichier',
                'asset_helper' => true,
            ])
            // ->add('compagny')
            ->add('categoryFile', EntityType::class, [
                "class" => CategoryFile::class,
                'label' => "Choisir la catégorie associé à ce fichier :",
                "query_builder"=> function (CategoryFileRepository $er) {
                    return $er->createQueryBuilder('c')
                    ->andWhere("c.type = :type")
                    ->setParameter("type", CategoryFile::COMPAGNY);
                }
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompagnyFile::class,
           
        ]);
    }
}
