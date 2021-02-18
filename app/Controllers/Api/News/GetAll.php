<?php

declare(strict_types=1);

namespace App\Controllers\Api\News;

use App\Controllers\Api\ApiController;
use App\Models;
use CodeIgniter\HTTP\Response;

class GetAll extends ApiController
{
    public function exec(): Response
    {
        $model = new Models\News();
        return parent::respond([
            'status' => 200,
            'error' => null,
            'news' => $model->getAll(),
        ]);
    }
}
