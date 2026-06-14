<?php

namespace App\Models\Fragment;

use CodeIgniter\Model;

class PrinterModel extends Model
{
    protected $DBGroup = 'fragment';

    public const PRINTER_TYPES = [
        'Inkjet',
        'Laser',
        'Dot Matrix',
        'Multifunction',
        'Scanner',
    ];

    protected $table            = 'printer';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['serial_no', 'model', 'nickname', 'printer_type', 'host', 'ip_address', 'is_rental', 'notes', 'site', 'created_at', 'updated_at', 'deleted_at'];

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

    public function getPrinter()
    {
        return $this->select('
            printer.id,
            printer.serial_no,
            printer.model,
            printer.nickname,
            printer.printer_type,
            printer.host,
            printer.ip_address,
            printer.is_rental,
            printer.site,
            printer.notes,
            printer.created_at,
            printer.updated_at,
            printer.deleted_at,
            site.site_id,
        ')
        ->join('site','site.id = printer.site', 'left')
        ->limit(-1,1)
        ->findAll();
    }

    public function getPrinterBySite($site_id)
    {
        return $this->select('
            printer.id,
            printer.serial_no,
            printer.model,
            printer.nickname,
            printer.ip_address,
            printer.printer_type,
            printer.host,
            printer.site,
            printer.is_rental,
            printer.notes,
            printer.created_at,
            printer.updated_at,
            printer.deleted_at,
            site.site_id,
            pc.hostname,
        ')
        ->join('site','site.id = printer.site', 'left')
        ->join('pc','pc.id = printer.host', 'left')
        ->where('printer.site', $site_id)
        ->findAll();
    }

    public function getPrinterByID($id)
    {
        return $this->select('
            printer.id,
            printer.serial_no,
            printer.model,
            printer.nickname,
            printer.ip_address,
            printer.printer_type,
            printer.host,
            printer.site,
            printer.is_rental,
            printer.notes,
            printer.created_at,
            printer.updated_at,
            printer.deleted_at,
            site.site_id,
            pc.hostname,
        ')
        ->join('site','site.id = printer.site', 'left')
        ->join('pc','pc.id = printer.host', 'left')
        ->find($id);   
    }
}
