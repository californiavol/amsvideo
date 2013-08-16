<rss version="2.0" xmlns:jwplayer="http://rss.jwpcdn.com/">
    <channel>
<?php

include('DataSource.php');

include('rss_php.php');

$csv = new File_CSV_DataSource;
  
// tell the object to parse a specific file
if ($csv->load('classes.csv')) {

	if (!$csv->isSymmetric()) {
		die('file has headers and rows with different lengths cannot connect');
	}
	
	//var_export($csv->connect());
	
	$array = $csv->connect();
}


foreach($array as $a) {
		
		$start = $a['Start'];
		$start = str_replace('/', '_', $start);
		$end = $a['End'];
		$day = $a['Day'];
		$studio = $a['Studio'];
		$starttime = $a['Start_time'];
		$name = $a['Name'];
		$duration = $a['Duration'];
		
		
	echo '<item>';
	echo '<title>'.$day.'</title>';
	echo '<description>'.$a["start"].'</description>';
	echo '<jwplayer:image>http://www.csus.edu/cached/Colleges/2.0/assets/media/billboard/billboard-default.png</jwplayer:image>';
	echo '<jwplayer:source file="rtmp://media.music.csus.edu/vod/mp4:2012_11_02_fenam_B_01.f4v" label="rtmp" />';
	echo '<jwplayer:source file="http://media.music.csus.edu/hls-vod/2012_fenam/2012_11_02_event/2012_11_02_fenam_B_01.f4v.m3u8" label="f4v m3u8" />';
	echo '<jwplayer:source file="http://media.music.csus.edu/hls-vod/2012_fenam/2012_11_02_event/2012_11_02_fenam_B_01.mp4.m3u8" label="mp4 m3u8" />';
	echo '<jwplayer:source file="http://media.music.csus.edu/hds-vod/2012_fenam/2012_11_02_event/2012_11_02_fenam_B_01.f4v.f4m" label="f4m" />';
  	echo '</item>';
		
		
		
}

//var_dump($array[0]['Start']);
/*
* convert array into rss feed

array (
  0 => 
  array (
    'Start' => '9/9/13',
    'End' => '12/9/13',
    'Day' => 'Monday',
    'Studio' => '3',
    'Start_time' => '12:00',
    'Name' => 'ANTH001',
    'Duration' => '1:15:00',
  ),
  1 => 
  array (
    'Start' => '9/4/13',
    'End' => '12/11/13',
    'Day' => 'Wednesday',
    'Studio' => '3',
    'Start_time' => '12:00',
    'Name' => 'ANTH001',
    'Duration' => '1:15:00',
  ),
  <item>
	<title>Mon Jun 5</title>
	<description>AMS Server</description>
	<jwplayer:image>http://www.csus.edu/cached/Colleges/2.0/assets/media/billboard/billboard-default.png</jwplayer:image>
	<jwplayer:source file="rtmp://media.music.csus.edu/vod/mp4:2012_11_02_fenam_B_01.f4v" label="rtmp" />
	<jwplayer:source file="http://media.music.csus.edu/hls-vod/2012_fenam/2012_11_02_event/2012_11_02_fenam_B_01.f4v.m3u8" label="f4v m3u8" />
	<jwplayer:source file="http://media.music.csus.edu/hls-vod/2012_fenam/2012_11_02_event/2012_11_02_fenam_B_01.mp4.m3u8" label="mp4 m3u8" />
	<jwplayer:source file="http://media.music.csus.edu/hds-vod/2012_fenam/2012_11_02_event/2012_11_02_fenam_B_01.f4v.f4m" label="f4m" />
  </item>
*/

?>

</channel>
</rss>