<?php

namespace App\Controllers;

use App\Core\Database\Connection;

/**
 * Base Controller
 */
class BaseController
{

    /**
     * Load application settings
     */
    protected function getSettings(): array
    {
        $db =
            Connection::getInstance();

        $settings = [];

        $query =
            $db->query(
                "
                SELECT
                    setting_key,
                    setting_value
                FROM settings
                WHERE autoload = 1
                "
            );

        foreach (
            $query->fetchAll()
            as
            $setting
        ) {

            $settings[
                $setting['setting_key']
            ] =
                $setting['setting_value'];
        }

        return $settings;
    }

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
         * Inject global settings
         */
        if (
            !isset($data['settings'])
        ) {

            $data['settings'] =
                $this->getSettings();
        }

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