<?php
include '../navbar.php'; 
include '../connectdb.php'; 


$query = $connection->query("select sum(fee) as Totalfee from attendee");
$fetch = $query->fetch();
$Totalfee = $fetch['Totalfee'];

$companyQuery = $connection->query("select level from company");
$Totalsponsorship = 0;

while ($company = $companyQuery->fetch()) {

    if ($company['level'] === 'platinum') {
        $Totalsponsorship += 10000;
    } elseif ($company['level'] === 'gold') {
        $Totalsponsorship += 5000;
    } elseif ($company['level'] === 'silver') {
        $Totalsponsorship += 3000;
    } elseif ($company['level'] === 'bronze') {
        $Totalsponsorship += 1000;
    }
}

$Totalearnings = $Totalfee + $Totalsponsorship;
?>

<h2>Conference earnings:</h2>
<ul>
    <li><p>Total earnings from fees:</p> $<?php echo $Totalfee ?> </li>
    <li><p>Total earnings from sponsors:</p> $<?php echo $Totalsponsorship ?></li>
    <li><p>Total conference earnings:</p> $<?php echo $Totalearnings ?></li>
</ul>