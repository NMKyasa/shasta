<?php

namespace App\Core\Http;

/**
 * HTTP Response Class
 */
class Response
{
    /**
     * Set HTTP status code
     */
    public function status($code)
    {
        http_response_code($code);

        return $this;
    }

    /**
     * Output JSON response
     */
    public function json(
        $data,
        $status = 200
    )
    {
        /**
         * Set status code
         */
        $this->status($status);

        /**
         * Set JSON header
         */
        header(
            'Content-Type: application/json'
        );

        /**
         * Output JSON
         */
        echo json_encode(
            $data,
            JSON_PRETTY_PRINT
        );

        exit;
    }

    /**
     * Redirect to URL
     */
    public function redirect($url)
    {
        header(
            "Location: {$url}"
        );

        exit;
    }

    /**
     * Output plain content
     */
    public function send($content)
    {
        echo $content;

        exit;
    }

    /**
     * Output 404 response
     */
    public function notFound(
        $message = '404 - Page Not Found'
    )
    {
        $this->status(404);

        echo $message;

        exit;
    }

    /**
     * Output success response
     */
    public function success($message)
    {
        $this->status(200);

        echo $message;

        exit;
    }
}