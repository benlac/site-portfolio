<?php

namespace App\Notification;

use Twig\Environment;
use App\Entity\Contact;

class ContactNotification
{
    /**
     * @var Environnement
     */
    private $renderer;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }
    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message('Email de contact'))
        ->setFrom($contact->getEmail())
        ->setTo('benoit.lacombled@gmail.com')
        ->setBody(
            $this->renderer->render(
                'emails/contact.html.twig',
                ['contact' => $contact]
            ),
            'text/html'
        );

        $this->mailer->send($message);

    }
} 
