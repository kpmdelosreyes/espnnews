<?php
class modelSetup extends modelSample
{
	public function getData($aOption)
	{
		$sQuery = "SELECT * FROM espnnews_settings WHERE seq = " . $aOption['seq'];
		return $this->query($sQuery, "row");
	}
	
	public function insertContents($aData)
	{
		
		$sQuery = "INSERT INTO espnnews_settings(seq, pespn_tab_1, pespn_tab_2, pespn_tab_3, pespn_list_limit)
				   VALUES('".$aData['seq']."','".$aData['pg_espn_cat_sel_1']."', '".$aData['pg_espn_cat_sel_2']."', '".$aData['pg_espn_cat_sel_3']."', '".$aData['pg_espn_display_limit']."' )";
		return $this->query($sQuery);
		
	}
	
	public function updateContents($aData)
	{
		$sQuery = "UPDATE espnnews_settings SET pespn_tab_1='".$aData['pg_espn_cat_sel_1']."', pespn_tab_2='".$aData['pg_espn_cat_sel_2']."', pespn_tab_3='".$aData['pg_espn_cat_sel_3']."', 
					pespn_list_limit='".$aData['pg_espn_display_limit']."' WHERE seq =" .$aData['seq'];
		return $this->query($sQuery);
	}
	
	public function getResultCount($aOption)
	{
		$sQuery = "SELECT count(*) as count FROM espnnews_settings";
		$mResult = $this->query($sQuery);
		return $mResult[0]['count'];
	}
	
	function deleteContentsBySeq($aSeq)
	{
		$sSeqs = implode(',', $aSeq);
		$sQuery = "Delete from espnnews_settings where seq in($sSeqs)";
		$mResult = $this->query($sQuery);
		return $mResult;
	}
	
	
}