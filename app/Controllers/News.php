<?php

declare(strict_types=1);

namespace App\Controllers;

use _HumbugBox7b277e069751\Nette\Schema\ValidationException;
use _HumbugBox7b277e069751\Symfony\Component\Console\Exception\LogicException;
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

    public function create(): void
    {
        if ($this->request->getMethod() == 'post') {
            $this->createData();
            echo view('news/success');
        }
        if ($this->request->getMethod() == 'get') {
            echo view('templates/header', [
                'title' => 'Create a news item',
            ]);
            echo view('news/create');
            echo view('templates/footer');
        }
    }

    public function createData(): bool
    {
        $validate_result = parent::validate([
            'title' => [
                'required',
                'min_length[3]',
                'max_length[255]'
            ],
            'body' => [
                'required'
            ],
        ]);

        if (!$validate_result) {
            throw new ValidationException('bad eintities');
        }
        $model = new Models\News();
        return $model->save([
            'title' => $this->request->getPost('title'),
            'slug' => url_title($this->request->getPost('title'), '-', true),
            'body' => $this->request->getPost('body'),
        ]);
    }
}
