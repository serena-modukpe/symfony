<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\ByteString;
use App\Service\EmailService;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationController extends AbstractController
{

   


    private $emailService;

    public function __construct(EmailService $emailService)

    {
        $this->emailService=$emailService;
        
    }


    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Générer et définir le token d'activation
            $activationToken = bin2hex(random_bytes(32)); // Utilisation d'une méthode sécurisée pour générer le token
            $user->setActivationToken($activationToken);

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            // Générer le lien d'activation
            $activationLien = $this->generateUrl('app_activate', ['token' => $activationToken], UrlGeneratorInterface::ABSOLUTE_URL);

            try {
                $this->emailService->mailActivation($user, $activationLien);
                $this->addFlash('success', 'Votre email a été envoyé.');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
            }
    
            return $this->redirectToRoute('app_login'); // Redirigez vers la route souhaitée
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
