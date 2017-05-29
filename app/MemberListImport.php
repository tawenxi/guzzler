<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberListImport extends \Maatwebsite\Excel\Files\ExcelFile {

	protected $delimiter  = ',';
    protected $enclosure  = '"';
    protected $lineEnding = '\r\n';


    public function getFile()
    {
        return storage_path('excel/member.xls');
    }

    public function getFilters()
    {
        return [
            'chunk'
        ];
    }

}
