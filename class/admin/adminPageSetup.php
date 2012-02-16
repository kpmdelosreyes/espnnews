<?php
class adminPageSetup extends Controller_Admin
{
	
	protected function run($aArgs)
	{
		require_once('builder/builderInterface.php');
		usbuilder()->init($this, $aArgs);
		
		usbuilder()->getFormAction('espnnews_save','adminExecSaveSetup');
		
		usbuilder()->validator(array('form' => 'espnnews_save'));
		$this->category();
		 
		$this->importJS('espn.admin');
		$this->importCSS('espnnews.admin');
		
	    $this->View(__CLASS__);
		
	}
	
	public function category()
	{
		require_once 'util/feed.php';
		$feedContents = new EspnUtilFeed();
		$oFeed = $feedContents->catList();
		
		$this->assign("category" , $oFeed);
	}
	
}