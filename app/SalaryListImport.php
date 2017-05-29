<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryListImport extends \Maatwebsite\Excel\Files\ExcelFile {

	protected $delimiter  = ',';
    protected $enclosure  = '"';
    protected $lineEnding = '\r\n';


    public function getFile()
    {
        return storage_path('excel/salary.xls');
    }

    public function getFilters()
    {
        return [
            'chunk'
        ];
    }

}
