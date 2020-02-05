<?php

namespace App\Controller\Admin;

use App\Services\Dashboard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dash")
     */
    public function index(EntityManagerInterface $manager, Dashboard $dashboard)
    {
    

        $items = $dashboard->getItems();

        $recentFilm = $dashboard->getRecentFilms();
        
        $recentSerie = $dashboard->getRecentSeries();

        $recentBook = $dashboard->getRecentBooks();

        $recentComment = $dashboard->getRecentComments();

        $recentUser = $dashboard->getRecentUsers();

        return $this->render('admin/dash/index.html.twig', [
            'items' => $items,
            'recentFilm' => $recentFilm,
            'recentSerie' =>$recentSerie,
            'recentBook' => $recentBook,
            'recentComment' => $recentComment,
            'recentUser' => $recentUser
        ]);
    }
}
