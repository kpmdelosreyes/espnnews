<?php
class frontPageEspnnewsTabs extends Controller_Front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		usbuilder()->init($this, $aArgs);
		
		$aList = common()->modelContents()->getData();
		$this->importJS('espn.front');
		$this->importCSS('espn.front.gray');
				
		$this->assign('pespn_tab_1', $aList['pespn_tab_1']);
		$this->assign('pespn_tab_2', $aList['pespn_tab_2']);
		$this->assign('pespn_tab_3', $aList['pespn_tab_3']);
		
		$this->assign('event_tab_1', "frontPageDisplay.tab1();");
		$this->assign('event_tab_2', "frontPageDisplay.tab2();");
		$this->assign('event_tab_3', "frontPageDisplay.tab3();");
		
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


