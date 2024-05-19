<html>

<?php
require 'conn.php';

if(isset($_GET["id"]) && isset($_GET["course"])){
$id = $_GET['id'];
$cour = $_GET['course'];
    echo "<p>Grading a Student With ID $id IN The Course $cour </p>";
}

$err = "";
    if(isset($_POST['mark']) && isset($_POST['id']) && isset($_POST['cour'])){
        $sql = "UPDATE student_course SET Mark = :m WHERE studentId = :id AND courseCode = :cc";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(
            ':m' => $_POST['mark'],
            ':id' => $_POST['id'],
            ':cc' => $_POST['cour']
        ));
    }
    ?>

    <form>
        <label for="mark">Mark:</label>
        <input type="number" name="mark">
        <?php if(!empty($err)){echo $err;}?>
        <br>
        <input type="submit">
        <br>
        <input type="text" name="id" value="<?php echo $id ?>" style="display: none;">
        <input type="text" name="cour" value="<?php echo $cour ?>" style="display: none;">
        <a href="index.php">Cancel</a>
    </form>
    </html>