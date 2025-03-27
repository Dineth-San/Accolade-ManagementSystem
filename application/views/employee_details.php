
<?php

    include_once "application/models/student_model.php";

    $employeeObj = new Student_Model();

    $EmployeeResult= $employeeObj->getEmpDet();

    $role_id = ($this->session->userdata['logged_in']['role']);
    $access = "none";
    if($role_id==1){
        $access = "block";
    }
?>

<html>
    <head>
        <title>Employee Details</title>
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
                    <a href="<?php echo base_url() . 'dashboardcontroller/RoleDet'?>">
                        <button class="btn btn-primary restricted" style="float: right; margin-left: 10px"><span class="glyphicon glyphicon-user"></span> Role Details</button>
                    </a>
                    <a href="<?php echo base_url() . 'dashboardcontroller/addEmployee'?>">
                        <button class="btn btn-primary restricted" style="float: right;"><span class="glyphicon glyphicon-plus"></span> Add Employees</button>
                    </a>
                    <h2 align="center" style="font-weight:bold">EMPLOYEE DETAILS</h2>
                    <hr>
                    <br><br>
                </div>        
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1" >
                    <table class="table" id="maintable">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Employee Email</th>
                                <th>Employee Role</th> 
                                <th class="restricted">Monthly Salary</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                while($employee_row= $EmployeeResult->fetch_assoc()){
                                    $fullname = $employee_row['user_name']. " ". $employee_row['last_name'];
                            ?>
                            <tr>
                                <td><?php  echo $employee_row["user_id"] ?></td>
                                <td><?php  echo ucwords($fullname) ?></td>
                                <td><?php  echo $employee_row["user_email"] ?></td>
                                <td><?php  echo ucwords($employee_row["role_name"]) ?></td>
                                <td class="restricted"><?php  echo $employee_row["salary"] ?>
                                <br>
                                <a href="<?php echo base_url() . 'dashboardcontroller/change_employee_details'?>?user_id=<?php echo $employee_row["user_id"]; ?>">
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
