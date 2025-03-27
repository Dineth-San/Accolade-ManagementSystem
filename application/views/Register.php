<?php

require_once "application/commons/fpdf181/fpdf.php";
include_once "application/models/student_model.php";

$subject_id= $_GET["subject_id"]; 
$grade= $_GET["grade"]; 

$studentObj= new Student_Model();
$subjectObj= new Student_Model();

$StudentResult= $studentObj->getStudents($subject_id, $grade);
$SubjectResult= $subjectObj->getSubName($subject_id);

if($grade==1){
    $class = "AS";
}
else{
    $class = "A2";
}

$subject_row = $SubjectResult->fetch_assoc();
$subject = $subject_row["subject_name"]; 



$fpdf = new FPDF();

$fpdf->SetTitle("Class Register");   
$fpdf->AddPage("P", "A4", 0);   

$fpdf->SetFont("arial", "B", "17");   
$fpdf->Cell(0, 40, "$subject $class Register", 0, 1, "C");   


$fpdf->SetFont("arial", "B", "10");
$fpdf->Cell(55, 10, "Name ", 1, 0, "C");   
$fpdf->Cell(60, 10, "Email", 1, 0, "C");   
$fpdf->Cell(18, 10, "Week 1", 1, 0, "C");   
$fpdf->Cell(18, 10, "Week 2", 1, 0, "C");   
$fpdf->Cell(18, 10, "Week 3", 1, 0, "C");   
$fpdf->Cell(18, 10, "Week 4", 1, 1, "C");   


$fpdf->SetFont("arial", "", "9");
$ypointer= 60;
while($student_row= $StudentResult->fetch_assoc()){
    $fpdf->Cell(55, 15, ucwords($student_row["student_name"]), 1, 0, "C");   
    $fpdf->Cell(60, 15, $student_row["parent_email"], 1, 0, "C");   
    $fpdf->Cell(18, 15, " ", 1, 0, "C");   
    $fpdf->Cell(18, 15, " ", 1, 0, "C");   
    $fpdf->Cell(18, 15, " ", 1, 0, "C");   
    $fpdf->Cell(18, 15, " ", 1, 1, "C");  
    $ypointer= $ypointer+20;
}


$fpdf->Output();   
