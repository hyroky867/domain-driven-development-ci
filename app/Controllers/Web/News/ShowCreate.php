<?php

declare(strict_types=1);

namespace App\Controllers\Web\News;

use App\Controllers\BaseController;

class ShowCreate extends BaseController
{
    public function exec(): void
    {
        echo view('templates/header', [
            'title' => 'Create a news item',
        ]);
        echo view('news/create');
        echo view('templates/footer');
    }
}
