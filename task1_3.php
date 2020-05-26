<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Welcome</title>
    </head>
	<body>

<?php
		$day = date('d');
		$month = date('m');
		$year = date('Y');
		$hour = date('H');
		$hour = $hour + 2 ;
		$minute = date('i');
		$second = date('s');

$myFile = 'firsttime.txt';
if (file_exists ($myFile ))
	{
		$myFile = fopen('firsttime.txt', 'r+');
		$spentsec =time ()- (int)fgets($myFile);
		?><h1><?php
		echo 'Today:  '.$day.' /'.$month.' /'.$year.', time '.$hour.':'.$minute.':'.$second.'<br>';
		?></h1><?php
		echo 'You first used this page '.$spentsec.' seconds ago';
		fclose($myFile);
	}
else
	{
		$myFile = fopen('firsttime.txt', 'a+');
		?><h1><?php
		echo 'Your first connection is today:  '.$day.' /'.$month.' /'.$year.', time '.$hour.':'.$minute.':'.$second.''; 
		?></h1><?php
		fputs($myFile,time()."\r\n");
		fputs($myFile, "first time page loaded : $day/$month/$year, $hour:$minute:$second");
		fclose($myFile);
	}	
?>
	</body>
	</html>


