<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; // Utilisez la bonne classe Response
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{
    #[Route('/training', name: 'app_training')] // Route pour tester l'envoi d'e-mail
    public function training(MailerInterface $mailer): Response
    {
        try{
            
        $email = (new Email())
            ->from('sinzoganserena@gmail.com') // Remplacez par votre adresse email
            ->to('serenamodukpe@gmail.com') // Remplacez par l'adresse du destinataire
            ->subject('Test d\'envoi de mail')
            ->text('Ceci est un test d\'envoi de mail.');

        
            $mailer->send($email);
            return new Response('Mail envoyé avec succès !');
        } catch (\Exception $e) {
            return new Response('Erreur lors de l\'envoi du mail : ' . $e->getMessage());
        }
    }
}
