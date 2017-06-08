<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SalaryListImport extends \Maatwebsite\Excel\Files\ExcelFile {

	protected $delimiter  = ',';
    protected $enclosure  = '"';
    protected $lineEnding = '\r\n';


    public function getFile()
    {
       
         $file = $_GET['report'];
         
       
        return storage_path("excel/$file.xls");
    }

    public function getFilters()
    {
        return [
            'chunk'
        ];
    }

}
