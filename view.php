<!DOCTYPE html>
<html lange="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Project</title>
</head>
    <?php

        //connect to db
        require('connect.php');

        //set sql statement
         $sql = "SELECT * FROM songs;";

        //prepare method on PDO method
       $statement = $db->prepare($sql);


        //execute
        $statement->execute();


        //use fetch all to store results

       $records = $statement->fetchAll();

        //display in table - create top of table
       echo "<table class='table table-striped'><tbody>";

           foreach($records as $record) {
               echo "<tr><td>" . $record['first_name'] . "</td><td>" . $record['last_name'] . "</td><td>" . $record['age'] . "</td><td>". $record['genre'] . "</td><td>" . $record['location'] . "</td><td>" . $record['email'] . "</td><td>" . $record['favsong'] . "</td>
               <td><a href='delete.php?id=". $record['user_id'] . "'> Delete Tune </a>
               </td>
               <td><a href='index.php?id=". $record['user_id'] . "'> Edit Tune </a></td>
               </tr>";
           }

           echo "</tbody></table>";

        //close db connect
        $statement->closeCursor();
    ?>



<footer>
        <p>&copy; TuneShare <?php echo getdate()['year']; ?></p>
    </footer>
    </body>
</html>