<?php
class frontPageEspnnewsEvt2 extends Controller_Front
{
	
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		usbuilder()->init($this, $aArgs);
		
		$this->assign('event_img1', "../_sdk/img/espnnews/pg_tree_p.gif");
		$this->assign('event_img2', "../_sdk/img/espnnews/pg_tree_m.gif");
		$this->assign('event_plus', "frontPageDisplay.plus");
		$this->assign('event_minus', "frontPageDisplay.minus");
	
	}
}