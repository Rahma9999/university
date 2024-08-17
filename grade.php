<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Studnet Mark</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <center>
<?php
require 'conn.php';
if(isset($_GET['id']) && isset($_GET['course'])){
$id = $_GET['id'];
$cour = $_GET['course'];
echo "<h3>Grading a Student With ID $id In The Course COMP$cour</h3>"; 
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form">
    <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Mark</span>
            <input type="number" class="form-control" name="mark" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <?php if(!empty($err)){echo $err;}?>
        <br>
        <button class="btn btn-primary" type="submit">Update</button>
        <br>
        <input type="text" name="id" value="<?php echo $id ?>" style="display: none;">
        <input type="text" name="cour" value="<?php echo $cour ?>" style="display: none;">
        <a href="index.php">Cancel</a>
    </form>
    <center>
        <?php }else{
            header("location:index.php");
        }
        ?>

    <?php
    $err = "";
    if(isset($_POST['mark']) && isset($_POST['id']) && isset($_POST['cour'])){
        $sql = "UPDATE student_course SET Mark = :m WHERE studentId = :id AND courseCode = :cc";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':m' => $_POST['mark'],
            ':id' => $_POST['id'],
            ':cc' => $_POST['cour']
        ));
        header("location:index.php");
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>