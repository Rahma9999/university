<?php
require 'conn.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addStudent</title>
</head>
<body>
    <div id="main">
        <h1>/Register A New Student</h1><br>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <label>First Name:</label><input type="text" name="fname"><br>
            <label>Last Name:</label><input type="text" name="lname"><br>
            <label>Email:</label><input type="text" name="email"><br>
            <label>Course:</label>
            <select name="course[]" multiple>
                <!--
                    $sql = 'SELECT code FROM course';
                    $stmt = $conn->query($sql);
                    $cours = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($cours as $co){
                        $cour = $co["code"];
                        echo "<option value='$cour'>$cour</option>";
                    }
                -->
                <option value="" hidden>Select Course</option>
                <option value="comp102">comp102</option>
                <option value="comp104">comp104</option>
                <option value="comp106">comp106</option>
            </select>
            <br>
            <a href="index.php"><input type="submit" name="Register"></a>
            <a href="" target="_self">Cancel</a>
        </form>
    </div>
    <?php
    require_once 'conn.php';
        if(isset($_POST['fname'], $_POST['lname'], $_POST['email'])){
            $lname = htmlspecialchars($_POST['lname']);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $fname = htmlspecialchars($_POST['fname']);
            $sql = "INSERT INTO student (Fname, Lname, Email) VALUES (:fname, :lname, :email)";           
            $stmt = $conn->prepare($sql); 
            $stmt->execute(array(
                ':fname' => $fname,
                ':lname' => $lname,
                ':email' => $email
            ));
            $sid = $conn->lastInsertId();
            $sql = "INSERT INTO student_course (studentId, courseCode) VALUES (:id, :code)";
            $stmt = $conn->prepare($sql);
            foreach($_POST['course'] as $co){
                $stmt->execute([
                    ':id' => $sid,
                    ':code'=>$co
                ]);
            };
            header("location:index.php");
            $_SESSION['FLAG'] = 'true';
        // header("Location: index.php");
        // exit;
        }else{
            $_SESSION['FLAG'] = 'false';
        }
    ?>
</body>
</html>