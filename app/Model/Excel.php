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

	function __construct($excelFile=null)//默认传入excel.xls方便注入，不然无法注入
	{
		if ($excelFile) {
			Global $exce;
			$exce = $excelFile;
			$this->excelFile = $excelFile;
			$this->import =app()->make("\App\Model\SalaryListImport");
			$this->setDate();
			$this->title = $this->getTitle();
		}

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


    /**
    
    	TODO:插入数据库 海没开始用
    	- First todo item
    	- Second todo item
    
     */
    
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
		return $this;
	}
	/**
	 *
	 * 以下是导出的时候才用的方法
	 * $excel->setViewName('guzzle.preview')->setViewData(compact('collection'))->export();
	 *
	 */
	private $viewName;
	private $viewDate;

	public function exportBlade($blade,$data)
	{
		if (\Input::has('export')) {
			$this->setViewName($blade)->setViewData($data)->export($blade);
		} else {
			return view($blade, $data);
		}
	}

	public function export($blade)
	{	
		$data = $this->viewData;
        \Excel::create($this->viewName, function($excel) use($data,$blade) {
        $excel->sheet($this->viewName, function($sheet) use($data,$blade){
        $sheet->loadView($blade,$data);
        })->export('xls');
        });	   
    }


	public function setViewName($viewName)
	{
		$this->viewName = $viewName;
		return $this;
	}

	public function setViewData($viewData)
	{

		$this->viewData = $viewData;
			//dd($this->viewData);
		return $this;
	}



	        
	

   
}
