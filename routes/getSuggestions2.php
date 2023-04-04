<?php
    include 'dbConnection.php';
    $school = $_GET['school'];
    $search = $_GET['search'];
    $school = $conn->real_escape_string($school);
    $search = $conn->real_escape_string($search);

    $sql = "SELECT cname FROM class WHERE school = ? AND cname LIKE ?";
    $stmt = $conn->prepare($sql);
    $like = "%" . $search . "%";
    $stmt->bind_param("ss", $school, $like);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='suggestion' onclick='selectSuggestion2(\"" . htmlspecialchars($row["cname"]) . "\")'>" . htmlspecialchars($row["cname"]) . "</div>";
        }
    } else {
        echo "";
    }
    $stmt->close();
    $conn->close();
?>