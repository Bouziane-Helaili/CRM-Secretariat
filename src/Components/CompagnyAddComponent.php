<?php

namespace App\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use App\Entity\Compagny;
use App\Form\CompagnyFileType;
use App\Form\CompagnyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;

#[AsLiveComponent('compagny_add')]
class CompagnyAddComponent extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp(fieldName: 'data')]
    public ?Compagny $compagny = null;
    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(CompagnyFileType::class, $this->compagny);
    }

    #[LiveAction]
    public function addCompagnyFile()
    {
        $this->formValues['compagnyFiles'][] = [];
    }

    #[LiveAction]
    public function removeCompagnyFile(#[LiveArg] int $index)
    {
        unset($this->formValues['compagnyFiles'][$index]);
    }

    // #[LiveAction]
    // public function addPhoto()
    // {
    //     $this->formValues['photos'][] = [];
    // }
    
    // #[LiveAction]
    // public function removePhoto(#[LiveArg] int $index)
    // {
    //     unset($this->formValues['photos'][$index]);
    // }

}
