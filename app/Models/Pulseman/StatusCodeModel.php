<?php

namespace App\Models\Pulseman;

use CodeIgniter\Model;

class StatusCodeModel extends Model
{
    protected $DBGroup = 'pulseman';

    // STATUS CODES
    public const CODES = [
        [0, 'UNKNOWN', 'Not checked yet'],
        [1, 'UP', 'Host is up'],
        [2, 'DOWN', 'Host is down'],
        [3, 'TIMEOUT', 'No response within the allowed time window'],
        [4, 'UNREACHABLE', 'Network-level failure (routing issue)'],
        [5, 'ERROR', 'The check itself failed'],
    ];

    protected $table            = 'statuscode';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
