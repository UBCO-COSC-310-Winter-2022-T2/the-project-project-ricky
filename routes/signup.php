<!DOCTYPE html>
<html>
    <body>
        <head>
            <link rel="stylesheet" href="../css/signup.css">
            <script src="scripts/signup-validation.js"></script>
        </head>
        <?php //include('header.php'); ?>
        <main>
        <?php
        $errorMessage = "";
        // gotta check if form was submitted
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// user inputs
			$username = $_POST["username"];
			$email = $_POST["email"];
			$password = $_POST["password"];

            include('dbConnection.php');

			// check if username already exists
			
  			$stmt = $conn->prepare($sql = "SELECT * FROM users WHERE username = ? OR email = ?;");
			$stmt->bind_param('ss', $username, $email);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->fetch_assoc()) {
				$errorMessage = "Username/email already taken";
			}
            else{
                // Prepared stmnt
                $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)"); //Question marks for bind_param params
                $encrypedPW = md5($password);
                $stmt->bind_param("sss", $username, $email, $encrypedPW);

                // Execute SQL statement and check for errors
                if ($stmt->execute()) {
                        //route to login page
                        header("Location: login.php");
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
			// close db connection
			$conn->close();
		}
	?>
            <form id="login_form" class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
                
                <label for="retype-password">Confirm Password:</label>
                <input type="password" id="retype-password" name="password" required><br><br>

                <label for="school">School:</label>
                <input type="text" id="school" name="school" required><br><br>

                <label for="user-type">I am a:</label>
                <select id="user-type" name="user-type">
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select><br><br>
                <?php echo "<p>$errorMessage</p>"; ?> 

                <input type="submit" value="Sign up">
            </form>
        </main>
    </body>
</html>