<?php

namespace App\Core\Routing;

use App\Core\Http\Request;
use App\Core\Http\Response;

/**
 * Main Router Class
 */
class Router
{
    /**
     * Store all registered routes
     */
    protected array $routes = [];

    /**
     * Temporary middleware stack
     *
     * This stores middleware before
     * attaching them to a route.
     */
    protected array $middlewares = [];

    /**
     * Register GET route
     */
    public function get(
        $uri,
        $action
    )
    {
        $this->addRoute(
            'GET',
            $uri,
            $action
        );
    }

    /**
     * Register POST route
     */
    public function post(
        $uri,
        $action
    )
    {
        $this->addRoute(
            'POST',
            $uri,
            $action
        );
    }

    /**
     * Attach middleware
     *
     * Example:
     * $router->middleware('auth')
     *        ->get('/dashboard', ...);
     */
    public function middleware($middleware)
    {
        /**
         * Store middleware temporarily
         */
        $this->middlewares[] =
            $middleware;

        /**
         * Return router instance
         * for chaining
         */
        return $this;
    }

    /**
     * Add route to collection
     */
    protected function addRoute(
        $method,
        $uri,
        $action
    )
    {
        /**
         * Store route definition
         */
        $this->routes[] = [

            'method' =>
                $method,

            'uri' =>
                $uri,

            'action' =>
                $action,

            'middlewares' =>
                $this->middlewares
        ];

        /**
         * Reset middleware stack
         *
         * Prevent middleware leakage
         * into future routes.
         */
        $this->middlewares = [];
    }

    /**
     * Dispatch current request
     */
    public function dispatch()
    {
        /**
         * Current request URI
         *
         * Example:
         * /shasta/public/login
         */
        $requestUri =
            parse_url(

                $_SERVER['REQUEST_URI'],

                PHP_URL_PATH
            );

        /**
         * Remove base project path
         *
         * Example:
         * /shasta/public/login
         *
         * becomes:
         * /login
         */
        $basePath =
            '/shasta/public';

        /**
         * Remove base path
         */
        if (

            str_starts_with(
                $requestUri,
                $basePath
            )

        ) {

            $requestUri =
                substr(

                    $requestUri,

                    strlen($basePath)
                );
        }

        /**
         * Remove trailing slash
         *
         * Example:
         * /dashboard/
         *
         * becomes:
         * /dashboard
         */
        $requestUri =
            rtrim(
                $requestUri,
                '/'
            );

        /**
         * Preserve homepage
         */
        if ($requestUri === '') {

            $requestUri = '/';
        }

        /**
         * Current HTTP method
         */
        $requestMethod =
            $_SERVER['REQUEST_METHOD'];

        /**
         * Loop through all routes
         */
        foreach ($this->routes as $route) {

            /**
             * Skip different methods
             */
            if (

                $route['method']
                !==
                $requestMethod

            ) {

                continue;
            }

            /**
             * Convert dynamic params
             *
             * Example:
             * /services/{slug}
             *
             * becomes:
             * /services/([^/]+)
             */
            $pattern =
                preg_replace(

                    '#\{[^/]+\}#',

                    '([^/]+)',

                    $route['uri']
                );

            /**
             * Preserve homepage route
             */
            if ($pattern !== '/') {

                $pattern =
                    rtrim(
                        $pattern,
                        '/'
                    );
            }

            /**
             * Build final regex pattern
             */
            $pattern =
                "#^"
                .
                $pattern
                .
                "$#";

            /**
             * Match request URI
             */
            if (

                preg_match(

                    $pattern,

                    $requestUri,

                    $matches
                )

            ) {

                /**
                 * IMPORTANT:
                 *
                 * Execute middleware ONLY
                 * AFTER route matches.
                 *
                 * This prevents middleware
                 * from executing globally
                 * and causing redirect loops.
                 */
                foreach (

                    $route['middlewares']
                    as
                    $middleware

                ) {

                    /**
                     * Middleware map
                     */
                    $map = [

                        'auth'
                            =>
                            \App\Core\Middleware\AuthMiddleware::class
                    ];

                    /**
                     * Skip unknown middleware
                     */
                    if (
                        !isset($map[$middleware])
                    ) {

                        continue;
                    }

                    /**
                     * Create middleware instance
                     */
                    $middlewareInstance =
                        new $map[$middleware];

                    /**
                     * Execute middleware
                     */
                    $middlewareInstance->handle(

                        new Request(),

                        new Response()
                    );
                }

                /**
                 * Remove full regex match
                 */
                array_shift($matches);

                /**
                 * Route action
                 */
                $action =
                    $route['action'];

                /**
                 * Controller action
                 */
                if (is_array($action)) {

                    /**
                     * Create controller
                     */
                    $controller =
                        new $action[0];

                    /**
                     * Controller method
                     */
                    $method =
                        $action[1];

                    /**
                     * Create request object
                     */
                    $request =
                        new Request();

                    /**
                     * Create response object
                     */
                    $response =
                        new Response();

                    /**
                     * Inject request first
                     */
                    array_unshift(
                        $matches,
                        $response
                    );

                    /**
                     * Inject response second
                     */
                    array_unshift(
                        $matches,
                        $request
                    );

                    /**
                     * Execute controller action
                     */
                    return call_user_func_array(

                        [$controller, $method],

                        $matches
                    );
                }

                /**
                 * Closure route action
                 */
                return call_user_func_array(

                    $action,

                    $matches
                );
            }
        }

        /**
         * No route matched
         */
        http_response_code(404);

        echo "404 - Page Not Found";
    }
}