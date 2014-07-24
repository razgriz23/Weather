<html>
<head>
<style type="text/css">
table.hovertable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#000000 ;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
}
table.hovertable th {
	background-color:#989898;
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #989898 ;
	
}
table.hovertable tr {
	background-color:#E0E0E0;
}
table.hoverTable tr:hover {
          background-color: #ffff99;
    }
table.hovertable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #989898 ;
}
.fontstyle {
	font-family: verdana,arial,sans-serif;
	font-size:15pt;
	color:#000000 ;
	}

</style>

</head>
<body>

<h1 style ="font-size:20pt; color: #0000FF">WEATHER HISTORY</h1>

<?php
$con=mysql_connect("localhost","nvedula","mydb");
if(!$con)
{
echo "Failed to  connect to MySql:".mysql_connect_error();
}
mysql_select_db("db_Fall13_nvedula",$con);
?>

<?php
if (isset($_POST['StartDate'], $_POST['EndDate'])){
        $StartDate = $_POST['StartDate'];
        $EndDate = $_POST['EndDate'];
        
       $currentDate = date("Y-m-d");
        //echo $dt->format('Y-m-d H:i:s');
        if($_POST['StartDate']> $currentDate || $_POST['EndDate']>$currentDate){
        echo "<div class='fontstyle'> Please enter Start date and End date no later than the Current date : $currentDate.</div> ";
        }
        
        else if($_POST['StartDate']>$_POST['EndDate'] ){
        echo "<div class='fontstyle' >Please enter Start date no later than End date. </div>";
        }
        
        else if($_POST['StartDate']<'2014-06-01' || $_POST['EndDate']>$currentDate  ){
        echo "<div class='fontstyle' >Please select dates between June to July 24th 2014.</div> ";
        }
        else
        {
$result = mysql_query("SELECT * FROM History where date BETWEEN '$StartDate' AND '$EndDate' ORDER BY DATE DESC");

if (!$result) {
		die('Invalid query: ' . mysql_error());
	}

echo "<table class='hoverTable' >";
echo"<tr>";
echo"<th>Date</th>";
echo"<th>Temp High</th>";
echo"<th>Temp Avg</th>";
echo"<th>Temp Low</th>";
echo"<th>Humidity High</th>";
echo"<th>Humidity Avg </th>";
echo"<th>Humidity Low </th>";
echo"<th>Wind High</th>";
echo"<th>Wind Avg</th>";
echo"<th>Wind Low</th>";
echo"<th>Precipitation</th>";
echo"<th>Events</th>";
echo"</tr>";

while($row = mysql_fetch_array($result))
 {
 echo "<tr>";
 echo "<td>".$row['date']."</td>";
 echo "<td>".$row['tempHigh']."</td>";
 echo "<td>".$row['tempAvg']."</td>";
 echo "<td>".$row['tempLow']."</td>";
 echo "<td>".$row['humidityHigh']."</td>";
 echo "<td>".$row['humidityAvg']."</td>";
 echo "<td>".$row['humidityLow']."</td>";
 echo "<td>".$row['windHigh']."</td>";
 echo "<td>".$row['windAvg']."</td>";
 echo "<td>".$row['windLow']."</td>";
 echo "<td>".$row['precipitation']."</td>";
 echo "<td>".$row['events']."</td>";
 echo "</tr>";
 }


echo "</table>";
}
}
mysql_close($con);

?> 
<a href="historyget.html"/><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click here to go back to enter dates again</a>
</body>
</html> 
