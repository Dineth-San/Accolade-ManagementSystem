
<?php

    include_once "application/models/student_model.php";

    $teacherObj = new Student_Model();

    $SubjectResult= $teacherObj->getTeacherDet();

    $role_id = ($this->session->userdata['logged_in']['role']);
    $access = "none";
    if($role_id==1){
        $access = "block";
    }


?>

<html>
    <head>
        <title>Teacher Details</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>

        <style>
            body{
                background-color:#faf0e6;
            }
            *{
                font-family: verdana;
                font-size: 15px;
            }
            .restricted{
                display: <?php echo $access ?>;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">  
            <div class="row">
                       
            </div>
            <div class="row">
                <div class="col-md-12">
                    <br><br>
                    <a href="<?php echo base_url() . 'dashboardController/teacher_staff_details'; ?>">
                        <button style="float: left" class="btn btn-info"><span class="glyphicon glyphicon-circle-arrow-left"></span> Details
                        </button>    
                    </a>
					<a href="<?php echo base_url() . 'dashboardcontroller/addTeacher'?>">
                        <button class="btn btn-primary restricted" style="float: right"><span class="glyphicon glyphicon-plus"></span> Add Teachers</button>
                    </a>
                    
					
                    <h2 align="center" style="font-weight:bold">TEACHER DETAILS</h2>
                    <hr>
                    <br><br>
                </div>        
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1" >
                    <table class="table" id="maintable">
                        <thead>
                            <tr>
                                <th>Teacher ID</th>
                                <th>Teacher Name</th>
                                <th>Subject Name</th>
                                <th>Teacher percentage</th> 
                                <th class="restricted">Monthly Salary</th>
                            </tr> 
                        </thead>
                        <tbody>
                        <?php
                                while($teacher_row= $SubjectResult->fetch_assoc()){
                                    $salary = $teacher_row["base_salary"]+($teacher_row["monthly_fee"]*$teacher_row["teacher_percentage"]/100);
                            ?>
                            <tr>
                                <td><?php  echo $teacher_row["teacher_id"]  ?></td>
                                <td><?php  echo ucwords($teacher_row["teacher_name"])  ?></td>
                                <td><?php  echo $teacher_row["subject_name"] ?></td>
                                <td><?php  echo $teacher_row["teacher_percentage"] ?></td>
                                <td class="restricted"><?php echo $salary?>
                                <br>
                                <a href="<?php echo base_url() . 'dashboardcontroller/change_teacher_details'?>?teacher_id=<?php echo $teacher_row["teacher_id"]; ?>">
                                    <button class="btn btn-success">
                                        Edit Details
                                    </button>
                                </a>
                                </td>
                            </tr> 
                            <?php  
                                }        
                            ?>
                        </tbody>   
                    </table>
                </div>
            </div>
        </div>
    </body>   
    <script type="text/javascript" src="../js/datatable/jquery-3.5.1.js"></script>
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){

            $("#maintable").DataTable();

        });

    </script>    
</html>
