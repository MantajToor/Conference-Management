<?php 


include '../navbar.php'; 
include '../connectdb.php'; 
?>

<h2>Write a room number to check the students associated with the room</h2>

<form method="post">
    <label for="roomnum">Enter the room number:</label>
    <input type="text" name="roomnum" id="roomnum">
    <button type="submit">Submit</button>
</form>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $roomnumber = $_POST['roomnum'];

    $query = $connection->prepare("
    select attendee.fname, attendee.lname from student 
    join attendee on student.attendeeID = attendee.attendeeID
    where student.roomnum = ?
    ");
    $query->execute([$roomnumber]);

    echo "<h3>Members of room number $roomnumber</h3>";
    echo "<ul>";
    while($student = $query->fetch()){
        echo "<li>" . $student['fname'] . " " . $student['lname'] . "</li>";
    }
    echo "</ul>";
}
?>