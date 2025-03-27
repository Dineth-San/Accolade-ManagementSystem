
<?php

    include_once "application/models/student_model.php";

    $studentObj = new Student_Model();
    $subjectObj = new Student_Model();

    $StudentResult= $studentObj->getAllStudents();
    $SubjectResult= $subjectObj->getAllSubs();

    $role_id = ($this->session->userdata['logged_in']['role']);
    $access = "none";
    if($role_id==1){
        $access = "block";
    }

?>

<html>
    <head>
        <title>Student Details</title>
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
                    
                    <a href="<?php echo base_url() . 'dashboardController/dashboard'; ?>">
                        <button style="float: left" class="btn btn-info"><span class="glyphicon glyphicon-circle-arrow-left"></span> Dashboard
                        </button>    
                    </a>
                    
                    <a href="<?php echo base_url() . 'dashboardcontroller/addStudent'?>">
                        <button class="btn btn-primary restricted" style="float: right"><span class="glyphicon glyphicon-plus"></span> Add Students</button>
                    </a>
                        <h2 align="center" style="font-weight:bold">STUDENT DETAILS</h2>
                    <hr>
                    <br><br>
                </div>        
            </div>

            <div class="row text-center">
			    <div style="width:40%; margin:auto">
                <?php
                if (isset($error_message)) {
                    echo "<div class='alert alert-warning' role='alert'><span class='sr-only'>Error:</span>";
                    echo $error_message;
                    echo "</div>";
		        }
                ?>
                </div>
                </div>
            
            <div class="row">
                <div class="col-md-10 col-md-offset-1" >
                    <table class="table" id="maintable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Parent Email</th>
                                <th>Subject 1</th>
                                <th>Subject 2</th>
                                <th>Subject 3</th>
                                <th>Subject 4</th>
                                <th>Grade</th>
                                <th>Status</th>
                                <th class="restricted">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                while($student_row=$StudentResult->fetch_assoc()){
                                    $student_id=$student_row["student_id"];  

                            ?>
                            <tr>
                                <td><?php  echo $student_row["student_id"]  ?></td>
                                <td><?php  echo ucwords($student_row["student_name"])  ?></td>
                                <td><?php  echo $student_row["parent_email"] ?></td>

                                <?php
                                for($i = 1; $i <= 4; $i++){
                                    $subject_row= $SubjectResult->fetch_assoc() ?>
                                    <td><?php  echo $subject_row["subject"]; ?></td>
                                <?php 
                                } 
                                ?>
                                
                                    <?php
                                    if($student_row["grade"]=="1"){
                                    ?>
                                        <td style="background-color:lightyellow">
                                            AS
                                        </td>

                                    <?php
                                        }
                                        else{
                                    ?>
                                        <td style="background-color:lightblue">
                                            A2
                                        </td>

                                    <?php
                                        }
                                    ?>
                                <?php
                                    if($student_row["student_status"]=="1"){
                                ?>
                                        <td class="success">
                                            Active
                                        </td>

                                <?php
                                    }
                                    else{
                                ?>
                                        <td class="danger">
                                            Deactive
                                        </td>

                                <?php
                                    }
                                ?>

                                <td class="restricted">
                                    
                                    <a href="<?php echo base_url() . 'dashboardcontroller/change_student_details'?>?student_id=<?php echo $student_id; ?>">
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
