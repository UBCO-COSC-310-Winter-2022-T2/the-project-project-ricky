<?php
session_start();

$errorMessage = "";
// gotta check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // user inputs
    $className = $_POST["class"];
    $school = $_POST["school"];
    $username = $_SESSION['username'];

    include('dbConnection.php');

    // check if username already exists
    $stmt = $conn->prepare($sql = "SELECT * FROM class WHERE cname = ? AND school = ?;");
    $stmt->bind_param('ss', $className, $school);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->fetch_assoc()) {
        $errorMessage = "Class already exists";
    } else {
        // Prepared stmnts
        $stmt = "";
        $stmt = $conn->prepare("INSERT INTO class (cname, school, teacher) VALUES (?, ?, ?)"); //Question marks for bind_param params
        $stmt->bind_param("sss", $className, $school, $username);

        // Execute SQL statement and check for errors
        if ($stmt->execute()) {
            //route to classes page
            header('Location: teacherClasses.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    // close db connection
    $conn->close();
}
?>
<html>
    <body>
        <head>
            <link rel="stylesheet" href="../css/all.css">
            <link rel="stylesheet" href="../css/form.css">
            <script src="../scripts/signup-validation.js"></script>
        </head>
        <?php include('headers/header.php'); ?>
        <main>
            <form id="signup_form" class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <div class="form_div">
                    <label for="class">Class Name:</label>
                    <h2>Class name:</h2>
                    <input class="field" type="text" id="class" name="class" required><br><br>

                    <label for="school">School:</label>
                    <h2>School:</h2>
                    <input class="field" type="text" id="school" name="school" required><br><br>

                    <?php echo "<p>$errorMessage</p>"; ?> 

                    <input class="submit" type="submit" value="Add class">
                </div>
            </form>
        </main>
    </body>
</html>
