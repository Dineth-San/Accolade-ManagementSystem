
<?php

    include_once "application/models/student_model.php";

    $studentObj = new Student_Model();
    $subjectObj = new Student_Model();
    $subjectObj2 = new Student_Model();


    $student_id= $_GET["student_id"]; 


    $SubjectResult= $subjectObj->getStuSub($student_id);
    $StudentResult= $studentObj->getAllStudents();    
    $SubjectResult2= $subjectObj2->getSubDet();

?>

<html>
    <head>
        <title>Edit Student Details</title>
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
                    <a href="<?php echo base_url() . 'dashboardController/student_details'; ?>">
                        <button style="float: left" class="btn btn-info"><span class="glyphicon glyphicon-circle-arrow-left"></span> Student Details
                        </button>    
                    </a>
                    <h2 align="center" style="font-weight:bold">Edit Student Details</h2>
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
                    
                    <form action="<?php echo site_url('dashboardController/update_student_records')?>?student_id=<?php echo $student_id ?>" method="post">
                    <?php
                    while($student_row=$StudentResult->fetch_assoc()){

                        if($student_row["student_id"]==$student_id){
                        ?>

                        <div class="col-md-2">
                            <label class="control-label">Student ID</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="student_id" value= "<?php  echo $student_row["student_id"] ?>"/>
                        </div>

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="name" value= "<?php  echo $student_row["student_name"] ?>"/>
                        </div>

                        

                        <br><br><br><br>
                        

                        <?php
                            for($i = 1; $i <= 4; $i++){


                        ?>
                            <div class="col-md-2">
                                <label class="control-label">Subject <?php echo $i ?></label>
                            </div>
                            <div class="col-md-3">
                                    <select class="form-control" name="subject_<?php echo $i ?>">
                                    <option value="<?php echo $student_row["subject_$i"] ?>" selected="selected">
                                    <?php 
                                        while($subject_row= $SubjectResult->fetch_assoc()){
                                            if($student_row["subject_$i"]==$subject_row["subject_id"]){
                                            echo $subject_row["subject_name"];
                                            }
                                        }
                                        $SubjectResult->data_seek(0);

                                    ?>
                                    </option>
                                    <?php
                                    while($subs_row=$SubjectResult2->fetch_assoc()){
                                        if(
                                        $subs_row["subject_id"]!==$student_row["subject_1"] &&
                                        $subs_row["subject_id"]!==$student_row["subject_2"] && 
                                        $subs_row["subject_id"]!==$student_row["subject_3"] &&
                                        $subs_row["subject_id"]!==$student_row["subject_4"]){
                                            ?>
                                            <option value="<?php echo $subs_row["subject_id"]?>">
                                                <?php echo $subs_row["subject_name"]; ?> 
                                            </option>
                                            <?php
                                        }
                                    }
                                    $SubjectResult2->data_seek(0);

                                    ?>
    
                                    </select>
                            </div>

                        <?php 
                            if($i%2==0){
                                ?>
                                    <br><br><br><br>
                                <?php
                            }
                            else{
                                ?>
                                <div class="col-md-1">
                                </div>
                                <?php
                            }
                            } 
                        ?>

                        <div class="col-md-2">
                            <label class="control-label">Grade</label>
                        </div>
                            <?php
                                if($student_row["grade"]==1){
                                    $grade = "AS";
                                    $val = "2";
                                    $othergrade = "A2";
                                } 
                                else{
                                    $grade = "A2";
                                    $val = "1";
                                    $othergrade = "AS";
                                }
                            ?>
                        <div class="col-md-3">
                            <select class="form-control" name="grade">
                                <option value="<?php echo $student_row["grade"] ?>"><?php echo $grade ?></option>
                                <option value="<?php echo $val ?>"><?php echo $othergrade ?></option>
                            </select>
                        </div>

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Parent's Email</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="email" value= "<?php  echo $student_row["parent_email"] ?>"/>
                        </div>


                        <br><br><br><br>

                        <div class="col-md-2">
                            <label class="control-label">Date Of Birth</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="dob" value= "<?php  echo $student_row["dob"] ?>"/>
                        </div>

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Student Status</label>
                        </div>
                        <div class="col-md-3">
                            <?php  
                                if($student_row["student_status"]!="1"){
                                    ?>
                                        <a href="<?php echo site_url('dashboardController/activate_deactivate_student')?>?status=activate&student_id=<?php echo $student_id ?>"class="btn btn-success">
                                            <span class="glyphicon glyphicon-ok"></span>
                                            &nbsp;
                                            Activate
                                        </a>
                                    <?php 
                                }
                                else{
                                    
                                    ?>
                                        <a href="<?php echo site_url('dashboardController/activate_deactivate_student')?>?status=deactivate&student_id=<?php echo $student_id ?>" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-remove"></span>
                                            &nbsp;
                                            Deactivate
                                        </a>
                                    <?php
                                }
                            ?>
                        </div>
                        <?php
                        }
                    }
                    ?>
                    <br><br><br><br>
                    <div class="row" style="margin-left:500px">
                        <button type="submit" class= "btn btn-success">Update</button>
                        <button type="reset" class= "btn btn-warning">Reset</button>
                        <a href="<?php echo site_url('dashboardController/delStu')?>?student_id=<?php echo $student_id ?>" class="btn btn-danger">
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

                