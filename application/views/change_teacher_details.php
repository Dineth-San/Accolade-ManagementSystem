
<?php

    include_once "application/models/student_model.php";

    $teacherObj = new Student_Model();

    $teacher_id= $_GET["teacher_id"]; 

    $TeacherResult= $teacherObj->getTeacherDet();

?>

<html>
    <head>
        <title>Edit Teacher Details</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <style>
            *{
                font-family: verdana;
                font-size: 15px;
            }body{
                background-color:#faf0e6;
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
                    <a href="<?php echo base_url() . 'dashboardController/teacher_details'; ?>">
                        <button style="float: left" class="btn btn-info"><span class="glyphicon glyphicon-circle-arrow-left"></span> Teacher Details
                        </button>    
                    </a>
                    <h2 align="center" style="font-weight:bold">Edit Teacher Details</h2>
                    <hr>
                    <br><br>
                </div>        
            </div>
            <div class="row">
                <div class="col-md-11 col-md-offset-1" >
                <div class="col-md-12">
                    
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
                    
                    <form action="<?php echo site_url('dashboardController/update_teacher_details')?>?teacher_id=<?php echo $teacher_id ?>" method="post">
                    <?php
                    while($teacher_row=$TeacherResult->fetch_assoc()){

                        if($teacher_row["teacher_id"]==$teacher_id){
                        ?>

                        <div class="col-md-2">
                            <label class="control-label">Teacher ID</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="teacher_id" value= "<?php  echo $teacher_row["teacher_id"] ?>"/>
                        </div>

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="name" value= "<?php  echo $teacher_row["teacher_name"] ?>"/>
                        </div>

                        

                        <br><br><br><br>
                        


                        <div class="col-md-2">
                            <label class="control-label">Subject</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" disabled class="form-control" name="subject" value= "<?php  echo $teacher_row["subject_name"] ?>"/>
                        </div>

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Parent's Email</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="email" value= "<?php  echo $teacher_row["email"] ?>"/>
                        </div>


                        <br><br><br><br>


                        <div class="col-md-2">
                            <label class="control-label">Date Of Birth</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="dob" value= "<?php  echo $teacher_row["dob"] ?>"/>
                        </div>

                        <div class="col-md-1">
                        </div>

                        
                        <?php
                        }
                    }
                    ?>
                    <br><br><br><br>
                    <div class="row" style="margin-left:500px">
                        <button type="submit" class= "btn btn-success">Update</button>
                        <button type="reset" class= "btn btn-warning">Reset</button>
                        <a href="<?php echo site_url('dashboardController/delTeacher')?>?teacher_id=<?php echo $teacher_id ?>" class="btn btn-danger">
                            Delete
                        </a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>   
    <script type="text/javascript" src="../js/datatable/jquery-3.5.1.js"></script>
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>

</html>

                