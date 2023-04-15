<?php
        $errorMessage = "";
        // gotta check if form was submitted
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// user inputs
			$username = $_POST["username"];
			$email = $_POST["email"];
			$password = $_POST["password"];
            $school = $_POST["school"];
            $userType = $_POST["user-type"];

            include('dbConnection.php');

			// check if username already exists
  			$stmtT = $conn->prepare($sql = "SELECT * FROM teacher WHERE username = ? OR email = ?;");
			$stmtT->bind_param('ss', $username, $email);
			$stmtT->execute();
			$resultT = $stmtT->get_result();
            $stmtS = $conn->prepare($sql = "SELECT * FROM student WHERE username = ? OR email = ?;");
            $stmtS->bind_param('ss', $username, $email);
            $stmtS->execute();
            $resultS = $stmtS->get_result();
			if ($resultT->fetch_assoc() or $resultS->fetch_assoc() ) {
				$errorMessage = "Username/email already taken";
			}		
            else{
                // Prepared stmnts
                $stmt = "";
                if($userType == 'teacher'){
                    $stmt = $conn->prepare("INSERT INTO teacher (username, password, email, school) VALUES (?, ?, ?, ?)"); //Question marks for bind_param params
                    $encrypedPW = md5($password);
                    $stmt->bind_param("ssss", $username,$encrypedPW, $email, $school);
                }
                else if($userType == 'student'){
                    $stmt = $conn->prepare("INSERT INTO student (username, password, email) VALUES (?, ?, ?)"); //Question marks for bind_param params
                    $encrypedPW = md5($password);
                    $stmt->bind_param("sss", $username,$encrypedPW, $email);
                }

                // Execute SQL statement and check for errors
                if ($stmt->execute()) {
                        //route to login page
                        header("Location: select.php");
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
                    <label for="username">Username:</label>
                    <h2>Username</h2>
                    <input class="field" type="text" id="username" name="username" required><br><br>
                    
                    <label for="email">Email:</label>
                    <h2>Email</h2>
                    <input class="field" type="email" id="email" name="email" required><br><br>
                    
                    <label for="password">Password:</label>
                    <h2>Password</h2>
                    <input class="field" type="password" id="password" name="password" required><br><br>
                    
                    <label for="retype-password">Confirm Password:</label>
                    <h2>Confirm Password:</h2>
                    <input class="field" type="password" id="retype-password" name="password" required><br><br>

                    <label for="school">School:</label>
                    <h2>School</h2>
                    <input class="field" type="text" id="school" name="school" required><br><br>

                    <label for="user-type">I am a:</label>
                    <h2>I am a:</h2>
                    <select id="user-type" name="user-type">
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select><br><br>
                    <?php echo "<p>$errorMessage</p>"; ?> 

                    <input class="submit" type="submit" value="Sign up">
                </div>
            </form>
        </main>
    </body>
</html>