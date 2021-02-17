<?php

declare(strict_types=1);

namespace App\Controllers\Web\News;

use App\Controllers\BaseController;
use App\Models;

class GetAll extends BaseController
{
    public function exec(): void
    {
        $model = new Models\News();
        $data = [
            'news' => $model->getAll(),
            'title' => 'News archive',
        ];

        echo view('templates/header', $data);
        echo view('news/overview', $data);
        echo view('templates/footer', $data);
    }
}
