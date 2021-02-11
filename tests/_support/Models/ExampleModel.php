<?php

declare(strict_types=1);

namespace Tests\Support\Models;

use CodeIgniter\Model;

class ExampleModel extends Model
{
    protected $table = 'factories';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    // @phpstan-ignore-next-line
    protected $allowedFields = [
        'name',
        'uid',
        'class',
        'icon',
        'summary',
    ];

    protected $useTimestamps = true;

    // @phpstan-ignore-next-line
    protected $validationRules = [];

    // @phpstan-ignore-next-line
    protected $validationMessages = [];
    protected $skipValidation = false;
}
