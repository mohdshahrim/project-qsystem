<?php

namespace App\Models\Fragment;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $DBGroup = 'fragment';

    // CUSTOM PROPERTIES
    // Other tables/models that rely on this table/model
    protected $childTables = ['PCModel', 'SiteModel'];

    protected $table            = 'staff';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['staff_id', 'fullname', 'telno', 'email', 'birthdate', 'age', 'designation', 'department',  'site', 'created_at', 'updated_at', 'deleted_at'];

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
    protected $afterFind      = ['updateStaffAge']; // WARNING: BAD PRACTICE, could jam the whole system because of frequent updates!
    protected $beforeDelete   = [];
    protected $afterDelete    = ['setDefaultForChild'];

    // Function to set default row (id 1) to any affected child (refer ) during Delete
    public function setDefaultForChild(array $data)
    {
        // test
        log_message('error', "here is the id ".$data['id'][0]);
    }

    public function updateStaffAge(array $data)
    {
        if (empty($data['data'])) {
            return $data;
        }

        // check if retrieved single row or multiple rows
        if (isset($data['data']['id'])) {
            //
            $age = $this->calculateAge($data['data']['birthdate']);
        } else {
            //
            foreach ($data['data'] as &$row) {
                // WARNING: be careful when using PHP Reference "&" above
                $row['age'] = $this->calculateAge($row['birthdate']);
            }
        }

        return $data;
    }

    public function calculateAge($birthdate)
    {
        $birth_year = (Integer)substr($birthdate, 0, 4);
        $current_year = (Integer)date("Y");
        return $current_year - $birth_year;
    }
}
