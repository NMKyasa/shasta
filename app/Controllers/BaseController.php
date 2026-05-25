<?php

namespace App\Controllers;

/**
 * Base Controller
 */
class BaseController
{
    /**
     * Render view
     */
    protected function view(
        $view,
        $data = [],
        $layout = null
    )
    {
        /**
         * Extract variables
         */
        extract($data);

        /**
         * View file path
         */
        $viewPath =
            __DIR__
            .
            '/../../resources/views/'
            .
            str_replace('.', '/', $view)
            .
            '.php';

        /**
         * Layout file path
         */
        $layoutPath =
            __DIR__
            .
            '/../../resources/views/'
            .
            str_replace('.', '/', $layout)
            .
            '.php';

        /**
         * Ensure view exists
         */
        if (!file_exists($viewPath)) {

            die(
                "View not found: {$view}"
            );
        }

        /**
         * Ensure layout exists
         */
        if (
            $layout !== null
            &&
            !file_exists($layoutPath)
        ) {

            die(
                "Layout not found: {$layout}"
            );
        }

        /**
         * Capture view output
         */
        ob_start();

        require $viewPath;

        /**
         * Store rendered content
         */
        $content = ob_get_clean();

        /**
         * Render with layout
         */
        if ($layout !== null) {

            require $layoutPath;

        } else {

            echo $content;
        }
    }
}