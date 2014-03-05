<?php
session_start();
if (!isset($_SESSION['LoggedIn'])) {
    die("<script type='text/javascript'>window.location ='http://www.colejoh.com/multitube';</script>");
}
?>
<html>
	<head>
		<title>Feed - MultiTube</title>
		<link rel="stylesheet" type="text/css" href="http://colejoh.com/multitube/global.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,900' rel='stylesheet' type='text/css'>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="script/jquery.js"></script>
		<script type="text/javascript" src="script/multiinserts.js"></script>
	</head>
	<body>
		<header id="feedheader">
			<h1>MultiTube</h1> <div id="feedlogout"><a href="logout.php">Log out</a></div>
		</header>
		<!-- PHP to get the info from the GET -->
		<?php
			$email = $_SESSION['LoggedIn'];
			$getid = $_GET['id'];
			include('connect.inc.php');
			$globalrequest = mysqli_query($con,"SELECT * FROM `multis` WHERE `owner`='$email' ORDER BY `title` ASC");
		?>
		<input type="hidden" id="user-email" value="<?php echo($email);?>"/>
		<div id="feedcontent">
			<div id="multilist">
				<?php
				$multilistresult = mysqli_query($con,"SELECT `id`,`title` FROM `multis` WHERE `owner`='$email'");
				while($row = mysqli_fetch_array($globalrequest)) {
					$dbid = $row['id'];
					$title = $row['title']; 
					$multilistchannel = $row['channels'];
					?><a href='index.php?id=<?php echo $dbid;?>'><div class='multilistitem'><?php echo $title;?>
						<?php if(empty($multilistchannel)){
							?><div id="thereisanewmulti">New!</div>
						<?php };?>
					</div></a>
				<?php
				}
				?>
				<div id="newmulti">
				        <input  type="text" name="newmultiname" id="addmultiname" placeholder="New Multi"/>
				        <div id="addsubmit">+</div>
				    <?php
				    	$newmultiname = $_POST['newmultiname'];
				    	$newmultisubmit = $_POST['newmultisubmit'];
				    					    	
				    	if($newmultisubmit){
					    	$newmultiquery = "INSERT INTO `multis` (`id`, `title`,`owner`, `channels`) VALUES ('', '$newmultiname', '$email', '')";
							if (!mysqli_query($con,$newmultiquery)) {
							  die('There was an error. Try again in a minute.');
							  };								 
				    	};
				    ?>
				</div><!--Ends #Newmulti-->
			</div><!--Ends #multilist-->
		</div><!--Ends #feedcontent-->
		<div id="feed">
			<?php
				if(isset($getid)){
					$feedresult = mysqli_query($con,"SELECT `channels` FROM `multis` WHERE `id`='$getid'");
					while($row = mysqli_fetch_array($feedresult)) {
						$channels = $row['channels'];
						if(!empty($channels)){				 
							$splitchannels = explode(',', $channels); 
							foreach($splitchannels as $channel) { 
					?>			<div class="channelname">
									<?php echo $channel;?>
								</div>
								 <?php	
									$xml = simplexml_load_file("http://gdata.youtube.com/feeds/api/users/$channel/uploads?v=2&max-results=10");
									foreach ($xml->entry as $entry){
					?>				<div class="entry"> 
										<div class="entrythumbnail">
											<img src="http://i1.ytimg.com/vi/dvKeCcxD3rQ/default.jpg" width="120px" height="90px;"/>
										</div>
										<div id="entrytextwrap">
											<?php echo $entry->author->name;
												  echo(" uploaded a video:"); ?>
											<div class="videotitle">
												<?php echo $entry->title; ?>
											</div>
											<div class="entrydesc">
											<?php $entrydesc = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
											$limitdesc = substr($entrydesc, 0, 300);
											echo("$limitdesc ...");
											?>
											</div>
										</div>
									</div>
		<?php						};
							};
						}else {
							?>
								<div id="addchannels">
									To start, add some channels.
								</div>
							<?php
						}
					};
				}else {
				?>	<div id="selectormake">
						Select a Multi, or make a new one.
					</div>
					<div id="suggestedchannels">
						<h3>Suggested Channels</h3>
						<h5>These are suggested channels based upon what other user suggest.</h5>
						<div id="suggestedchannelgridwrapper">
						<?php
							$suggestedchannelquery = mysqli_query($con,"SELECT * FROM `suggestedchannels`");
							while($row = mysqli_fetch_array($suggestedchannelquery)) {
								$suggestedchannel = $row['name'];
								$thumb = $row['thumbnail'];
								$suggesteddesc = $row['description'];
								$link = $row['channellink']
						?>
									<a href="<?php echo($link);?>"><div class="suggestedchannelgriditem">
										<div id="suggestedthumbnail">
											<img src="<?php echo("$thumb");?>" class="suggestedthumbnailimg"/>
										</div>
										<div id="suggestedtextwrapper">
											<div id="suggestedname">
												<?php echo($suggestedchannel);?>
											</div>
											<div id="suggesteddesc">
												<?php echo($suggesteddesc);?><br/>
											</div>
										</div>
									</div></a>							
						<?php
							}
						?>
						</div>
					</div>
	<?php       };
	?>
			</div><!--Ends #feed-->
			<div id="info">
				<?php
					$inforesult = mysqli_query($con,"SELECT * FROM `multis` WHERE `id`='$getid'");
					while($row = mysqli_fetch_array($inforesult)) {
						$id = $row['id'];
						$title = $row['title'];
						$dbowner = $row['owner'];
						$channels = $row['channels'];
						$splitchannels = explode(',', $channels);
						foreach($splitchannels as $channel) {
							echo "<a href='http://youtube.com/$channel'><div id='infochannellisting'>$channel</div></a>";
						}
					}
				?>
				<div class="infotext">
					<?php
						if(isset($getid)){
					?>
							<div id="addachannel">
								Add a channel:
								<form method="post" action="index.php?id=<?php echo $getid;?>">
									<input type="text" id="addtext" name="newchanneltomulti" placeholder="Channel Name">
									<input type="submit" id="addbutton" value="+" name="newchanneltomultibutton">
								</form>	
								<?php
									$newchanneltomulti = $_POST['newchanneltomulti'];
									$newtomultisubmit = $_POST['newchanneltomultibutton'];
									$getid = $_GET['id'];
									
									$channelquery = mysqli_query($con,"SELECT * FROM `multis` WHERE `id`='$getid'");
									while($row = mysqli_fetch_array($channelquery)) {
										$channelstoadd = $row['channels'];
																				
										if(isset($newtomultisubmit)){
											if(empty($channelstoadd)){
												$newchannelquery = "UPDATE `multis` SET `channels`='$channelstoadd,$newchanneltomulti' WHERE `id`='$getid'";
												mysqli_query($con,$newchannelquery);
											}else {
												$newchannelquery = "UPDATE `multis` SET `channels`='$newchanneltomulti' WHERE `id`='$getid'";
												mysqli_query($con,$newchannelquery);
											}							 
										};
									}
								?>				
							</div><!--Ends #addchannel-->
							<div id="ad">
								<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
								<!-- MultiTube Tower -->
								<ins class="adsbygoogle"
								     style="display:inline-block;width:120px;height:600px"
								     data-ad-client="ca-pub-7993291287491944"
								     data-ad-slot="6895272319"></ins>
								<script>
								(adsbygoogle = window.adsbygoogle || []).push({});
								</script>
							</div><!--Ends #ad-->
					<?php
						};
					?>
				</div><!--Ends #infotext-->
			</div><!--Ends #info-->
		</div><!--Ends feed content-->
	</body>
</html>