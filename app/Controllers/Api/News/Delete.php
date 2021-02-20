<?php

declare(strict_types=1);

namespace App\Controllers\Api\News;

use App\Controllers\Api\ApiController;
use App\Models;
use CodeIgniter\HTTP\Response;

class Delete extends ApiController
{
    public function exec(int $id): Response
    {
        $model = new Models\News();
        $news = $model->find($id);

        if ($news === null) {
            return parent::failNotFound();
        }
        $result = $model->delete($id);

        if (!$result) {
            return parent::failServerError();
        }

        return parent::respondDeleted([
            'error' => null,
            'messages' => [
                'success' => 'News successfully deleted',
            ],
        ]);
    }
}
