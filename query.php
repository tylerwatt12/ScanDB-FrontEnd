<!DOCTYPE HTML>
<?php 
			#for mp3 time column
			include('lib/libmp3tag.php');
			#so I don't get time() errors
			date_default_timezone_set('America/New_York');
			#sanitizes to a-z 0-9 _ and spaces
			function san($char) {return preg_replace("/[^ \w]+/", "", $char);}
			@$query = san($_GET['query']);
			#IF sanitized query is empty, give error
			if (empty($query) ) {
				echo "<pre>Invalid input \n";
				echo "Go <a href=\"index.php\">back</a></pre>";
				exit();
			}
		?>
<html>
	<head>
		<title><?php echo "Scanner results for $query"; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="lib/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="lib/tables/jquery.tablesorter.min.js"></script>
	</head>
	<body>
		<?php 
			$title = "Search: $query";
			include('nav.php');
		?>
		<div id="loading" style="margin-left:20px; margin-right:20px;" class="progress progress-striped active">
		 	<div id="prog" class="progress-bar"  role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
		</div>
		</div>
		<div class="alert alert-info alert-dismissable" style="margin-left:20px; margin-right:20px;">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  <strong>Note!</strong> Talkgroups with numbers in front of them are unverified.
		</div>
		<table border=1 id="calls" class="tablesorter">			
			<thead>
				<tr>
					<th>Length</th>
					<th>TalkGroup + RadioID</th>
					<th>Time(UNIX)</th>
					<th>Time(Local)</th>
					<th>File Size(B)</th>
				</tr>
			</thead>
			<tbody>
			<?php
				flush();
				#run search command
				exec("lib\index\\es.exe G:\httpd\Scanner_Recordings\calls $query", $command);
				foreach(array_slice($command,1,count($command)) as $file)
				{  
				###substr changes based on directory name length
				if(filesize($file) !== 0) {
				echo "\n <tr>";
				###Begin length
				echo "<td width=\"60px\"><center>";
				$m1 = new mp3file($file);
				$length = $m1->get_metadata();
				echo $length['Length mm:ss'];
				echo "</center></td>";
				###End length

				###Generate file link
				$link = substr($file, 28);
				$basefile = substr($file, 55, -4);
				echo "<td><a href=\"$link\" target=\"_blank\">$basefile</a></td>";
				
				###Display UNIX Timestamp
				###substr changes based on directory name length
				echo "<td>";
				echo substr($file, 45,10);
				echo "</td>";
				###End timestamp
				
				###Begin Timestamp
				echo "<td>";
				$last_mod = filemtime("$file");
				print(date("F d Y H:i:s", $last_mod));
				echo "</td>";
				###End Timestamp
				
				###Begin filesize
				echo "<td>";
				echo filesize($file);

				echo "</td>";
				###End filesize
				echo "</tr>";
					}
				}
				#End line
				echo "\n";

			?>
			</tbody>
		</table>
			<script>
				document.getElementById('prog').style.width = '66%'; 
				$(document).ready(function(){$("#calls").tablesorter( {sortList: [[2,1]]} );});
				document.getElementById('prog').style.width = '100%';
				window.setTimeout(FadeOut,2000)
				function FadeOut() {document.getElementById('loading').style.visibility = 'hidden';}
		    </script>
	</body>
</html>