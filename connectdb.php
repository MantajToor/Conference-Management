<?php
try {
    $connection = new PDO('mysql:host=localhost;dbname=conferenceDB2', "root", "");
} catch (PDOException $e) {
    print "Error!: ". $e->getMessage(). "<br/>";
    die();
}
?>