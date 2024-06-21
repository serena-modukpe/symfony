<?php
namespace App\Service;

use App\Entity\User;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class EmailService
{
    private $mailer;
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function mailActivation(User $user, $activationLien): void
    {
        try {
            $email = (new Email())
                ->from('sinzoganserena@gmail.com')
                ->to($user->getEmail())
                ->subject('Confirmez votre inscription')
                ->html(
                    $this->twig->render('emails/activation_email.html', [
                        'user' => $user,
                        'url' => $activationLien,
                    ])
                );

            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            // Log the error or handle it accordingly
            throw new \Exception("Erreur lors de l'envoi de l'email : " . $e->getMessage());
        }
    }
}
