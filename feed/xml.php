<?php
$youtube_feed = simplexml_load_file('http://gdata.youtube.com/feeds/api/users/iamthefarmer/uploads');

foreach ( $youtube_feed->entry as $entry ){
	$namespaces = $entry->getNameSpaces( true );
	$media = $entry->children( $namespaces['media'] );
	$thumbnail = $media->thumbnail;
	echo("$thumbnail $media $namespaces");
}

?>