<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Core\Database\Connection;
use App\Services\MailService;

class QuoteController extends BaseController
{
    /**
     * Quotes page
     */
    public function index(
        $request,
        $response
    )
    {
        $db =
            Connection::getInstance();

        $services =
            $db->query(
                "
                SELECT
                    id,
                    title
                FROM services
                WHERE status = 'active'
                AND deleted_at IS NULL
                ORDER BY title ASC
                "
            )->fetchAll();

        return $this->view(

            'frontend.quote.index',

            [
                'pageHeaderTitle' => 'Free Quote',
                'services' => $services

            ],

            'layouts.frontend'
        );
    }

    /**
     * Store quote request
     */
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

        $serviceId =
            $_POST['service_id'] ?? null;

        $message =
            trim($_POST['message'] ?? '');

        if (
            empty($name)
            ||
            empty($email)
            ||
            empty($serviceId)
        ) {
            die('Required fields missing.');
        }

        $db =
            Connection::getInstance();

        $stmt =
            $db->prepare(
                "
                INSERT INTO inquiries
                (
                    inquiry_type,
                    name,
                    email,
                    phone,
                    message,
                    service_id,
                    status,
                    created_at
                )
                VALUES
                (
                    'quote',
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
            $message,
            $serviceId
        ]);

        $serviceQuery =
            $db->prepare(
                "
                SELECT title
                FROM services
                WHERE id = ?
                LIMIT 1
                "
            );

        $serviceQuery->execute([
            $serviceId
        ]);

        $service =
            $serviceQuery->fetch();

        $serviceName =
            $service['title']
            ??
            'Unknown Service';

        $mail =
            new MailService();

        $sent =
            $mail->send(

                env('MAIL_USERNAME'),

                'SHASTA CO. LTD Quote Request',

                "
                <h2>New Quote Request</h2>

                <p><strong>Name:</strong> {$name}</p>

                <p><strong>Email:</strong> {$email}</p>

                <p><strong>Phone:</strong> {$phone}</p>

                <p><strong>Service:</strong> {$serviceName}</p>

                <p><strong>Requirements:</strong></p>

                <p>{$message}</p>
                "
            );

        if (!$sent) {

            die('Email failed');
        }

        $_SESSION['success'] =
            'Thank you for requesting a quotation. Our team will contact you shortly.';

        header(
            'Location: '
            .
            url('quote')
        );

        exit;
    }
}