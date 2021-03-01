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
    <main>
        <form action="process.php" method="post">
            <input type="text" name="fname" placeholder="First Name">
            <input type="text" name="lname" placeholder="Last Name">
            <input type="text" name="genre" placeholder="Genre">
            <input type="text" name="location" placeholder="Location">
            <input type="number" name="age" placeholder="Age">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="favsong" placeholder="What Are You Listening To?">
            <input type="submit" value="submit" name="submit">
        </form>
    </main>
    <footer>
        <p>&copy; TuneShare <?php echo getdate()['year']; ?></p>
    </footer>
    </body>
</html>