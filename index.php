<?php
require 'conn.php';
session_start();
if($_SESSION['FLAG'] == 'true') 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sheet7</title>
    <style>
        table{
            width: 100%;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h3>Recorder Added</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Fname</th>
            <th>Lname</th>
            <th>Course</th>
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
                    echo '</td><td>' . $lname . '</td>';
                    $courCode = $s['courseCode'];
                    echo '</td><td>' . $courCode . '</td>';
                    $mark = $s['Mark'];
                    echo '</td><td>' . $mark . '</td>';
                    echo '</td><td>' . "<a href='./grade.php? id = $id && course = $courCode'>Grade</a>" . '</td></tr>';   
                }
            }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
        echo "<a href=addstudent.php>RegisterNewStudent "."<br>";
        echo "<a href=studentmark.php>Search "."<br>";
        ?>
    </table>
</body>
</html>