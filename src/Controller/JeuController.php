<?php

namespace App\Controller;

use AllowDynamicProperties;
use App\Repository\JeuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JeuController extends AbstractController
{

    #[Route('/jeu', name: 'app_jeu')]
    public function index(JeuRepository $jeuRepository): Response
    {

        return $this->render('jeu/index.html.twig', [
            'jeux' => $jeuRepository->findWithLimit(3),
        ]);

    }

}
