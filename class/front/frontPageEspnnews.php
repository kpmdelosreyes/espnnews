<?php
class frontPageEspnnews extends Controller_Front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		
		$connectDB = new modelSetup();
		$aList = $connectDB->getData();

		$this->assign('pespn_list_limit', $aList['pespn_list_limit']);
		
	}
}
