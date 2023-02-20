<?php

namespace App\Trait;

trait LoginTrait
{

     public function LoginTrait()
    {
        $user = $this->getUser();
        $isFirstLogin = $user->isIsFirstLogin();
        if ($isFirstLogin ) {
            return $this->redirectToRoute("app_home");
        }
    }
}
