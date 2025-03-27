<?php

include_once "application/config/dbconnection.php";
$dbconnection = new dbconnection();
class Student_Model extends CI_Model{

    function getAllStudents(){
        $con= $GLOBALS["con"];
        $sql="SELECT * FROM student_details";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    function getAllSubs(){
        $con= $GLOBALS["con"];
        $sql= "SELECT student_id, subject_id, subject_name AS subject FROM student_details 
        JOIN subject_details 
        ON student_details.subject_1 = subject_details.subject_id 
        OR student_details.subject_2 = subject_details.subject_id 
        OR student_details.subject_3 = subject_details.subject_id 
        OR student_details.subject_4 = subject_details.subject_id
        ORDER BY student_id";

        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    function getSubDet(){
        $con = $GLOBALS["con"];
        $sql = "SELECT teacher_name, subject_id, subject_name, monthly_fee FROM teacher_details
                JOIN subject_details ON subject_details.subject_id = teacher_details.subject
                ORDER BY subject_id";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    function stuCount($teacher_row){
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(subject_id) FROM subject_details
                JOIN student_details
                ON student_details.subject_1 = subject_details.subject_id 
                OR student_details.subject_2 = subject_details.subject_id 
                OR student_details.subject_3 = subject_details.subject_id 
                OR student_details.subject_4 = subject_details.subject_id
                WHERE subject_id = {$teacher_row['subject_id']} AND student_status=1";
                
        $result= $con->query($sql) or die($con->error);
        return $result;
    }
    
    function getStuSub($student_id){
        $con = $GLOBALS["con"];
        $sql = "SELECT student_id, subject_id, subject_name FROM subject_details
                JOIN student_details
                ON student_details.subject_1 = subject_details.subject_id 
                OR student_details.subject_2 = subject_details.subject_id 
                OR student_details.subject_3 = subject_details.subject_id 
                OR student_details.subject_4 = subject_details.subject_id
                WHERE student_id = $student_id";
                
        $result= $con->query($sql) or die($con->error);
        return $result;
    }
    
    function getTeacherDet(){
        $con= $GLOBALS["con"];
        $sql = "SELECT *
                FROM teacher_details
                JOIN subject_details ON teacher_details.subject = subject_details.subject_id";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    function getEmpDet(){
        $con= $GLOBALS["con"];
        $sql = "SELECT *, role_name, salary FROM user_login
                JOIN role ON user_login.role = role.role_id";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    function activateStu($student_id){
        $con= $GLOBALS["con"];
        $sql="UPDATE student_details SET student_status= 1 WHERE student_id='$student_id'";
        $result= $con->query($sql) or die($con->error);
        
    }
    
    function deactivateStu($student_id){
        $con= $GLOBALS["con"];
        $sql="UPDATE student_details SET student_status= 0 WHERE student_id='$student_id'";
        $result= $con->query($sql) or die($con->error);

    }

    public function UpdateStu($student_id, $name, $subject_1, $subject_2, $subject_3, $subject_4, $grade, $email, $dob){
        $con= $GLOBALS["con"];
        $sql=
            "UPDATE student_details
            SET 
            student_name = '$name',
            subject_1 = '$subject_1',
            subject_2 = '$subject_2',
            subject_3 = '$subject_3', 
            subject_4 = '$subject_4', 
            grade = '$grade',
            parent_email = '$email', 
            dob = '$dob'
            WHERE student_id = '$student_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;

    }

    public function delStudent($student_id){
        $con= $GLOBALS["con"];
        $sql="DELETE FROM student_details WHERE student_id = '$student_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    public function addStudent($name, $subject_1, $subject_2, $subject_3, $subject_4, $grade, $dob, $parent_email){
        $con= $GLOBALS["con"];
        $sql=" INSERT INTO student_details(student_name, subject_1, subject_2, subject_3, subject_4, grade, dob, parent_email) 
        VALUES ('$name', '$subject_1', '$subject_2', '$subject_3', '$subject_4', '$grade', '$dob', '$parent_email')";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    public function updateTeacher($teacher_id, $name, $email, $dob){
        $con= $GLOBALS["con"];
        $sql=
            "UPDATE teacher_details
            SET 
            teacher_name = '$name',
            email = '$email',
            dob = '$dob'
            WHERE teacher_id = '$teacher_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;

    }

    public function delTeacher($teacher_id){
        $con= $GLOBALS["con"];
        $sql="DELETE FROM teacher_details WHERE teacher_id = '$teacher_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    function getSubs(){
        $con = $GLOBALS["con"];
        $sql = "SELECT subject_id, subject_name FROM Subject_details";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    public function addTeach($name, $subject, $dob, $email){
        $con= $GLOBALS["con"];
        $sql=" INSERT INTO teacher_details(teacher_name, subject, dob, email) 
        VALUES ('$name', '$subject', '$dob', '$email')";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    public function getRoles(){
        $con= $GLOBALS["con"];
        $sql= "SELECT * FROM role ";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    public function updateEmployee($user_id, $fname, $lname, $email, $dob, $role, $password){
        $con= $GLOBALS["con"];
        $sql=
            "UPDATE user_login
            SET 
            user_name = '$fname',
            last_name = '$lname',
            dob = '$dob',
            user_email = '$email',
            role = '$role',
            user_password = '$password'
            WHERE user_id = '$user_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    public function delEmployee($user_id){
        $con= $GLOBALS["con"];
        $sql="DELETE FROM user_login WHERE user_id = '$user_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    public function addEmp($fname, $lname, $email, $dob, $role, $password){
        $con= $GLOBALS["con"];
        $sql=" INSERT INTO user_login(user_name, last_name, user_email, dob, role, user_password)
         VALUES ('$fname', '$lname', '$email', '$dob', '$role', '$password')";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    public function updateRoles($role_id, $name, $salary){
        $con= $GLOBALS["con"];
        $sql=
            "UPDATE role
            SET 
            role_name = '$name',
            salary = '$salary'
            WHERE role_id = '$role_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    public function getStudents($subject_id, $grade){
        $con= $GLOBALS["con"];
        $sql=   "SELECT student_name, parent_email, grade FROM student_details
                WHERE 
                (grade = '$grade') AND
                (subject_1 = '$subject_id' OR
                subject_2 = '$subject_id' OR
                subject_3 = '$subject_id' OR
                subject_4 = '$subject_id')";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }
    
    function getSubName($subject_id){
        $con = $GLOBALS["con"];
        $sql = "SELECT subject_name FROM Subject_details
                WHERE subject_id = '$subject_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    function getFeeSubs(){
        $con= $GLOBALS["con"];
        $sql= "SELECT student_id, subject_id, monthly_fee, subject_name AS subject FROM student_details 
        JOIN subject_details 
        ON student_details.subject_1 = subject_details.subject_id 
        OR student_details.subject_2 = subject_details.subject_id 
        OR student_details.subject_3 = subject_details.subject_id 
        OR student_details.subject_4 = subject_details.subject_id
        WHERE student_status = 1
        ORDER BY student_id";

        $result= $con->query($sql) or die($con->error);
        return $result;
    }

    function getFeeStudents(){
        $con= $GLOBALS["con"];
        $sql="SELECT * FROM student_details WHERE student_status=1";
        $result= $con->query($sql) or die($con->error);
        return $result;
    }

}

