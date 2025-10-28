<?php

namespace App\Models;

use CodeIgniter\Model;
use DOMDocument;
use DOMXPath;

class EcModel extends Model
{
    protected $table            = '';
    protected $primaryKey       = '';
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
    protected $useTimestamps = false;
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

	public function getNameList()
	{
        $strhtml = $this->scrapEleave();
        $pattern = '/<li>(.*?)<\/li>/';
        preg_match_all($pattern, $strhtml, $matches);
        return $matches[1];
	}

    private function scrapEleave()
    {
        $url = "202.171.33.53/eleave/checklogin.php"; // The POST URL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1');
        curl_setopt($ch, CURLOPT_REFERER, '');
        curl_getinfo($ch, CURLINFO_COOKIELIST);
        $arr = array('uID' => 'shahrimb', 'uPW' => '1146', 'Submit' => 'Login');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
        $result = curl_exec($ch);
        curl_close($ch);

        if ($result) {
            preg_match('/PHPSESSID=([^;]+)/', $result, $matches);
            $phpSessionID = $matches[1] ?? '';
    
            if ($phpSessionID) {
                $differentURL = "202.171.33.53/eleave/home/adm/main.php";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $differentURL);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $headers = array(
                    "GET /eleave/shome.php HTTP/1.1",
                    "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
                    "Accept-Encoding: gzip, deflate, br",
                    "Accept-Language: en-US,en;q=0.9,ja;q=0.8,ms;q=0.7,id;q=0.6",
                    "Cache-Control: max-age=0",
                    "Connection: keep-alive",
                    "Cookie: language=en; rowperpage=300; dateFormat=d%2Fm%2FY; cCode=HARWOOD; PHPSESSID=".$phpSessionID."; eleave=true; loggedin=true; user=1146",
                    "DNT: 1",
                    "Host: 202.171.33.53",
                    "Sec-Fetch-Dest: document",
                    "Sec-Fetch-Mode: navigate",
                    "Sec-Fetch-Site: same-origin",
                    "Sec-Fetch-User: ?1",
                    "Upgrade-Insecure-Requests: 1",
                    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36",
                    "sec-ch-ua: 'Not/A)Brand';v='99', 'Google Chrome';v='115', 'Chromium';v='115'",
                    "sec-ch-ua-mobile: ?0",
                    "sec-ch-ua-platform: 'Windows'",
                );
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_HEADER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                //echo "<textarea rows=11 cols=50>".$response."</textarea>";
                // refine the result
                // Create a DOMDocument instance
                $dom = new DOMDocument();
                libxml_use_internal_errors(true); // Ignore any HTML parsing errors
                $dom->loadHTML($response);
                libxml_use_internal_errors(false);
    
                // Find the table element with class "tblMyProfile"
                $xpath = new DOMXPath($dom);
                $tableClassName = "tblMyProfile";
                $tables = $xpath->query("//table[contains(@class, '$tableClassName')]");
                
    
                // Process the found tables (if any)
                if ($tables->length > 0) {
                    // Assuming you want to store the table content in a variable
                    return $dom->saveXML($tables->item(0));
                } else {
                    echo "No table with class '$tableClassName' found.";
                }
                //
            } else {
                echo "Failed to retrieve PHP session value.";
            }
        } else {
            echo "Failed to login.";
        }
    }
}
