<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminAccController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_acc_login")
     */
    public function index(AuthenticationUtils $aut)
    {
        $user = $aut->getLastUsername();
        $error = $aut->getLastAuthenticationError();
        return $this->render('admin/acc/index.html.twig', [
            'hasError' => $error !== null,
            'user' => $user
        ]);
    }

    /**
     * Logout
     * 
     * @Route("/admin/logout", name="admin_acc_logout")
     *
     * @return void
     */
    public function logout(){

    }
}
