<?php

namespace App\Models\Fragment;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $DBGroup = 'fragment';

    protected $table            = 'staff';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
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
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getStaff($id)
    {
        return $this->db->table('staff')
            ->select('staff.id, staff.staff_id, staff.fullname, staff.telno, staff.email, staff.birthdate, staff.age, staff.designation, staff.department, staff.site, site.site_id, site.site_name, staff.created_at, staff.updated_at, staff.deleted_at,')
            ->join('site','site.id = staff.site', 'left')
            ->where('staff.id', $id)
            ->get()
            ->getResultArray()[0];
    }

    public function getStaffs()
    {
        return $this->db->table('staff')
            ->select('staff.id, staff.staff_id, staff.fullname, staff.telno, staff.email, staff.birthdate, staff.age, staff.designation, staff.department, staff.site, site.site_id, site.site_name, staff.created_at, staff.updated_at, staff.deleted_at,')
            ->where('staff.id !=', 1) // always skip the id 1 because it is dummy row
            ->join('site','site.id = staff.site', 'left')
            ->get()
            ->getResultArray();
    }
}
