<?php

class Application_Model_DbTable_Courses extends Zend_Db_Table_Abstract
{

    protected $_name = 'courses';
    
    public function addCoursesFromXls()
    {
    	return $this->_addCourses();
    }
    
	private function _addCourses()
	{
		//load the excel parser
		error_reporting(E_ALL ^ E_NOTICE);
		require_once APPLICATION_PATH . '/../library/vendors/php-excel-reader-2.21/excel_reader2.php';
		
		$xlsPath = APPLICATION_PATH . '/../data/cms/Course_Details.xls';
		
		$xlsData = new Spreadsheet_Excel_Reader($xlsPath);
		//return $xlsData->dump(true,true);
		for ($row=2; $row<=$xlsData->rowcount(); $row++) 
		{         
			$vals = array();
			for ($col=1;$col<=$xlsData->colcount();$col++) {         
				$vals[] = $xlsData->value($row,$col);	
	
	        }
			
			$data = array(
		            'course_name'   => $vals[0],
		            'course_number' => $vals[1],
					'section'       => $vals[2],
					'description'   => $vals[3],
					'instructor'    => $vals[4],
					'semester'      => $vals[5],
					'year'          => $vals[6],
					'course_id'     => $vals[7],
					'class_number'  => $vals[8],
		        );  			

                              
		   $this->insert($data); 	
    	}
    	
	}


}

