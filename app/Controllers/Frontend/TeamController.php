<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Core\Database\Connection;

class TeamController extends BaseController
{
    public function index(
        $request,
        $response
    )
    {
        $db =
            Connection::getInstance();

        $teamMembers =
        
            $db->query(
                "
                SELECT

                    tm.*,

                    m.file_path

                FROM team_members tm

                LEFT JOIN media m

                    ON m.mediable_type = 'team_member'

                    AND m.mediable_id = tm.id

                    AND m.is_featured = 1

                    AND m.status = 'active'

                    AND m.deleted_at IS NULL

                WHERE tm.status = 'active'

                AND tm.deleted_at IS NULL

                ORDER BY tm.sort_order ASC
                "
            )->fetchAll();

        return $this->view(
            'frontend.team.index',
            [
                'teamMembers' => $teamMembers
            ],
            'layouts.frontend'
        );
    }
}