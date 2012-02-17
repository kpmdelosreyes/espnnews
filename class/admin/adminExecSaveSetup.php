<?php
class adminExecSaveSetup extends Controller_AdminExec
{
	
	protected function run($aArgs)
	{
		
		require_once('builder/builderInterface.php');
		usbuilder()->init($this, $aArgs);

		$check = common()->modelContents()->getData();
		
		if($check)
		{
			$bResult = common()->modelContents()->updateContents($aArgs);
			
			if ($bResult !== false) {
				usbuilder()->message('Saved succesfully', 'success');
			} else {
				usbuilder()->message('Save failed', 'warning');
			}
		}
		else
		{
			$bResult = common()->modelContents()->insertContents($aArgs);
			
			if ($bResult !== false) {
				usbuilder()->message('Saved succesfully', 'success');
			} else {
				usbuilder()->message('Save failed', 'warning');
			}
		}
			
		$sUrl = usbuilder()->getUrl('adminPageSetup');
		usbuilder()->jsMove($sUrl);
		
	}
}