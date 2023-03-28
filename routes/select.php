<!DOCTYPE html>
<html>
    <body>
        <head>
            <link rel="stylesheet" href="../css/all.css">
            <link rel="stylesheet" href="../css/form.css">
            <script src="scripts/login-validation.js"></script>
        </head>
        <?php include('headers/header.php'); ?>
        <main>
            <p>Login in as: </p>
            <form action='route.php' method='POST'>
                <input class="submit" type="submit" name="teacher" value="teacher">
                <input class="submit" type="submit" name="student" value="student">
            </form>
        </main>
    </body>
</html>