<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class EmailSendTest extends WebTestCase
{
    /**
     * @covers ::.\App\Controller\EmailSend
     */
    public function testEmailSend()
    {
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request('GET', '/users');
        $content = json_decode($client->getResponse()->getContent(), true);
        dump($content);

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        //$this->assertJson(['test' => 'test']);
        $this->assertArrayHasKey('test', $content);
    }

    public function sendMail(MailerInterface $mailer, string $email, string $uuid)
    {
        $link = "https://moncul.fr/verif?token=" . $uuid . "email=" . $email;
        $emailFrom = getenv('EMAIL');

        $mail = (new Email())
            ->from(new Address($emailFrom, 'Mins-Tales'))
            ->to($email)
            ->subject('Mins-Tales - Confirmer votre compte')
            ->text($link);

        $mailer->send($mail);
    }
}
