<?php
require 'conn.php';
session_start();
// if($_SESSION['FLAG'] == 'true') 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sheet7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Recorder Added</h3>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Fname</th>
            <th>Lname</th>
            <th>Course</th>
            <th>Mark</th>
            <th>Grade</th>
        </tr>
        <?php
        require_once 'conn.php';
        try{
            $sql='SELECT * FROM student  s NATURAL JOIN student_course sc;';
            $stmt=$conn->query($sql);
            $stds = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($stds as $s){
                    $id = $s['studentId'];
                    echo '<tr><td>'. $id;
                    $fname = $s['Fname'];
                    echo '</td><td>' . $fname . '</td>';
                    $lname = $s['Lname'];
                    echo '<td>' . $lname . '</td>';
                    $courCode = $s['courseCode'];
                    echo '<td>' . $courCode . '</td>';
                    $mark = $s['Mark'];
                    if(empty($mark)){
                        echo '<td> Unset </td>'; 
                    }else{
                        echo '<td>' . $mark . '</td>';
                    }
                    // $_SESSION['id'] = $id;
                    echo '<td>' . "<button type='button' class='btn btn-primary'><a href='grade.php?id=$id & course=$courCode'>Grade</a></button>";   
                    echo "<button type='button' class='btn btn-danger ms-2'><a href=delete.php?id=$id>Delete</a></button>". '</td></tr>';   
                }
            }
            catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        echo "<button type='button' class='btn btn-success m-2'><a href=addstudent.php>RegisterNewStudent</a></button>";
        ?>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
