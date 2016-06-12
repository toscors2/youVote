<?php
include("connect.php");

$errors = array();
$data = array();
$ticketNum = "";
$vote1 = "";
$vote2 ="";
$vote3 = "";
$vote = array();

if (!empty($_POST[0]))
    $ticketNum = $_POST[0];
if (!empty($_POST[1]))
    $vote[1] = $_POST[1];
if (!empty($_POST[2]))
    $vote[2] = $_POST[2];
if (!empty($_POST[3]))
    $vote[3] = $_POST[3];
$dbTicketNum = 0;
$verifyTicketNum = $conn->prepare("select ticketNum from voiceVotes where ticketNum = ? group by ticketNum");
$verifyTicketNum->bind_param("i", $ticketNum);
$verifyTicketNum->execute();
$verifyTicketNum->bind_result($dbTicketNum);
$verifyTicketNum->fetch();


if (empty($ticketNum))
    $errors['ticketNum'] = 'Please Enter a Valid 4 Digit Number';
if ($dbTicketNum != 0)
    $errors['ticketNum'] = 'Ticket Number Has Been Used For Voting, Please Use Another Ticket';
if (!is_numeric($ticketNum))
    $errors['ticketNum'] = 'You Can Only Enter Numbers Here';
if (strlen($ticketNum) != 4)
    $errors['ticketNum'] = 'Please Enter Just The Last 4 Numbers of Your Ticket';
if ($ticketNum < 9154 or $ticketNum > 9651)
    $errors['ticketNum'] = 'Sorry That Ticket Number Is Not Within The Valid Range: Please Try Again With the Last 4 Numbers Of A Valid Ticket';



if (!empty($errors)){
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    
    foreach ($vote as $enter) {
    $enterVote =$conn->prepare("insert into voiceVotes (contestant, ticketNum) values (?, ?)");
    $enterVote->bind_param("ss", $enter, $ticketNum);
        $enterVote->execute();
    }
    
    $data['success'] = true;
    $data['message'] = 'Your Vote Has Been Accepted';
}

echo json_encode($data);


