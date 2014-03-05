<form action="test.php" method="get">
	<input type="text" name="id">
	<input type="submit" value="submit">
</form>
<?php
	$id = $_GET['id'];
	echo($id);
?>