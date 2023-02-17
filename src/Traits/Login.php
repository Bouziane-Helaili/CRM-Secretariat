<?php

namespace App\Traits;

trait Login
{

     public function Login()
    {
        $user = $this->getUser();
        $isFirstLogin = $user->isIsFirstLogin();
        if ($isFirstLogin === true) {

            return $this->redirectToRoute("app_home");
        }
    }
}
