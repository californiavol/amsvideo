<?php

class Application_Model_DbTable_Videos extends Zend_Db_Table_Abstract
{

    protected $_name = 'videos';
    
    public function init()
    {
    	$this->today = new Zend_Date();
    }    
    
    public function addVideosFromXls()
    {
    	return $this->_addVideos();
    }   

    public function getVideos()
    {
    	
    }
    
    public function getVideoById($id)
    {
		if ($id == NULL) {
			return;
		}
    	$row = $this->fetchRow($this->select()->where('id = ?', $id));
		return $row;
    	
    }
    
    public function getVideosByCourseId($id)
    {
		$rows = $this->fetchAll($this->select()->where('course_id = ?', $id));
		return $rows;
    }
    
    public function getMostRecentCourseVideoAllCourses()
    {
		$rows = $this->fetchAll($this->select()
    	->where('start_dt <= ?', $this->today)
    	->group('course_id')
    	->order('start_dt ASC')		
		);
		return $rows;    	
    }
    
	public function getMostRecentVideo($id)
	{
		if ($id == NULL) {
			return;
		}
		
		$row = $this->fetchRow($this->select()
    	->where('course_id = ?', $id)
    	->where('start_dt <= ?', $this->today)
    	->order('start_dt ASC')
    	->limit(1)
    	);
    	
		return $row;
	}    
    
    
    public function createRssPlaylist()
    {
    	
		$file = APPLICATION_PATH . '/../data/playlists/playlist.rss';
		
		$title = 'my title';
		$desc = 'my description';
		
		$rss = "";
		$rss .= '<rss version="2.0" xmlns:jwplayer="http://rss.jwpcdn.com/">';
    	$rss .= '<channel>';
		$rss .= '<item>';
		$rss .= '<title>'.$title.'</title>';
		$rss .= '<description>'.$desc.'</description>';
		$rss .= '<jwplayer:image>http://www.csus.edu/cached/Colleges/2.0/assets/media/billboard/billboard-default.png</jwplayer:image>';
		$rss .= '<jwplayer:source file="http://video2.csus.edu/vod/prj/disted/ams_web_archive/2013/TESTs1/TESTs1_2013_08_09P.f4m" label="rtmp" />';
		$rss .= '<jwplayer:source file="http://video2.csus.edu/hds-vod/prj/disted/ams_web_archive/2013/TESTs1/TESTs1_2013_08_09M.f4m" label="f4v m3u8" />';
		$rss .= '<jwplayer:source file="http://video2.csus.edu/hls-vod/prj/disted/ams_web_archive/2013/TESTs1/TESTs1_2013_08_09M.m3u8" label="mp4 m3u8" />';
	  	$rss .= '</item>';
	  	
	  	$rss .= '</channel>';
		$rss .= '</rss>';
	
	

		// Write the contents back to the file
		file_put_contents($file, $rss);

    }


	private function _addVideos()
	{
		//load the excel parser
		error_reporting(E_ALL ^ E_NOTICE);
		require_once APPLICATION_PATH . '/../library/vendors/php-excel-reader-2.21/excel_reader2.php';
		
		$xlsPath = APPLICATION_PATH . '/../data/cms/videos.xls';
		
		$xlsData = new Spreadsheet_Excel_Reader($xlsPath);
		//return $xlsData->dump(true,true);
		
		//start at row 2 so as not to include the headers
		for ($row=2; $row<=$xlsData->rowcount(); $row++) 
		{         
			$vals = array();
			for ($col=1;$col<=$xlsData->colcount();$col++) {         
				$vals[] = $xlsData->value($row,$col);	
	
	        }
			
			$data = array(
		            'start_dt'      => $vals[0],
		            'days'          => $vals[1],
					'studio'        => $vals[2],
					'start_time'    => $vals[3],
					'duration'      => $vals[4],
					'name'          => $vals[5],
					'class_section' => $vals[6],
					
		        );  			

                              
		   $this->insert($data); 	
    	}
    	
	}    
    
    
}