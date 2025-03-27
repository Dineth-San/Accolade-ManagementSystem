
<?php

    include_once "application/models/student_model.php";

    $subjectObj = new Student_Model();
    $subjectObj2 = new Student_Model();

    $SubjectResult= $subjectObj->getSubDet();


?>

<html>
    <head>
        <title>Subject Details</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <style>
            body{
                background-color:#faf0e6;
            }
            *{
                font-family: verdana;
                font-size: 15px;
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
                    <h2 align="center" style="font-weight:bold">SUBJECT DETAILS</h2>
                    <hr>
                    <br><br>
                </div>        
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1" >
                    <table class="table" id="maintable">
                        <thead>
                            <tr>
                                <th>Subject ID</th>
                                <th>Subject Name</th>
                                <th>Teacher Name</th>
                                <th>Student Count</th> 
                                <th>Monthly Fee</th>
                                <th>Monthly Income</th>
                                <th>Get Register</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                while($teacher_row= $SubjectResult->fetch_assoc()){
                                    $SubjectResult2= $subjectObj2->stuCount($teacher_row);
                                    $count_row = $SubjectResult2->fetch_assoc();
                                    $total = $count_row["COUNT(subject_id)"]*$teacher_row["monthly_fee"];                                                        
                            ?>
                            <tr>
                                <td><?php  echo $teacher_row["subject_id"]  ?></td>
                                <td><?php  echo $teacher_row["subject_name"]  ?></td>
                                <td><?php  echo ucwords($teacher_row["teacher_name"]) ?></td>
                                <td><?php  echo $count_row["COUNT(subject_id)"] ?></td>
                                <td><?php  echo $teacher_row["monthly_fee"] ?></td>
                                <td><?php  echo $total ?></td>
                                <td>
                                    <a href="<?php echo site_url('dashboardController/Register') ?>?grade=1&subject_id=<?php echo $teacher_row["subject_id"] ?>"><button class="btn btn-success">AS</button></a>
                                    &nbsp;
                                    <a href="<?php echo site_url('dashboardController/Register') ?>?grade=2&subject_id=<?php echo $teacher_row["subject_id"] ?>"><button class="btn btn-info">A2</button></a></td>
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
