<?php
class frontPageEspnnews1 extends Controller_Front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);
		
		$connectDB = new modelSetup();
		$aList = $connectDB->getData();

		$aData = $this->rssContent($aList['pespn_tab_1']);
		$i = 1;
	    $aData1 = array();
		foreach($aData as $key)
		{

			if($i <= $aList['pespn_list_limit'])
			{
				 $aData1[] = array(
                    'title' => $key['title'],
                    'description' => $key['description'],
                    'date' => $key['date'],
                    'link' => $key['link']
                 );
			}
			$i++;
		}
		
		$this->loopFetch($aData1);
		
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

