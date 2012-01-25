<?php
class adminPageSetup extends Controller_Admin
{
	
	protected function run($aArgs)
	{
		require_once('builder/builderInterface.php');
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		
		$sFormScript = usbuilder()->getFormAction('espnnews_save','adminExecSaveSetup');
		$this->writeJs($sFormScript);
		
		usbuilder()->validator(array('form' => 'espnnews_save'));
		$this->category();
		 
		$this->importJS('espn.admin');
		$this->importCSS('espn.admin');
		
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