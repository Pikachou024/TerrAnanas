<?php

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

const MAILER_DSN = 'smtp://f0bb83f2a6b9e5:59a6675b21c71d@smtp.mailtrap.io:2525?encryption=tls&auth_mode=login';

function sendMail(string $emailExpediteur, string $emailDestinataire,string $subject, string $message, $copy)
{
    $transport = Transport::fromDsn(MAILER_DSN);
    $mailer = new Mailer($transport);
    $email = (new Email())
        ->from($emailExpediteur)
        ->to($emailDestinataire)
        ->priority(Email::PRIORITY_HIGHEST)
        ->subject($subject)
//        ->text($message)
        ->html(
            '<p>'.$message.'</p>'
        );
//        ->attachFromPath('/path/to/file.pdf');
    if ($copy) {
        $email->addTo($emailExpediteur);
    }
    $mailer->send($email);
}
