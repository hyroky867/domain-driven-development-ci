<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    public function index(): void
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

    public function view(?string $slug = null): void
    {
        $error_message = "Cannot find the news item: {$slug}";
        if (is_null($slug)) {
            throw new PageNotFoundException($error_message);
        }
        $model = new Models\News();

        $news = $model->firstBySlug($slug);
        if (empty($news)) {
            throw new PageNotFoundException();
        }

        $data = [
            'news'  => $news,
            'title' => $news['title'],
        ];

        echo view('templates/header', $data);
        echo view('news/view', $data);
        echo view('templates/footer', $data);
    }
}
