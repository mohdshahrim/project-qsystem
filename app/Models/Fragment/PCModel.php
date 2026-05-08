<?php

namespace App\Models\Fragment;

use CodeIgniter\Model;

class PCModel extends Model
{
    protected $DBGroup = 'fragment';

    protected $table            = 'pc';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['hostname', 'asset_no', 'serial_no', 'model', 'os', 'ip_address', 'computer_type', 'assigned_user', 'site', 'physical_location', 'notes', 'created_at', 'updated_at', 'deleted_at'];

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

    public function getPC()
    {
        return $this->select('
            pc.id,
            pc.hostname,
            pc.asset_no,
            pc.serial_no,
            pc.model,
            pc.os,
            pc.ip_address,
            pc.computer_type,
            pc.assigned_user,
            pc.site,
            pc.physical_location,
            pc.notes,
            pc.created_at,
            pc.updated_at,
            pc.deleted_at,
            staff.fullname,
        ')
        ->join('staff','staff.id = pc.assigned_user', 'left')
        ->limit(-1,1)
        ->findAll();
    }

    public function getPCBySite($site_id)
    {
        return $this->select('
            pc.id,
            pc.hostname,
            pc.asset_no,
            pc.serial_no,
            pc.model,
            pc.os,
            pc.ip_address,
            pc.computer_type,
            pc.assigned_user,
            pc.physical_location,
            pc.notes,
            pc.created_at,
            pc.updated_at,
            pc.deleted_at,
            site.site_id,
            staff.fullname,
        ')
        ->join('site','site.id = pc.site', 'left')
        ->join('staff','staff.id = pc.assigned_user', 'left')
        ->where('pc.site', $site_id)
        ->findAll();
    }
}
