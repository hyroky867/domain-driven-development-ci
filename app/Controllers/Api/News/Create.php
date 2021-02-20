<?php

declare(strict_types=1);

namespace App\Controllers\Api\News;

use App\Controllers\Api\ApiController;
use App\Models;
use CodeIgniter\HTTP\Response;

class Create extends ApiController
{
    public function exec(): Response
    {
        parent::validate([
            'title' => [
                'required',
                'min_length[3]',
                'max_length[255]',
            ],
            'body' => [
                'required',
            ],
        ]);

        $errors = $this->validator->getErrors();

        if ($errors !== []) {
            return parent::failValidation($errors);
        }

        $model = new Models\News();
        $result = $model->save([
            'title' => $this->request->getPost('title'),

            'slug' => url_title($this->request->getPost('title'), '-', true),
            'body' => $this->request->getPost('body'),
        ]);

        if (!$result) {
            return parent::failServerError();
        }
        return parent::respondCreated([
            'error' => null,
            'messages' => [
                'success' => 'News successfully created',
            ],
        ]);
    }
}
