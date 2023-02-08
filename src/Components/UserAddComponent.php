<?php

namespace App\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use App\Entity\User;
use App\Form\UserFileType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;

#[AsLiveComponent('user_add')]
class UserAddComponent extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp(fieldName: 'data')]
    public ?User $user = null;
    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(UserType::class, $this->user);
    }

    #[LiveAction]
    public function addUserFile()
    {
        $this->formValues['userFiles'][] = [];
    }
    
    #[LiveAction]
    public function removeUserFile(#[LiveArg] int $index)
    {
        unset($this->formValues['userFiles'][$index]);
    }

}
