<?php
class modelSetup extends modelSample
{
	public function getData()
	{
		$sQuery = "SELECT * FROM espnnews_settings";
		return $this->query($sQuery);
	}
	
	public function insertContents($aData)
	{
		
		$sQuery = "INSERT INTO espnnews_settings(pespn_tab_1, pespn_tab_2, pespn_tab_3, pespn_list_limit)
				   VALUES('".$aData['pg_espn_cat_sel_1']."', '".$aData['pg_espn_cat_sel_2']."', '".$aData['pg_espn_cat_sel_3']."', '".$aData['pg_espn_display_limit']."' )";
		return $this->query($sQuery);
		
	}
	
	public function updateContents($aData)
	{
		$sQuery = "UPDATE espnnews_settings SET pespn_tab_1='".$aData['pg_espn_cat_sel_1']."', pespn_tab_2='".$aData['pg_espn_cat_sel_2']."', pespn_tab_3='".$aData['pg_espn_cat_sel_3']."', 
					pespn_list_limit='".$aData['pg_espn_display_limit']."'";
		return $this->query($sQuery);
	}
	
	
}