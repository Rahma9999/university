<?php
require "conn.php";
if(!empty($_GET['id'])){
    $id = $_GET['id'];
    // $sql = "DELETE s.studentId FROM student_course sc, student s WHERE s.studentId = ? AND sc.studentId = s.studentId";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute([$id]);

    $sql = "DELETE sc, s FROM student_course sc INNER JOIN student s ON s.studentId = sc.studentId WHERE s.studentId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
}
header("location:index.php");