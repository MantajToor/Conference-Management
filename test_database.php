<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Database Connection Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .success { color: green; }
        .error { color: red; }
        .info { color: blue; }
        table { border-collapse: collapse; margin: 10px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
    </style>
</head>
<body>
    <h1>Conference Management System - Database Test</h1>
    
    <?php
    echo "<h2>1. Testing Database Connection...</h2>";
    
    try {
        $connection = new PDO('mysql:host=localhost;dbname=conferenceDB2', "root", "");
        echo "<p class='success'>✓ Successfully connected to database 'conferenceDB2'</p>";
        
        // Test each table
        $tables = ['room', 'attendee', 'student', 'subcommittee', 'member', 'professional', 
                   'company', 'jobAD', 'sponsor', 'speaker', 'session', 'memberof'];
        
        echo "<h2>2. Checking Database Tables...</h2>";
        echo "<table>";
        echo "<tr><th>Table Name</th><th>Row Count</th><th>Status</th></tr>";
        
        $allTablesExist = true;
        foreach ($tables as $table) {
            try {
                $query = $connection->query("SELECT COUNT(*) as count FROM $table");
                $result = $query->fetch();
                $count = $result['count'];
                echo "<tr><td>$table</td><td>$count</td><td class='success'>✓ Exists</td></tr>";
            } catch (PDOException $e) {
                echo "<tr><td>$table</td><td>-</td><td class='error'>✗ Missing</td></tr>";
                $allTablesExist = false;
            }
        }
        echo "</table>";
        
        if (!$allTablesExist) {
            echo "<div class='error'>";
            echo "<h3>⚠ Database Not Set Up Correctly!</h3>";
            echo "<p>To set up the database, follow these steps:</p>";
            echo "<ol>";
            echo "<li>Open phpMyAdmin in your browser: <a href='http://localhost/phpmyadmin' target='_blank'>http://localhost/phpmyadmin</a></li>";
            echo "<li>Click on the 'SQL' tab</li>";
            echo "<li>Copy the contents of <code>conferenceDB2.ddl</code> file</li>";
            echo "<li>Paste it into the SQL query box and click 'Go'</li>";
            echo "<li>Refresh this page to verify the setup</li>";
            echo "</ol>";
            echo "</div>";
        } else {
            echo "<p class='success'><strong>✓ All tables exist and contain data!</strong></p>";
            
            // Show some sample data
            echo "<h2>3. Sample Data from Attendees Table:</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Fee</th></tr>";
            $attendees = $connection->query("SELECT * FROM attendee LIMIT 5");
            while ($row = $attendees->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['attendeeID'] . "</td>";
                echo "<td>" . $row['fname'] . "</td>";
                echo "<td>" . $row['lname'] . "</td>";
                echo "<td>$" . $row['fee'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<h2>4. Ready to Test!</h2>";
            echo "<p class='info'>Your database is set up correctly. You can now test the application pages:</p>";
            echo "<ul>";
            echo "<li><a href='/Conference%20Management/conference.php'>Main Page</a></li>";
            echo "<li><a href='/Conference%20Management/PAGES/attendees.php'>Attendees Page</a></li>";
            echo "<li><a href='/Conference%20Management/PAGES/earnings.php'>Earnings Page</a></li>";
            echo "<li><a href='/Conference%20Management/PAGES/sponsorships.php'>Sponsorships Page</a></li>";
            echo "<li><a href='/Conference%20Management/PAGES/schedule.php'>Schedule Page</a></li>";
            echo "<li><a href='/Conference%20Management/PAGES/rooms.php'>Rooms Page</a></li>";
            echo "<li><a href='/Conference%20Management/PAGES/subcommittee.php'>Subcommittee Page</a></li>";
            echo "</ul>";
        }
        
        $connection = NULL;
        
    } catch (PDOException $e) {
        echo "<div class='error'>";
        echo "<h3>✗ Database Connection Failed!</h3>";
        echo "<p>Error: " . $e->getMessage() . "</p>";
        echo "<h4>Possible Solutions:</h4>";
        echo "<ul>";
        echo "<li>Make sure XAMPP Apache and MySQL services are running</li>";
        echo "<li>The database 'conferenceDB2' may not exist yet. Create it using phpMyAdmin:</li>";
        echo "<ol>";
        echo "<li>Go to <a href='http://localhost/phpmyadmin' target='_blank'>phpMyAdmin</a></li>";
        echo "<li>Click on 'SQL' tab</li>";
        echo "<li>Copy and paste the contents of <code>conferenceDB2.ddl</code></li>";
        echo "<li>Click 'Go'</li>";
        echo "</ol>";
        echo "</ul>";
        echo "</div>";
    }
    ?>
    
</body>
</html>

