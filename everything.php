			<form class="" name="list" method="GET" action="everything.php">
					<input type="text" name="query" value="<?php echo($query); ?>">
					<input type="submit">
			</form>

<?php
			function san($char) {return preg_replace("/[^ \w]+/", "", $char);}

$query = $_GET['query'];
$query  = san($query);
exec("G:\httpd\Scanner_Recordings\lib\index\\es.exe G:\httpd\Scanner_Recordings\calls $query", $command);
foreach(array_slice($command,1,count($command)) as $file) {
    echo $file . "<br>";
}


?>