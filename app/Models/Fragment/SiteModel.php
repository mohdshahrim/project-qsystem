<?php

namespace App\Models\Fragment;

use CodeIgniter\Model;

use App\Models\Fragment\PCModel;

class SiteModel extends Model
{
    protected $DBGroup = 'fragment';

    // hardcoded values for 'site_type'
    public const SITETYPE = [
        "HQ",
        'Regional Office',
        'Subregional Office',
    ];

    // hardcoded values for 'city'
    public const CITY = [
        "Kuching",
        "Sarikei",
        "Tanjung Manis",
        "Sibu",
        "Kapit",
        "Bintulu",
        "Miri",
        "Limbang",
        "Lawas",
    ];


    protected $table            = 'site';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'site_id',
        'site_name',
        'site_type',
        'address', 
        'city',
        'oic',
        'created_at',
        'updated_at',
        'deleted_at'
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
    protected $afterDelete    = ['defaultSiteID'];

    // set id to "1" for tables that dependent on site_id
    protected function defaultSiteID(array $data)
    {
        $pcModel = new PcModel();
        $pcModel->whereIn('site', $data['id'])->set(['site'=>1])->update();
    }
}
