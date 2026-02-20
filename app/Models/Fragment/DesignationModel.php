<?php

namespace App\Models\Fragment;

use CodeIgniter\Model;

class DesignationModel extends Model
{
    protected $DBGroup = "fragment";

    protected $table = "designation";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = ["designation_name"];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = "datetime";
    protected $createdField = "created_at";
    protected $updatedField = "updated_at";
    protected $deletedField = "deleted_at";

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}
