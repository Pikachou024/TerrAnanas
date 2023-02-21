<?php

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;



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
