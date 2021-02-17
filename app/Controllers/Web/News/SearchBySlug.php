<?php

declare(strict_types=1);

namespace App\Controllers\Web\News;

use App\Controllers\BaseController;
use App\Models;
use CodeIgniter\Exceptions\PageNotFoundException;

class SearchBySlug extends BaseController
{
    public function exec(?string $slug): void
    {
        $error_message = "Cannot find the news item: {$slug}";

        if (is_null($slug)) {
            throw new PageNotFoundException($error_message);
        }

        $model = new Models\News();
        $news = $model->firstBySlug($slug);

        if (is_null($news)) {
            throw new PageNotFoundException();
        }

        $data = [
            'news' => $news,
            'title' => $news['title'],
        ];

        echo view('templates/header', $data);
        echo view('news/view', $data);
        echo view('templates/footer', $data);
    }
}
