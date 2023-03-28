<?php
    include 'dbConnection.php';
    
    $search = $_GET['search'];
    $search = $conn->real_escape_string($search);

    $sql = "SELECT school FROM class WHERE school LIKE ?";
    $stmt = $conn->prepare($sql);
    $like = "%" . $search . "%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='suggestion' onclick='selectSuggestion(\"" . htmlspecialchars($row["school"]) . "\")'>" . htmlspecialchars($row["school"]) . "</div>";
        }
    } else {
        echo "";
      }
    $stmt->close();
    $conn->close();
?>