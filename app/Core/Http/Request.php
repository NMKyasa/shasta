<?php

namespace App\Core\Http;

/**
 * HTTP Request Class
 */
class Request
{
    /**
     * Get request method
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get all input data
     */
    public function all()
    {
        return array_merge(
            $_GET,
            $_POST
        );
    }

    /**
     * Get single input value
     */
    public function input(
        $key,
        $default = null
    )
    {
        return $_POST[$key]
            ??
            $_GET[$key]
            ??
            $default;
    }

    /**
     * Check if input exists
     */
    public function has($key)
    {
        return isset($_POST[$key])
            ||
            isset($_GET[$key]);
    }

    /**
     * Get only specified fields
     */
    public function only(array $keys)
    {
        $results = [];

        foreach ($keys as $key) {

            $results[$key] =
                $this->input($key);
        }

        return $results;
    }

    /**
     * Get uploaded file
     */
    public function file($key)
    {
        return $_FILES[$key]
            ??
            null;
    }

    /**
     * Check if file exists
     */
    public function hasFile($key)
    {
        return isset($_FILES[$key]);
    }

    /**
     * Get request URI
     */
    public function uri()
    {
        return parse_url(
            $_SERVER['REQUEST_URI'],
            PHP_URL_PATH
        );
    }

    /**
     * Check request method
     */
    public function isMethod($method)
    {
        return strtoupper($method)
            ===
            $this->method();
    }
}