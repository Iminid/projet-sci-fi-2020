<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use App\Entity\User;
use App\Services\Pagination;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/users/{pages<\d+>?1}", name="admin_users_index")
     */
    public function index($pages, Pagination $pagination)
    {
        $pagination->setClassEntity(User::class)
                   ->setPage($pages);

        return $this->render('admin/user/index.html.twig', [
            'pagination' => $pagination
        ]);
    }


    /**
     * Suppression d'un utilisateur
     *
     * @Route("/admin/users/{id}/delete", name="admin_users_delete")
     * 
     * @param User $user
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(User $user, EntityManagerInterface $manager){
        $manager->remove($user);
        $manager->flush();
        $this->addFlash(
            'success',
            "L'utilisateur <strong>{$user->getFirstName()} {{$user->getLastName()}}</strong> a été supprimé !"
        );
        return $this->redirectToRoute('admin_users_index');
    }

    
    /**
     * Ajouter le role admin à un utilisateur
     *
     * @Route("/admin/users/{id}/setrole", name="admin_users_setrole")
     * 
     * @param User $user
     * @param Role $role
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function setRole(User $user, Role $role, EntityManagerInterface $manager){
        
        //$role->addUser($user);
        //$role->addUser($user);
        //$manager->flush();
        /*$manager->addUser($user);
        $manager->flush();
        $this->addFlash(
            'success',
            "L'utilisateur <strong>{$user->getFirstName()} {{$user->getLastName()}}</strong> est maintenant un administrateur !"
        );*/
        return $this->redirectToRoute('admin_users_index');
    }

}
