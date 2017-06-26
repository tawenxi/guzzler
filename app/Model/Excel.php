<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Command;

class Excel extends Model
{
	private $excelFile;
	private $import;
	public $title;
	public $skipNum;

	function __construct($excelFile)
	{
		Global $exce;
		$exce = $excelFile;
		$this->excelFile = $excelFile;
		$this->import =app()->make("\App\SalaryListImport");
		$this->setDate();
		$this->title = $this->getTitle();
		$this->setSkipNum();
	}
	public function getTitle()
	{
		return $this->import->first()->keys()->toArray();
	}

	private function setDate()
	{
	    $this->import = $this->import->setDateColumns(array(
        'created_at',
        'updated_at',
        'date'));
	}

	public function getExcel()
	{
		$skip = empty($this->skipNum)?100000:$this->skipNum;
		return $this->import->skipRows($skip)->takeRows(2000)->get($this->title);
	}



	public function insertSql()
	{
		$this->getExcel()->map(function($v){
        static $i;
        \DB::table($this->excelFile.'s')->insert($v->toArray());
        $i++;
      });
	}

	public function setSkipNum()
	{
		$this->skipNum=$this->import->calculate()->first()->amount;
	}
	

   
}
