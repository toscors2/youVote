<?php
include("connect.php");
$singers = $conn->prepare("select contestantNum from voiceContestants");
$singers->execute();
$singers->store_result();
$singers->bind_result($sNumber);

echo "<form name='verify' method='POST' action='process.php'>
            <div id='verify'>
                    <h1>
                        <label for='ticketNumber'>Please Enter Last 4 Numbers of Your Ticket</label></br>
                        <input type='number' class='ticketNumber' id='ticketNumber' name='ticketNum' value=''/>
                    </h1>
                    <p class='small'>Select Your 3 Favorite Contestants and Press Submit</p>
                    <p class='small'>You Cannot DeSelect, But You Can Only Choose 3 (if you choose more your oldest selection will be replaced)</p>
                </div>
                <h1><img id='submit' src='img/contestants/submit.png'></h1>
            <div id='menu'>";


while ($singers->fetch()) {
    echo "<img id='" . $sNumber . "' class='conVotePage' src='img/contestants/con" . $sNumber . ".png'>";
}

echo "</div></form>";

?>

<script src="javascript.js">
    
</script>
