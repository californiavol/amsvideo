<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	if ($this->getRequest()->getParam('cid')) {
    		$this->courseId = $this->getRequest()->getParam('cid');;
    	}
    	
    	if ($this->getRequest()->getParam('vid')) {
    		$this->videoId = $this->getRequest()->getParam('vid');;
    	}
    	
    	//get db tables
    	$this->coursesTable = new Application_Model_DbTable_Courses();
    	
    	$this->videosTable = new Application_Model_DbTable_Videos();
    	
    }

    public function indexAction()
    {
        // action body
        if ($this->courseId) {
        	//get all courses for course list
        	$this->view->courses = $this->coursesTable->getCourses();
        	
        	//get individual course if courseId param set
        	$this->view->course = $this->coursesTable->getCourseById($this->courseId);;
			
        	//get videos by courseId
        	$this->view->coursevideos = $this->videosTable->getVideosByCourseId($this->courseId);
        	
        	//get most recent video by date and courseId
        	$this->view->recentvideo = $this->videosTable->getMostRecentVideo($this->courseId);        
        } else {
        	//get all courses
	        $this->view->courses = $this->coursesTable->getCourses();
	        
	        //get most video for each course
	        $this->view->coursevideos = $this->videosTable->getMostRecentCourseVideoAllCourses();
        }
        

        
        if ($this->videoId) {
        	$this->view->video = $this->videosTable->getVideoById($this->videoId);
        } 
        
       
    }

    public function live1Action()
    {
        // action body
    }

    public function live2Action()
    {
        // action body
    }

    public function live3Action()
    {
        // action body
    }

    public function live4Action()
    {
        // action body
    }


}









