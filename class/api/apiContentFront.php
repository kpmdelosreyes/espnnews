<?php
class apiContentFront extends Controller_Api
{
	protected function post($aArgs)
	{
		require_once 'util/feed.php';
		$oFeed = new BbcnewsUtilFeed();
		$aCategory = $oFeed->category();

		foreach($aCategory as $key=>$val) {
			$_iKey = array_search($aArgs["ctgry"], $val);
		
			if($_iKey) $iKey = $key;
		}
		
		$sLink = $aCategory[$iKey]['link'];

		$aNews = $oFeed->parseRss($sLink);

		$aResponse = array('news' => $aNews);
		
		return $aResponse;
				
	}
}