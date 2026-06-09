<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    public function send(
        string $to,
        string $subject,
        string $body
    ): bool
    {
        try {

            $mail = new PHPMailer(true);

            $mail->isSMTP();

            $mail->Host =
                env('MAIL_HOST');

            $mail->SMTPAuth = true;

            $mail->Username =
                env('MAIL_USERNAME');

            $mail->Password =
                env('MAIL_PASSWORD');

            $mail->SMTPSecure =
                PHPMailer::ENCRYPTION_STARTTLS;

            $mail->Port =
                env('MAIL_PORT');

            $mail->setFrom(
                env('MAIL_FROM_ADDRESS'),
                env('MAIL_FROM_NAME')
            );

            $mail->addAddress($to);

            $mail->isHTML(true);

            $mail->Subject =
                $subject;

            $mail->Body =
                $body;

            return $mail->send();

        } catch (Exception $e) {

            error_log(
                'Mail Error: '
                .
                $e->getMessage()
            );

            return false;
        }
    }
}