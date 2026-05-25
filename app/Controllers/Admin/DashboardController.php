<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController
extends BaseController
{
    /**
     * Dashboard page
     */
    public function index(
        $request,
        $response
    )
    {
        $this->view(

            'admin.dashboard.index',

            [],

            'layouts.admin'
        );
    }
}