<!DOCTYPE HTML>
<?php 
			#for mp3 time column
			include('lib/libmp3tag.php');
			#so I don't get time() errors
			date_default_timezone_set('America/New_York');
			#sanitizes dmy input
			function san($num) {return preg_replace('/\D/','',$num);}
			#check empty inputs
			@$m = san($_GET['m']);
			@$d = san($_GET['d']);
			@$y = san($_GET['y']);
			#IF sanitized inputs are empty, echo error
			if (empty($m) || empty($d) || empty($y) ){
				echo "<pre>Invalid input \n";
				echo "Go <a href=\"index.php\">back</a></pre>";
				exit();
			}
			$dir = "./calls/$y/$m/$d/*";
		?>
<html>
	<head>
		<title><?php echo "Scanner results from $m/$d/$y"; ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="lib/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="lib/tables/jquery.tablesorter.min.js"></script>
	</head>
	<body>
		<?php 
			$title = "$m/$d/$y";
			include('nav.php');
		?>
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
				foreach(glob($dir) as $file)  
				{  
					If(filesize($file) !== 0){
						###substr changes based on directory name length
						$basefile = substr("$file", 29, -4);
						echo "\n <tr>";

						###Begin length
						echo "<td width=\"60px\"><center>";
						$m1 = new mp3file($file);
						$length = $m1->get_metadata();
						echo $length['Length mm:ss'];
						echo "</center></td>";
						###End length

						###Generate file link
						echo "<td><a href=\"$file\" target=\"_blank\">$basefile</a></td>";
						
						###Display UNIX Timestamp
						###substr changes based on directory name length
						echo "<td>";
						echo substr($file, 19,10);
						echo "</td>";
						###End timestamp
						
						###Begin Timestamp
						echo "<td>";
						$last_mod = filemtime("$file");
						print(date("H:i", $last_mod));
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
			<script>$(document).ready(function() 
		    { 
		        $("#calls").tablesorter( {sortList: [[2,1]]} ); 
		    } 
					); 
		    </script>
	</body>
</html>