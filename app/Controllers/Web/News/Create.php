<?php

declare(strict_types=1);

namespace App\Controllers\Web\News;

use App\Controllers\BaseController;
use App\Models;
use CodeIgniter\Validation\Exceptions\ValidationException;
use LogicException;

class Create extends BaseController
{
    public function exec(): void
    {
        $validate_result = parent::validate([
            'title' => [
                'required',
                'min_length[3]',
                'max_length[255]',
            ],
            'body' => [
                'required',
            ],
        ]);

        if (!$validate_result) {
            throw new ValidationException('bad eintities');
        }

        $model = new Models\News();
        $result = $model->save([
            'title' => $this->request->getPost('title'),
            'slug' => url_title($this->request->getPost('title'), '-', true),
            'body' => $this->request->getPost('body'),
        ]);

        if (!$result) {
            throw new LogicException('execute failed');
        }
        echo view('news/success');
    }
}
