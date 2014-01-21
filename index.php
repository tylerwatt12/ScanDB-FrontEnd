<!DOCTYPE HTML>
<html>
	<head>
		<title>Scanner Recording System</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="lib/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php
			#release ver 0.5
			$title = "Scanner Recorder";
			include('nav.php');
			date_default_timezone_set('America/New_York');
			$cm = date('m');
			$cd = date('d');
			$cy = date('Y');
			#Radioref referral check
			if (isset($_SERVER['HTTP_REFERER'])){
				$ref = htmlspecialchars($_SERVER['HTTP_REFERER']);
				if (strpos($ref,'radioreference') !== false) {
				    echo '<div class="jumbotron">';
				    echo '<h1>Hi there!</h1>';
				    echo '<p>This site was written to help RadioReference users identify unknown talkgroups for <a href="http://forums.radioreference.com/ohio-radio-discussion-forum/238926-greater-cleveland-radio-communication-network-47.html">GCRCN.</a></p>';
					echo '<p>Live streams of this system are available by request only and not open to the general public.</p>';
					echo '<p>Unregistered users are still able to browse and search the database.</p>';
					echo '<p><a class="btn btn-primary btn-lg" role="button" href="mailto:tylerwatt12@gmail.com?Subject=GCRCN-Invite" target="_top">Request an invite</a></p>';
					echo '</div>';
				}
			}

		?>
		<div class="jumbotron">
			<form class="" name="list" method="GET" action="listrec.php">
				<div class="form-group">
					<p>Pick a date and browse recordings</p>
					<b>Date: MM/DD/YYYY</b><br>
					<input type="text" name="m" maxlength="2" size="2" value="<?php echo $cm; ?>">/
					<input type="text" name="d" maxlength="2" size="2" value="<?php echo $cd; ?>">/
					<input type="text" name="y" maxlength="4" size="4" value="<?php echo $cy; ?>">
					<input class=" btn btn-default btn-lg" type="submit">
				</div>
			</form>
		</div>

		<div class="jumbotron">
			<form name="query" method="GET" action="query.php">
				<div class="form-group">
					<p>Type a keyword, RID, TGID</p>
					<b>Month, Year, Query:</b><br>
					<input type="text" name="query" value="56484">
					<input class=" btn btn-default btn-lg" type="submit">
				</div>
			</form>
		</div>
	</body>
</html>