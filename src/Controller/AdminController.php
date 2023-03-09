<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')] //DONNE LA ROUTE URL A METTRE AVANT CHAQUE FONCTIONS
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin2/users', name: 'app_adminListUsers')]
    public function listUsers(EntityManagerInterface $manager): Response
    {
        // 1. Récupère user (fonction = find all)
        $getUsers = $manager->getRepository(User::class)->findAll();
        return $this->render("admin/listUsers.html.twig", array("listUsers" => $getUsers));

        // 2. Envoie à la vue

    }
}
