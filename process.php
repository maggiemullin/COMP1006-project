 <?php
    ob_start();
     require('header.php');

    //create variables to store form data

    $first_name = filter_input(INPUT_POST, 'fname');
    $last_name = filter_input(INPUT_POST, 'lname');
    $genre = filter_input(INPUT_POST, 'genre');
    $location = filter_input(INPUT_POST, 'location');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $song = filter_input(INPUT_POST, 'favsong');
    $id = null;
    $id = filter_input(INPUT_POST, 'user_id');


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

            //if we have an id, we are editing
            if(!empty($id)) {
                $sql = "UPDATE songs SET first_name = :firstname, last_name = :lastname, genre = :genre, location = :location, email = :email, age = :age, favsong = :favsong WHERE user_id = :user_id;";
            }
            //if not, adding a new record
            else {
                $sql = "INSERT INTO songs (first_name, last_name, genre, location, email, age, favsong) VALUES (:firstname, :lastname, :genre, :location, :email, :age, :favsong);";

            }
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

            if(!empty($id)) {
                $statement->bindParam(':user_id', $id );
            }
            //execute the query
            $statement->execute();
            //close the db connection
            $statement->closeCursor();
            header('location:view.php');
        }
        catch(PDOException $e) {
            echo "<p> Something went wrong! Sorry :( </p>";
            $error_message = $e->getMessage();
            echo $error_message;
        }
    }
    ob_flush();
    require('footer.php'); ?>
