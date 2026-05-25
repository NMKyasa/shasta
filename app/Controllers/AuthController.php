<?php

namespace App\Controllers;

use App\Core\Services\Auth;
use App\Core\Validation\Validator;

class AuthController extends BaseController
{
    /**
     * Show login form
     */
    public function showLogin(
        $request,
        $response
    )
    {
        $this->view(
            'auth.login',
            [],
            null
        );
    }

    /**
     * Process login
     */
    public function login(
        $request,
        $response
    )
    {
        /**
         * Validate input
         */
        $validator = Validator::make(

            $request->all(),

            [

                'email'
                    =>
                    'required|email',

                'password'
                    =>
                    'required|min:6'
            ]
        );

        /**
         * Validation failed
         */
        if ($validator->fails()) {

            return $response->json([

                'errors' =>
                    $validator->errors()
            ], 422);
        }

        /**
         * Attempt login
         */
        $success = Auth::attempt(

            $request->input('email'),

            $request->input('password')
        );

        /**
         * Invalid credentials
         */
        if (!$success) {

            return $response->json([

                'message' =>
                    'Invalid credentials'
            ], 401);
        }

        /**
         * Success
         */
        return $response->redirect(
            url('dashboard')
        );
    }

    /**
     * Logout
     */
    public function logout(
        $request,
        $response
    )
    {
        Auth::logout();

        return $response->redirect(
            url('login')
        );
    }
}