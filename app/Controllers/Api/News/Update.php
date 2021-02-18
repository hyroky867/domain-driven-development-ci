<?php

declare(strict_types=1);

namespace App\Controllers\Api\News;

use App\Controllers\Api\ApiController;
use App\Models;
use CodeIgniter\HTTP\Response;

class Update extends ApiController
{
    public function exec(int $id): Response
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
        $news = $model->find($id);
        if (is_null($news)) {
            return parent::failNotFound();
        }

        $input = $this->request->getRawInput();
        $result = $model->update($id, [
            'title' => $input['title'],
            'slug' => url_title($input['title'], '-', true),
            'body' => $input['body']
        ]);
        if (!$result) {
            return parent::failServerError();
        }

        return parent::respondUpdated([
            'error' => null,
            'messages' => [
                'success' => 'News successfully updated',
            ],
        ]);
    }
}
