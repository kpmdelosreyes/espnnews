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
		$this->importCSS('espn.front.gray');
		$this->importJS('espn.front');
		
		/* $aOrder = array();
		foreach($aList as $key=>$val) {
			
			
			$sClass = $key == 0 ? "on" : "off";
			if($val == "College Football")
			{
				$sText = "College Footb...";
			}
			else if($val == "College Basketball")
			{
				$sText = "College Bask...";
			}
			else if($val == "Action Sports")
			{
				$sText = "Action Spor...";
			}
			else
			{
				$sText = $val;
			}
		
			$aOrder[] = array(
					'class' => $sClass,
					'label' => $val,
					'text' => $sText
			);
		} */
		
		$this->writeJs("frontPageDisplay.getNews('".$aList[0]['pespn_tab_1']."');");
		
		$this->loopFetch($aList);

		
	}
	
	public function rssContent($sCat)
	{
		require_once 'util/feed.php';
		$getCurl = new EspnUtilFeed();
		$aCategory = $getCurl->category();
	
		foreach($aCategory as $key=>$val) {
			$_iKey = array_search($sCat, $val);

			if($_iKey) $iKey = $key;
		}

		$sLink = $aCategory[$iKey]['link'];
		
		$aNews = $getCurl->parseRss($sLink);
		
		return $aNews;
	}
	
		
}


