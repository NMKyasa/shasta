<?php

namespace App\Controllers;
use App\Models\User;

/**
 * Homepage Controller
 */
class HomeController extends BaseController
{
    /**
     * Homepage
     */
    public function index($request, $response)
    {
        /**
         * Pass data to view
         */
            $users = User::all();

            return $response->json($users);
    }
}