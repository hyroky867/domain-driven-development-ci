<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Pages extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function view(string $page = 'home'): void
    {
        if (!is_file(APPPATH . "/Views/pages/{$page}.php")) {
            throw new PageNotFoundException($page);
        }

        $data = [
            'title' => ucfirst($page),
        ];

        echo view('templates/header', $data);
        echo view("pages/{$page}.php", $data);
        echo view('templates/footer', $data);
    }
}
