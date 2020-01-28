<?php

namespace App\Controller\Admin;

use App\Entity\Comments;
use App\Services\Pagination;
use App\Form\AdminCommentType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminComController extends AbstractController
{
    /**
     * @Route("/admin/comments/{pages<\d+>?1}", name="admin_comment_index")
     */
    public function index($pages, Pagination $pagination)
    {
        $pagination->setClassEntity(Comments::class)
                   ->setPage($pages)
                   ->setMax(10)
                   ;

        $repo = $this->getDoctrine()->getRepository(Comments::class);
        $comments = $repo->findAll("comments.createAt", 'ASC');
        return $this->render('admin/comments/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * Modification d'un commentaire
     * 
     * @Route("/admin/comments/{id}/edit", name="admin_comments_edit")
     *
     * @return Response
     */
    public function edit($id, Request $request, ObjectManager $manager){
        $repo = $this->getDoctrine()->getRepository(Comments::class);
        $comment = $repo->find($id);
        $form = $this->createForm(AdminCommentType::class, $comment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($comment);
            $manager->flush();
            $this->addFlash(
                'success',
                "Le commentaire <strong>{$comment->getId()}</strong> a été modifié !"
            );
        }
        return $this->render('admin/comments/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);
    }


    /**
     * Suppression d'un commentaire
     * 
     * @Route("/admin/comments/{id}/delete", name="admin_comments_delete")
     *
     * @param Comments $comment
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Comments $comment, ObjectManager $manager){
        $manager->remove($comment);
        $manager->flush();
        $this->addFlash(
            'success',
            "Le commentaire a été supprimé !"
        );
        return $this->redirectToRoute('admin_comment_index');
    }
}
