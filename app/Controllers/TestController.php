<?php

namespace App\Controllers;

use App\Services\MailService;

class TestController
{
    public function send()
    {
        $mail =
            new MailService();

        $sent =
            $mail->send(
                'ndawulamichealkyasa@gmail.com',
                'Shasta Test Email',
                '<h1>Email is working!</h1>'
            );

        echo $sent
            ? 'EMAIL SENT'
            : 'EMAIL FAILED';
    }
}