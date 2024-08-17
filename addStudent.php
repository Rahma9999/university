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
    <link rel='stylesheet' href='style.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <center>
    <div id="main">
        <h1>Register A New Student</h1><br>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">First Name:</span>
                <input type="text" class="form-control" name="fname"><br>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Last Name:</span>  
                <input type="text" class="form-control" name="lname"><br>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Email:</span>
                <input type="text" class="form-control" name="email"><br>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Course:</span>  
                <!-- <select name="course[]" multiple> -->
                <select name="course" class="form-select" aria-label="Default select example">
                    <!--
                        $sql = 'SELECT * FROM course';
                        $stmt = $conn->prepare($sql);
                        $cours = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($cours as $co){
                            $cour = $co["courseCode"];
                            echo "COMP <option'>$cour</option>";
                        }
                    ?> -->
                    <option value="" hidden>Select Course</option>
                    <option value="102">comp102</option>
                    <option value="104">comp104</option>
                    <option value="106">comp106</option>
                </select>
                <?php
                    if(!empty($err)){
                        echo "<p style='color: red'>". $err ."</p>";
                    }
                ?>
                </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="" target="_self">Cancel</a>
        </form>
    </div>
    <?php
    require_once 'conn.php';
    $err = "";
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
            // foreach($_POST['course'] as $co){
            if(empty($_POST['course'])){
                $err = "choose Course";
            }else{
            $co = $_POST['course'];
                $stmt->execute([
                    ':id' => $sid,
                    ':code'=>$co
                ]);
            // };
            header("location:index.php");
            }
            $_SESSION['FLAG'] = 'true';
        // header("Location: index.php");
        // exit;
        }else{
            $_SESSION['FLAG'] = 'false';
        }
    ?>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>