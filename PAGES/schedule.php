<?php 


include '../navbar.php'; 
include '../connectdb.php'; 
?>

<h2>Enter a date to view the schedule of that day</h2>

<form method="post">
    <label for="date">Enter the date:</label>
    <input type="date" name="date" id="date">
    <button type="submit">Submit</button>
</form>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $date = $_POST['date'];

    $query = $connection->prepare("
    select sessiondate, sessionstarttime, sessionendtime,location from session
    where sessiondate = ?
    ");
    $query->execute([$date]);

    echo "<h3>The date: $date</h3>";
    echo "<ul>";
    while($time = $query->fetch()){
        echo "<li>" . "Date: " . $time['sessiondate'] . " Start Time: " . $time['sessionstarttime'] . " End Time: " . $time['sessionendtime'] . " Location: " . $time['location'] . "</li>";
    }
    echo "</ul>";
}
?>

<h2>All session info:</h2>

<?php
$sessions = $connection->query("SELECT * FROM session");
echo "<ul>";
while ($row = $sessions->fetch()) {
    $location = $row['location'];
    $date = $row['sessiondate'];
    $start = $row['sessionstarttime'];
    $end = $row['sessionendtime'];

    echo "<li>";
    echo "Location: $location | Date: $date | Time: $start to $end";
    echo "</li>";
}
echo "</ul>";
?>


<h2>Update a Session</h2>

<form method="POST">
    <label>Select a session to update:</label><br>
    <select name="Sessioncheck">
        <option value="">Select a session</option>
        <?php
        $sessions = $connection->query("select location, sessiondate, sessionstarttime from session");
        while ($row = $sessions->fetch()) {
            $location = $row['location'];
            $date = $row['sessiondate'];
            $start = $row['sessionstarttime'];

            $value = $location . '|' . $date . '|' . $start;

            echo "<option value='$value'>";
            echo "Location: $location - Date: $date - Start: $start";
            echo "</option>";
        }
        ?>
    </select><br><br>

    <label>New Date (YYYY-MM-DD):</label>
    <input type="text" name="newdate"><br><br>

    <label>New Start Time (HH:MM:SS):</label>
    <input type="text" name="newstart"><br><br>

    <label>New End Time (HH:MM:SS):</label>
    <input type="text" name="newend"><br><br>

    <label>New Location:</label>
    <input type="text" name="newlocation"><br><br>

    <button type="submit" name="updatesession">Update Session</button>
</form>

<?php
if (isset($_POST['updatesession'])) {

    $keyParts = explode('|', $_POST['Sessioncheck']);

    $oldLocation = $keyParts[0];
    $oldDate = $keyParts[1];
    $oldStart = $keyParts[2];


    $newDate = $_POST['newdate'];
    $newStart = $_POST['newstart'];
    $newEnd = $_POST['newend'];
    $newLocation = $_POST['newlocation'];

    $sql = "UPDATE session SET 
                sessiondate = '$newDate', 
                sessionstarttime = '$newStart', 
                sessionendtime = '$newEnd', 
                location = '$newLocation'
    WHERE location = '$oldLocation' AND sessiondate = '$oldDate' AND sessionstarttime = '$oldStart'";

    $connection->query($sql);

    echo "<p>Session updated successfully.</p>";
}
?>

