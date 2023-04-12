<?php
    function isTeacher($username){
        include('dbConnection.php');
        $sql = "SELECT * FROM teacher WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$username);
        if($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }else{
            $stmt->close();
            return false;
        }
    }
?>