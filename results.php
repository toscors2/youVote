<html>
<head><title>Results</title>
    <link rel="stylesheet" href="stylez.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

</head>
<body>
<?php
include("connect.php");

$processTime = microtime(true);
$oddCount = 0;
$evenCount = 0;
$oddPerson = 0;
$evenPerson = 0;
$oddPercent = 0;
$evenPercent = 0;
$totalCount = 0;
$vote = array();

/*prepares voting query*/
$votes = $conn->prepare("select contestant from voiceVotes");
$votes->execute();
$votes->store_result();
$votes->bind_result($contestant);

/*prepares contestant query*/
$singers = $conn->prepare("select contestantName, contestantNum from voiceContestants");
$singers->execute();
$singers->store_result();
$singers->bind_result($sName, $sNumber);

/*Puts contestants in array*/
while ($singers->fetch()) {
    $vote[$sNumber] = array('count' => 0, 'name' => $sName, 'number' => $sNumber);
}

/*Counts Votes*/
while ($votes->fetch()) {
    $vote[$contestant]['count']++;
    $totalCount++;
}

echo "<div style='position:relative; width:100%; margin-left:50%; transform: translate(-50%);'><img id='refresh' src='img/contestants/refresh.png' style='width:250px; height:75px; margin:0 30px;'><img style='width:250px; height:75px; margin:0 30px;' id='reVote' src='img/contestants/voteAgain.png'></div>";
foreach ($vote as $print) {
    $percent = 0;

        $percent = ($print['count'] / $totalCount) * 100;
    settype($percent, "float");

    $print['img'] = 'img/contestants/con' . $print['number'] . '.png';
    echo $print['number'] ."</br>";


    /*writes results w/ graph*/
    echo "<div class='resultsWrapper'>";

    echo "<div class='resultsName' ><img class='resultsImg' src='" . $print['img'] . "'></div>";
    echo "<div class='resultsGraphWrapper' >";
    echo "<div class='resultsGraph' style='width:" .$percent ."%;'>". $percent ."%</div>";
    echo "</div></div>";
}

?>

<script src="javascript.js">


</script>


</body>
</html>
