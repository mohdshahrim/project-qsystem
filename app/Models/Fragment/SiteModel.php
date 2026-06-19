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
    // references: https://www.sarawak.gov.my/web/home/article_apps_view/229/188/?id=229&lang=en&swkid_auth
    public const CITY = [
        "Kuching",
        "Bau",
        "Lundu",
        "Samarahan",
        "Asajaya",
        "Simunjan",
        "Sebuyau",
        "Gedong",
        "Serian",
        "Siburan",
        "Tebedu",
        "Sri Aman",
        "Lingga",
        "Pantu",
        "Lubok Antu",
        "Betong",
        "Saratok",
        "Pusa",
        "Kabong",
        "Sarikei",
        "Meradong",
        "Pakan",
        "Julau",
        "Sibu",
        "Kanowit",
        "Selangau",
        "Mukah",
        "Dalat",
        "Daro",
        "Matu",
        "Tanjung Manis",
        "Bintulu",
        "Sebaoh",
        "Tatau",
        "Kapit",
        "Belaga",
        "Song",
        "Bukit Mabong",
        "Miri",
        "Subis",
        "Beluru",
        "Marudi",
        "Telang Usan",
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
    protected $afterDelete    = [];

    public function getSiteCount()
    {
        return $this->countAllResults() - 1; // NOTE: to skip the very first row
    }
}
