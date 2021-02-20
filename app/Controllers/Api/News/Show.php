<?php

declare(strict_types=1);

namespace App\Controllers\Api\News;

use App\Controllers\Api\ApiController;
use App\Models;
use CodeIgniter\HTTP\Response;

class Show extends ApiController
{
    public function exec(int $id): Response
    {
        if (empty($id)) {
            return parent::failNotFound();
        }

        $model = new Models\News();
        $news = $model->firstById($id);

        if ($news === null) {
            return parent::failNotFound();
        }

        return parent::respond([
            'status' => 200,
            'error' => null,
            'news' => $news,
        ]);
    }
}
