<?php


include '../navbar.php'; 
include '../connectdb.php'; 

$subcommittees = $connection->query("select name from subcommittee");
?>

<h2>View Subcommittee Members</h2>

<form method="POST">
    <?php
    echo '<label for="subcommittee">Choose a subcommittee:</label><br>';
    echo '<select name="subcommittee" id="subcommittee">';
    echo '<option value="">Select a subcommittee</option>';
    while ($fetch = $subcommittees->fetch()) {
        echo '<option value="' . $fetch['name'] . '">' . $fetch['name'] . '</option>';
    }
    echo '</select>' . '<br>' . '<br>';
    echo '<button type="submit">Show Members</button>';
    ?>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subcommittee'])) {
    $selected = $_POST['subcommittee'];

    $query = $connection->prepare("
        select memberID, fname, lname from member 
        where subcommitteename = ?
    ");
    $query->execute([$selected]);

    echo "<h3>Members of '$selected'</h3>";
    echo "<ul>";
    while ($member = $query->fetch()) {
        echo "<li>" . $member['fname'] . " " . $member['lname'] . "</li>";
    }
    echo "</ul>";
}
?>