<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class EmailSend extends AbstractController
{
    public function sendMail(MailerInterface $mailer, String $email, String $uuid)
    {
        $link = "https://moncul.fr/verif?token=".$uuid."email=".$email;
        $emailFrom = getenv('EMAIL');

        $mail = (new Email())
            ->from(new Address($emailFrom, 'Mins-Tales'))
            ->to($email)
            ->subject('Mins-Tales - Confirmer votre compte')
            ->text($link)
        ;

        $mailer->send($mail);
    }
}