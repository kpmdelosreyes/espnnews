<?php
class frontPageEspnnewsEvt1 extends Controller_Front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
				
		$this->assign('event_img1', "../_sdk/img/espnnews/pg_tree_p.gif");
		$this->assign('event_img2', "../_sdk/img/espnnews/pg_tree_m.gif");
		$this->assign('event_plus', "frontPageDisplay.plus");
		$this->assign('event_minus', "frontPageDisplay.minus");
		
	}
	
	
		
}


