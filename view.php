<?php
    require('header.php');

    //connect to the database
    require('connect.php');

    //set up SQL statement
    $sql = "SELECT * FROM songs;";

    //prepare
    $statement = $db->prepare($sql);

    //execute
    $statement->execute();

    //use fetchAll to store results

    $records = $statement->fetchAll();

    //creating the top of the table
    echo "<table class='table table-striped'><tbody>";

    foreach($records as $record) {
        echo "<tr><td>" . $record['first_name'] . "</td><td>" . $record['last_name'] . "</td><td>" . $record['age'] . "</td><td>". $record['genre'] . "</td><td>" . $record['location'] . "</td><td>" . $record['email'] . "</td><td>" . $record['favsong'] . "</td>
        <td><a href='delete.php?id=". $record['user_id'] . "'> Delete Tune </a>
        </td>
        <td><a href='index.php?id=". $record['user_id'] . "'> Edit Tune </a></td>
        </tr>";
    }

    echo "</tbody></table>";

    //close the DB connection
    $statement->closeCursor();
    require('footer.php');
    ?>