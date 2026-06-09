<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Core\Database\Connection;
use App\Services\MailService;

class ContactController extends BaseController
{
    public function index(
        $request,
        $response
    )
    {
        return $this->view(
            'frontend.contact.index',
            [
                'pageHeaderTitle' => 'Contact Us'
            ],
            'layouts.frontend'
        );
    }

    public function store(
        $request,
        $response
    )
    {
        verify_csrf();

        $name =
            trim($_POST['name'] ?? '');

        $email =
            trim($_POST['email'] ?? '');

        $phone =
            trim($_POST['phone'] ?? '');

        $subject =
            trim($_POST['subject'] ?? '');

        $message =
            trim($_POST['message'] ?? '');

        if (
            empty($name)
            ||
            empty($email)
            ||
            empty($message)
        ) {
            die('Required fields missing.');
        }

        $db =
            Connection::getInstance();

        /**
         * Save inquiry
         */
        $stmt =
            $db->prepare(
                "
                INSERT INTO inquiries
                (
                    inquiry_type,
                    name,
                    email,
                    phone,
                    subject,
                    message,
                    status,
                    created_at
                )
                VALUES
                (
                    'contact',
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    'new',
                    NOW()
                )
                "
            );

        $stmt->execute([
            $name,
            $email,
            $phone,
            $subject,
            $message
        ]);

        /**
         * Email company
         */
        $mail =
        new \App\Services\MailService();

        $sent =
            $mail->send(

                env('MAIL_USERNAME'),

                'SHASTA CO. LTD Contact Inquiry',

                "
                <h2>SHASTA CO. LTD Contact Inquiry</h2>

                <p><strong>Name:</strong> {$name}</p>

                <p><strong>Email:</strong> {$email}</p>

                <p><strong>Phone:</strong> {$phone}</p>

                <p><strong>Subject:</strong> {$subject}</p>

                <p><strong>Message:</strong></p>

                <p>{$message}</p>
                "
            );

        if (!$sent) {

            die('Email failed');
        }

        $_SESSION['success'] =
            'Thank you for contacting Shasta Company Limited. Your inquiry has been received 
            successfully and one of our representatives will get back to you shortly.';

        header(
            'Location: '
            .
            url('contact')
        );

        exit;
    }
}