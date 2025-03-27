
<?php

    include_once "application/models/student_model.php";

    $subjectObj = new Student_Model();

    $SubjectResult= $subjectObj->getSubs();

?>

<html>
    <head>
        <title>Add Teachers</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <style>
            *{
                font-family: verdana;
                font-size: 15px;
            }
            body{
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
                    <h2 align="center" style="font-weight:bold">Add Teacher</h2>
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
                    
                    <form action="<?php echo site_url('dashboardController/addTeach')?>" method="post">

                        <div class="col-md-2">
                            <label class="control-label">Name</label>
                        </div>
                        <div class="col-md-3">
                            <input required type="text" class="form-control" name="name" />
                        </div>

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Email</label>
                        </div>
                        <div class="col-md-3">
                            <input required type="email" class="form-control" name="email"/>
                        </div>

                        <br><br><br><br>
                     
                        <div class="col-md-2">
                            <label class="control-label">Subject</label>
                        </div>
                        <div class="col-md-3">  
                                <select required class="form-control" name="subject">
                                <option value=""></option>
                                <?php
                                while($subs_row=$SubjectResult->fetch_assoc()){
                                    {
                                        ?>
                                        <option value="<?php echo $subs_row["subject_id"]?>">
                                            <?php echo $subs_row["subject_name"]; ?> 
                                        </option>
                                        <?php
                                    }
                                }

                                ?>

                                </select>
                        </div>

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Date Of Birth</label>
                        </div>
                        <div class="col-md-3">
                            <input required type="date" class="form-control" name="dob"/>
                        </div>

                        <div class="col-md-1">
                        </div>

                        <br><br><br><br>
                        <div class="row" style="margin-left:550px">
                            <button type="submit" class= "btn btn-success">Add Teacher</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
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

                