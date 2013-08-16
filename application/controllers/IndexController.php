<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
                                        $courses = new Application_Model_DbTable_Courses();
                                        $this->view->courses = $courses->fetchAll();
                                        
                                        $coursevideos = new Application_Model_DbTable_Videos();
                                        $this->view->coursevideos = $coursevideos->fetchAll();
                                        //$this->view->data = $courses->addCoursesFromXls();
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









