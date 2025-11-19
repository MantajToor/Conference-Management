<?php
include '../navbar.php'; 
include '../connectdb.php'; 
?>

<h2>This is the student list:</h2>
<?php

$studentquery = $connection->query("
select attendee.attendeeID, attendee.fname, attendee.lname
from attendee
join student on attendee.attendeeID = student.attendeeID
");

$professionalquery = $connection->query("
select attendee.attendeeID, attendee.fname, attendee.lname
from attendee
join professional on attendee.attendeeID = professional.attendeeID
");

$sponsorquery = $connection->query("
select attendee.attendeeID, attendee.fname, attendee.lname
from attendee
join sponsor on attendee.attendeeID = sponsor.attendeeID
");

$studentquery->execute();

while($studentlist = $studentquery->fetch()){
    echo "<li>" . "Student: " . $studentlist['fname'] . " " . $studentlist['lname'] . "</li>";
}
echo "</ul>";
?>

<h2>This is the professional list:</h2>

<?php 
$professionalquery->execute();

while($professionallist = $professionalquery->fetch()){
    echo "<li>" . "Professional: " . $professionallist['fname'] . " " . $professionallist['lname'] . "</li>";
}
echo "</ul>";

?>

<h2>This is the sponsor list:</h2>

<?php
$sponsorquery->execute();

while($sponsorlist = $sponsorquery->fetch()){
    echo "<li>" . "Sponsor: " . $sponsorlist['fname'] . " " . $sponsorlist['lname'] . "</li>";
}
?>

<?php 
$roomquery = $connection->query("select num from room");
?>

<h2>This is how you add a new attendee: </h2>

<form method="post">
    <label>First Name:</label>
    <input type="text" name="fname">
    <br>
    <br>

    <label>Last Name:</label>
    <input type="text" name="lname">
    <br>
    <br>

    <label>Fee:</label>
    <input type="text" name="fee">
    <br>
    <br>

    <label>Is this attendee a student?</label>
    <select name="is_student">
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>
    <br>
    <br>

    <label>Enter room number (Only students):</label>
    <input type="text" name="num">
    <br>
    <br>

    <button type="submit">Add Attendee</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $fee = $_POST['fee'];
    $isStudent = $_POST['is_student'];
    $roomnum = $_POST['num'];

    $insert = $connection->prepare("insert into attendee (fname, lname, fee) values (?, ?, ?)");
    $insert->execute([$fname, $lname, $fee]);

    $max = $connection->query("select max(attendeeID) as maxID from attendee");
    $row = $max->fetch();
    $attendeeID = $row['maxID'];

    if($isStudent === "yes") {
        $insert2 = $connection->prepare("insert into student (attendeeID, roomnum) values (?, ?)");
        $insert2->execute([$attendeeID, $roomnum]);
    }


    echo "<p>Attendee has been added</p>";
}
?>


