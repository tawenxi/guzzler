<?php

namespace App\Model\Respostory;

use Illuminate\Database\Eloquent\Model;

class UserListImport extends \Maatwebsite\Excel\Files\ExcelFile {

	protected $delimiter  = ',';
    protected $enclosure  = '"';
    protected $lineEnding = '\r\n';


    public function getFile()
    {
        return storage_path('excel/excel.xls');
    }

    public function getFilters()
    {
        return [
            'chunk'
        ];
    }

}
