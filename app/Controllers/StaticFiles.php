<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\FragmentSettingPCModel;
use App\Models\FragmentPCModel;
use App\Models\FragmentOfficeModel;
use App\Models\FragmentDeviceModel;
use App\Models\FragmentPicture;

define('FRAGMENT_VERSION_NO', '1.0');
define('FRAGMENT_VERSION_DATE', '29/04/2025');

class StaticFiles extends BaseController
{
    public function serveFragment($filename)
    {
        $filepath = WRITEPATH . 'uploads/fragment/' . $filename;
        
        // Check if file exists
        if (!file_exists($filepath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        // Get file mime type
        $mime = mime_content_type($filepath);
        
        // Set headers and output file
        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setBody(file_get_contents($filepath));
    }
}