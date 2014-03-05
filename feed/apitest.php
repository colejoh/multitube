<html>
	<head>
		<title>Feed</title>
		<link rel="stylesheet" type="text/css" href="http://colejoh.com/multitube/global.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,900' rel='stylesheet' type='text/css'>
		<script src="newmulti.js"></script>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	</head>
	<body>
	<?php
		$test = "Iamthefarmer";			 
		$xml = simplexml_load_file("http://gdata.youtube.com/feeds/api/users/$test/uploads?v=2&max-results=10");
		foreach ($xml->entry as $entry){
			$uploader = $entry->author->name;
			$title = $entry->title;
			$description = $entry->media->media;
			
			$media = $entry->children( 'http://search.yahoo.com/mrss/' );
			$thumbnail = $media->thumbnail;
			
			echo $thumbnail;
			
		?>
			<div class="entry"> 
				<a href="http://youtube.com/<?php echo $uploader;?>">
				<?php
				echo $uploader;
				?></a> uploaded a video:
				<div id="videotitle">
					<?php echo $title; ?>
				</div>
				<div id="description">
					<?php echo($description);?>
				</div>
				<div id="thumb">
					<img src="<?php echo $thumbnail;?>"/>
					<?php
						echo("thumbnail, $thumbnail");
					?>
				</div>
			</div>
			<?php
		}			
		?>
	</body>
</html>