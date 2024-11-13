<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JeuController extends AbstractController
{
    #[Route('/admin/jeu', name: 'app_admin_jeu')]
    public function index(): Response
    {
        return $this->render('admin/jeu/index.html.twig', [
            'controller_name' => 'JeuController',
        ]);
    }
}
