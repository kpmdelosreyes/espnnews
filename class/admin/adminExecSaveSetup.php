<?php
class adminExecSaveSetup extends Controller_AdminExec
{
	
	protected function run($aArgs)
	{
		
		require_once('builder/builderInterface.php');
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		
	
		$oModelContents = new modelSetup();
		$check = $oModelContents->getData();
		
		if($check)
		{
			$bResult = $oModelContents->updateContents($aArgs);
			
			if ($bResult !== false) {
				usbuilder()->message('Saved succesfully', 'success');
			} else {
				usbuilder()->message('Save failed', 'warning');
			}
		}
		else
		{
			$bResult = $oModelContents->insertContents($aArgs);
			
			if ($bResult !== false) {
				usbuilder()->message('Saved succesfully', 'success');
			} else {
				usbuilder()->message('Save failed', 'warning');
			}
		}
		
	
	
		$sUrl = usbuilder()->getUrl('adminPageSetup');
		$sJsMove = usbuilder()->jsMove($sUrl);
		$this->writeJS($sJsMove);
	}
}