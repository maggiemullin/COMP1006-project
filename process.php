<!DOCTYPE html>
<html lange="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Project</title>
</head>
<body>
    <header>
        <h1>Tune Share - Share Your Favourite Tunes & Join the Community</h1>
    </header>

    <?php

        //create variables to store form data
    $first_name = filter_input(INPUT_POST, 'fname');
    $last_name = filter_input(INPUT_POST, 'lname');
    $genre = filter_input(INPUT_POST, 'genre');
    $location = filter_input(INPUT_POST, 'location');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $song = filter_input(INPUT_POST, 'favsong');


        //set up a flag variable
        $ok = true;

        //a lil' bit of form validation
        if($age === false) {
                echo "<p> Please use a numeric value for age!</p>";
                $ok = false;
            }
            if($email === false) {
                echo "<p> Please include a properly formatted email!</p>";
                $ok = false;
            }

       if($ok === true) {
               try {
                   //connect to the database
                   require('connect.php');
                   //set up our SQL query

                  //sql insert statement
                  $sql = "INSERT INTO songs (first_name, last_name, genre, location, email, age, favsong) VALUES (:firstname, :lastname, :genre, :location, :email, :age, :favsong);";


                   //call the prepare method of the PDO object
                   $statement = $db->prepare($sql);

                   //bind parameters
                   $statement->bindParam(':firstname', $first_name);
                   $statement->bindParam(':lastname', $last_name);
                   $statement->bindParam(':genre', $genre);
                   $statement->bindParam(':location', $location);
                   $statement->bindParam(':email', $email);
                   $statement->bindParam(':age', $age);
                   $statement->bindParam(':favsong', $song);


                   //execute the query
                   $statement->execute();

                   //close the db connection
                   $statement->closeCursor();

               }
               catch(PDOException $e) {
                   echo "<p> Something went wrong! Sorry :( </p>";
                   $error_message = $e->getMessage();
                   echo $error_message;
               }
           }

    ?>

<a href="view.php"> View All Tunes </a>
<footer>
        <p>&copy; TuneShare <?php echo getdate()['year']; ?></p>
    </footer>
    </body>
</html>