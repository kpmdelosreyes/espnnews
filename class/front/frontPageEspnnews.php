<?php
class frontPageEspnnews extends Controller_Front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		usbuilder()->init($this, $aArgs);

		$aList = common()->modelContents()->getData();

		$this->assign('pespn_list_limit', $aList['pespn_list_limit']);
		
	}
}
