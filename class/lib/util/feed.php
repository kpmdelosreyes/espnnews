<?php
class EspnUtilFeed
{
    public function __construct(){}

    public function catList()
    {
        return array('News', 'NFL', 'NBA', 'MLB', 'NHL', 'Motorsports', 'Soccer', 'ESPNU', 'College Basketball', 'College Football', 'Action Sports', 'Poker');
    }

    public function category()
    {
        $aCategory = array();

        $aCategory[] = array(
                'name' => 'News',
                'link' => 'http://sports.espn.go.com/espn/rss/news'
        );

        $aCategory[] = array(
                'name' => 'NFL',
                'link' => 'http://sports.espn.go.com/espn/rss/nfl/news'
        );

        $aCategory[] = array(
                'name' => 'NBA',
                'link' => 'http://sports.espn.go.com/espn/rss/nba/news'
        );

        $aCategory[] = array(
                'name' => 'MLB',
                'link' => 'http://sports.espn.go.com/espn/rss/mlb/news'
        );

        $aCategory[] = array(
                'name' => 'NHL',
                'link' => 'http://sports.espn.go.com/espn/rss/nhl/news'
        );

        $aCategory[] = array(
                'name' => 'Motorsports',
                'link' => 'http://sports.espn.go.com/espn/rss/rpm/news'
        );

        $aCategory[] = array(
                'name' => 'Soccer',
                'link' => 'http://soccernet.espn.go.com/rss/news'
        );

        $aCategory[] = array(
                'name' => 'ESPNU',
                'link' => 'http://sports.espn.go.com/espn/rss/espnu/news'
        );

        $aCategory[] = array(
                'name' => 'College Basketball',
                'link' => 'http://sports.espn.go.com/espn/rss/ncb/news'
        );

        $aCategory[] = array(
                'name' => 'College Football',
                'link' => 'http://sports.espn.go.com/espn/rss/ncf/news'
        );

        $aCategory[] = array(
                'name' => 'Action Sports',
                'link' => 'http://sports.espn.go.com/espn/rss/action/news'
        );

        $aCategory[] = array(
                'name' => 'Poker',
                'link' => 'http://sports.espn.go.com/espn/rss/poker/master'
        );

        $aCategory[] = array(
                'name' => 'ESPN Latest Videos',
                'link' => 'http://sports.espn.go.com/broadband/ivp/rss'
        );

        return $aCategory;
    }

    public function parseRss($sLink)
    {
        $sContent = $this->download_page($sLink);

        $oRss = new SimpleXMLElement($sContent);

        $aData = array();
        foreach ($oRss->channel->item as $item)
        {
            $sTitle = (string) $item->title;
            $sDesc = (string) $item->description;
            $sPubDate = (string) $item->pubDate;
            $sLink = (string) $item->link;

            $aData[] = array(
                    'title' => $sTitle,
                    'description' => $sDesc,
                    'date' => $sPubDate,
                    'link' => $sLink
            );
        }

        return $aData; 
    }

    public function download_page($path)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$path);
        curl_setopt($ch, CURLOPT_FAILONERROR,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $retValue = curl_exec($ch);                      
        curl_close($ch);

        return $retValue;
    }
}
