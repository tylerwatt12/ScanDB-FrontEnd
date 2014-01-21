<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo "Locked out talkgroups"; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
				<script src="lib/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="lib/tables/jquery.tablesorter.min.js"></script> 
	</head>
	<body>
		<?php 
			$title = "Freq Lockout";
			include('nav.php');
		?>
		<table border=1 id="myTable" class="tablesorter">			
			<thead>
				<tr>
					<th>Talkgroup</th>
					<th>Priority</th>
					<th>Muted</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$f = fopen("lockoutlist.csv", "r");
				while (($line = fgetcsv($f)) !== false) {
				        echo "<tr>";
				        foreach ($line as $cell) {
				                echo "<td>" . htmlspecialchars($cell) . "</td>";
				        }
				        echo "</tr>\n";
				}
				fclose($f);
				?>
			</tbody>
		</table>
		<script>$(document).ready(function() 
    { 
        $("#myTable").tablesorter( {sortList: [[1,0]]} ); 
    } 
); 
    </script>
	</body>
</html>