<?php

namespace App\Controller;

use App\Entity\Pass;
use App\Entity\User;
use App\Form\AccType;
use App\Form\PassType;
use App\Form\RegisterType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccController extends AbstractController
{
    /** 
     * Connexion
     * 
     * @Route("/login", name="acc_login")
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $aut)
    {
        $user = $aut->getLastUsername();
        $error = $aut->getLastAuthenticationError();
        return $this->render('acc/login.html.twig', [
            'hasError' => $error !== null,
            'user' => $user
        ]);
    }
    
    /**
     * Déconnexion
     * 
     * @Route("/logout", name="acc_logout")
     *
     * @return void
     */
    public function deco(){

    }
    
    /**
     * Formulaire d'inscription
     *
     * @Route("/register", name="acc_register")
     * 
     * @return Response
     */
    public function register(UserPasswordEncoderInterface $encode, Request $request, ObjectManager $manager){
            $user = new User();
            $form = $this->createForm(RegisterType::class, $user);
            $form-> handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $hash = $encode->encodePassword($user, $user->getHash());
                $user->setHash($hash);
                $manager->persist($user);
                $manager->flush();
            $this->addFlash('success', 'Votre compte a bien été créé !');
            return $this->redirectToRoute('acc_login');
            }
            return $this->render('acc/register.html.twig', [
                'form' => $form->createView()
            ]);
    }
    
    /**
     * Modification d'account
     * 
     * @Route("/account/profile", name="account_profile")
     *
     * @return Response
     */
    public function account(Request $request, ObjectManager $manager){
        $user = $this->getUser();
        $form = $this->createForm(AccType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();
        $this->addFlash('success', "Profile modifié !");
        }
        return $this->render('acc/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Modification du mot de passe
     * 
     * @Route("/account/pass-update", name="pass_update")
     *
     * @return Reponse
     */
    public function passwordUpdate(Request $request, UserPasswordEncoderInterface $encode, ObjectManager $manager){
        $passUpdate = new Pass();
        $user = $this->getUser();
        $form = $this->createForm(PassType::class, $passUpdate);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!password_verify($passUpdate->getOldPassword(), $user->getHash())){
                $form->get('oldPassword')->addError(new FormError("Tapez votre mot de passe actuel !"));
            }else{
                $newPassword = $passUpdate->getNewPassword();
                $hash = $encode->encodePassword($user, $newPassword);
                $user->setHash($hash);
                $manager->persist($user);
                $manager->flush();
            $this->addFlash('success', "Votre mot de passe a été modifié !");
                return $this->redirectToRoute('homepage');

            }
        }
        return $this->render('acc/pass.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Connected user profile
     *
     *@Route("/account", name="account_home")
     * 
     * @return Response
     */
    public function myAcc(){
        return $this->render('user/index.html.twig', [
            'user' => $this->getUser()           
        ]);
    }
}
