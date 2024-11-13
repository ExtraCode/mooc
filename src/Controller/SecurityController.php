<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/inscription', name: 'app_inscription')]
    public function inscription(Request                     $request,
                                UserPasswordHasherInterface $passwordHasher,
                                EntityManagerInterface      $entityManager): Response
    {

        $user = new User();
        $user->setRoles(['ROLE_CLIENT']);

        // le formulaire
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Traitement du formulaire
            $user->setPassword(
                $passwordHasher->hashPassword($user, $user->getPassword())
            );

            // Mon user est prêt à être persist
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', "Vous êtes bien inscrit");

            return $this->redirectToRoute('app_login');


        }

        return $this->render('security/inscription.html.twig', [
            'form' => $form,
        ]);

    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
