<?php

namespace App\Models\Pulseman;

use CodeIgniter\I18n\Time;

use CodeIgniter\Model;

class IPModel extends Model
{
    protected $DBGroup = 'pulseman';

    protected $table            = 'ip';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'label',
        'ip_address',
        'description',
        'status',
        'checked_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

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

    public function getAllIP()
    {
        return $this->select('
            ip.id,
            ip.label,
            ip.ip_address,
            ip.description as ip_description,
            ip.status,
            ip.checked_at,
            ip.created_at,
            ip.updated_at,
            ip.deleted_at,
            statuscode.status_code,
            statuscode.description statuscode_description,
        ')
        ->join('statuscode','statuscode.id = ip.status', 'left')
        ->findAll();
    }

    public function checkIPAll()
    {
        $ips = $this->findAll();

        foreach($ips as $key=>$row) {
            $output = shell_exec("ping -n 1 -w 1000 " . escapeshellarg($row['ip_address']));
            $checked_at = Time::now('Asia/Kuala_Lumpur', 'en_US');

            if (str_contains($output, 'Received = 1')) {    
                $this->update($row['id'], ['status'=>1, 'checked_at'=>$checked_at->toDateTimeString()]);
            } else {
                $this->update($row['id'], ['status'=>2, 'checked_at'=>$checked_at->toDateTimeString()]);
            }

            log_message('error', $output);
        }
    }
}
