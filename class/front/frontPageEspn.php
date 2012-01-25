
















<?php
class frontPageespnnews extends Controller_Front
{
	protected function run($aArgs)
	{
		require_once 'builder/builderInterface.php';
		$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
		$this->writeJs($sInitScript);

		$connectDB = new modelSetup();
		$aList = $connectDB->getData();

		$_aOrder = array();
		foreach($aList as $key)
		{
			$_aOrder[] = array("tab1" => $key['pespn_tab_1'],
					"tab2" => $key['pespn_tab_2'],
					"tab3" => $key['pespn_tab_3'],
					"limit" => $key['pespn_list_limit']
			);
		}

		$aOrder = array();
		foreach($_aOrder as $key => $val) {
			$sClass = $key == 0 ? "on" : "off";

			if($val == "College Football")
			{
				$sText = "College Bask";
			}
			else if($val == "College Football")
			{
				$sText = "College Footb";
			}
			else if($val == "Action Sports")
			{
				$sText = "Action Spo...";
			}
			else {
				$sText = $val;
			}


			$aOrder[] = array(
					'class' => $sClass,
					'text' => $sText,
					'label' => $val

			);
		}

		$aData = $this->rssContent($aOrder[0]['label']['tab1']);

		$sHtml .='<div id="pg_espn">
		<ul class="pg_espn_nav">';

		foreach($aOrder as $key){
			$sHtml .='<li><a href="#" onclick="frontPageDisplay.getNews(\''.$key['label']['tab1'].'\')" id="pg_espn_tab_'.$key['label']['tab1'].'" class="'.$key['class'].'"><span>'.$key['text']['tab1'].'</span></a></li>
			<li><a href="#" onclick="frontPageDisplay.getNews(\''.$key['label']['tab2'].'\')" id="pg_espn_tab_'.$key['label']['tab2'].'" class="'.$key['class'].'"><span>'.$key['text']['tab2'].'</span></a></li>
			<li><a href="#" onclick="frontPageDisplay.getNews(\''.$key['label']['tab3'].'\')" id="pg_espn_tab_'.$key['label']['tab3'].'" class="'.$key['class'].'"><span>'.$key['text']['tab3'].'</span></a></li>';
		}
		$sHtml .='</ul><div class="pg_espn_content_wrap">
		<ul class="pg_espn_contentnews">';

		$count = 1;
		foreach($aData as $key){
			$sHtml .='<li>
			<span style="cursor:pointer;">
			<img src="/_sdk/img/espnnews/pg_tree_p.gif" alt="Plus Sign" onclick="frontPageDisplay.plus(this);"/>
			<img src="/_sdk/img/espnnews/pg_tree_m.gif" alt="Minus Sign" style="display:none" onclick="frontPageDisplay.minus(this);" />
			</span>
			<div class="pg_content">
			<p class="pg_title"><a href="'.$key['link'].'" target="_blank">'.$key['title'].'</a></p>
			<span class="pg_content_date espn_datepost">'.$key['date'].'</span>
			<p class="pg_toggle_content" style="display:none">'.$key['description'].'<br /></p>

			</div>
			<p> <a href="'.$key['link'].'" class="pg_more" target="_blank" style="display:visible">more</a></p>
			</li>

			';

			if($count >= $aOrder[0]['label']['limit'])
				break;
			else
				$count++;

		}
		$sHtml .='</ul></div></div><div id="pg_espn_init_front" /><input type="hidden" name="pg_espn_list_limit" id="pg_espn_list_limit" value="'.$aOrder[0]['label']['limit'].'" /></div>';

		$this->importJS('espn.front');
		$this->importCSS('espn.front.gray');

		$this->assign("espnnews",$sHtml);
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