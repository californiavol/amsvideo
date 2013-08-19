<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initTimeZone() {
        date_default_timezone_set('America/Los_Angeles');
    }
    
	protected function _initLog()
	{
		if ($this->hasPluginResource("log")) {
			$r = $this->getPluginResource("log");
			$log = $r->getLog();
			Zend_Registry::set('log', $log);
		}
	}
}

