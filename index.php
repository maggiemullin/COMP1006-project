<?php require('header.php');

  //initialize variables

        $id = null;
        $firstname = null;
        $lastname = null;
        $location = null;
        $genre = null;
        $email = null;
        $age= null;
        $favsong = null;

        //check if user is editing

        if(!empty($_GET['id']) && (is_numeric($_GET['id']))) {
            //grab id and store in a variable
            $id = filter_input(INPUT_GET, 'id');
            //connect to db
            require('connect.php');
            //set up query
            $sql = "SELECT * FROM songs WHERE user_id = :user_id;";
            //prepare
            $statement = $db->prepare($sql);
            //bind
            $statement->bindParam(':user_id', $id);
            //execute
            $statement->execute();
            //use fetchAll method to store
            $records = $statement->fetchAll();
            foreach($records as $record) :
                $firstname = $record['first_name'];
                $lastname = $record['last_name'];
                $location = $record['location'];
                $genre = $record['genre'];
                $email = $record['email'];
                $age= $record['age'];
                $favsong = $record['favsong'];
             endforeach;
             $statement->closeCursor();
            }
        ?>

            <main>
                <form action="process.php" method="post">
                    <!-- add hidden input to include the id without the user seeing -->
                    <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <input type="text" name="fname" placeholder="First Name" class="form-control" value="<?php echo $firstname; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="lname" placeholder="Last Name" class="form-control" value="<?php echo $lastname; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="genre" placeholder="Genre" class="form-control" value="<?php echo $genre; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="location" placeholder="Location" class="form-control" value="<?php echo $location; ?>">
                    </div>
                    <div class="form-group">
                        <input type="number" name="age" placeholder="Age" class="form-control" value="<?php echo $age; ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" name="favsong" placeholder="What Are You Listening To?" class="form-control" value="<?php echo $favsong; ?>">
                    </div>
                    <input type="submit" value="submit" name="submit" class="btn btn-primary">
                </form>
            </main>
        <?php require('footer.php'); ?>