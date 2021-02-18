<?php

declare(strict_types=1);

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;

class ApiController extends BaseController
{
    use ResponseTrait;

    /**
     * @var string
     */
    protected $format = 'json';

    /**
     * @param array<string, string> $errors
     *
     * @return Response
     */
    public function failValidation(array $errors): Response
    {
        $errors = json_encode($errors);
        if ($errors === false) {
            return $this->failServerError();
        }
        return $this->failValidationError($errors);
    }
}
