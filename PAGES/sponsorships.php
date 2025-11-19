<?php 


include '../navbar.php'; 
include '../connectdb.php'; 

$company = $connection->query("select companyname,title from jobAD");

?>

<h2>These are the sponsors for the conference</h2>

<?php
$query = $connection->prepare("
select name,level from company
");
$query->execute();

while($list = $query->fetch()){
    echo "<li>" . "Company Name: " . $list['name'] . " - Level: " . $list['level'] . "</li>";
}
echo "</ul>";
?>

<h2>These are the available job postings:</h2>

<form method="post">
    <?php
    echo '<label for="company">Choose a Company:</label><br>';
    echo '<select name="company" id="company">';
    echo '<option value="">Select a company</option>';
    while ($row = $company->fetch()) {
        echo '<option value="' . $row['companyname'] . '">' . $row['companyname'] . '</option>';
    }
    echo '</select>' . '<br>' . '<br>';
    echo '<button type="submit">Show Jobs</button>';
    ?>
</form>

<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedCompany = $_POST['company'];

    $query2 = $connection->prepare("
        select title 
        from jobAD 
        where companyname = ?
    ");
    $query2->execute([$selectedCompany]);

    echo "<h3>Job Postings at $selectedCompany:</h3><ul>";
    while ($job = $query2->fetch()) {
        echo "<li>" . $job['title'] . "</li>";
    }
    echo "</ul>";
}

$query3 = $connection->query("
select title 
from jobAD 
");
$query3->execute();

while($list2 = $query3->fetch()){
    echo "<li>" . "Position: " . $list2['title'] . "</li>";
}
echo "</ul>";
?>

<h2>Add a New Sponsoring Company</h2>

<form method="POST">
    <label>Company name:</label>
    <input type="text" name="companyname" required>
    <br><br>

    <label>Sponsorship level:</label>
    <select name="level">
        <option value="bronze">Bronze</option>
        <option value="silver">Silver</option>
        <option value="gold">Gold</option>
        <option value="platinum">Platinum</option>
    </select>
    <br><br>

    <button type="submit" name="addcompany">Add Company</button>
</form>

<?php
if (isset($_POST['addcompany'])) {
    $company = $_POST['companyname'];
    $level = $_POST['level'];

    $insert = $connection->prepare("insert into company (name, level, sentemails) values (?, ?, 0)");
    $insert->execute([$company, $level]);

    echo "<p>Sponsor has been added successfully.</p>";
}
?>

<h2>Delete a Company</h2>

<form method="POST">
    <label>Company Name:</label>
    <input type="text" name="companyname"><br><br>

    <button type="submit" name="deletecompany">Delete</button>
</form>

<?php
if (isset($_POST['deletecompany'])) {
    $company = $_POST['companyname'];

    $result = $connection->query("select attendeeID from sponsor where companyname = '$company'");
    
    while ($row = $result->fetch()) {
        $attendeeID = $row['attendeeID'];

        $connection->query("delete from sponsor where attendeeID = $attendeeID");

        $connection->query("delete from attendee where attendeeID = $attendeeID");
    }

    $connection->query("delete from company where name = '$company'");

    echo "<p>The company '$company' and all it's associated attendees have been deleted.</p>";
}
?>
