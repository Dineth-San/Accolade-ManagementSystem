
<?php

    include_once "application/models/student_model.php";

    $empObj = new Student_Model();
    $roleObj = new Student_Model();

    $user_id= $_GET["user_id"]; 

    $EmpResult= $empObj->getEmpDet();
    $RoleResult= $roleObj->getRoles();

?>

<html>
    <head>
        <title>Edit Employee Details</title>
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
                    <a href="<?php echo base_url() . 'dashboardController/employee_details'; ?>">
                        <button style="float: left" class="btn btn-info"><span class="glyphicon glyphicon-circle-arrow-left"></span> Employee Details
                        </button>    
                    </a>
                    <h2 align="center" style="font-weight:bold">Edit Employee Details</h2>
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
                    
                    <form action="<?php echo site_url('dashboardController/update_employee_details')?>?user_id=<?php echo $user_id ?>" method="post">
                    <?php
                    while($employee_row=$EmpResult->fetch_assoc()){

                        if($employee_row["user_id"]==$user_id){
                        ?>

                        <div class="col-md-2">
                            <label class="control-label">Employee ID</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="user_id" value= "<?php  echo $employee_row["user_id"] ?>"/>
                        </div>

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">First Name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="fname" value= "<?php  echo $employee_row["user_name"] ?>"/>
                        </div>


                        <br><br><br><br>
                        


                        <div class="col-md-2">
                            <label class="control-label">Last Name</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="lname" value= "<?php  echo $employee_row["last_name"] ?>"/>
                        </div>

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Email</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="email" value= "<?php  echo $employee_row["user_email"] ?>"/>
                        </div>


                        <br><br><br><br>


                        <div class="col-md-2">
                            <label class="control-label">Date Of Birth</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="dob" value= "<?php  echo $employee_row["dob"] ?>"/>
                        </div>

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Role</label>
                        </div>
                        <div class="col-md-3">  
                                <select required class="form-control" name="role">
                                <option value="<?php echo $employee_row["role"] ?>"><?php echo $employee_row["role_name"] ?></option>
                                <?php
                                while($role_row=$RoleResult->fetch_assoc()){
                                    {
                                        if($employee_row["role"]!==$role_row["role_id"]){
                                            ?>
                                            <option value="<?php echo $role_row["role_id"]?>">
                                                <?php echo $role_row["role_name"]; ?> 
                                            </option>
                                            <?php
                                        }
                                    }
                                }

                                ?>

                                </select>
                        </div>
                        <br><br><br><br>
                        


                        <div class="col-md-2">
                            <label class="control-label">Password</label>
                        </div>
                        <div class="col-md-3">
                            <input type="password" class="form-control" name="password" value= "<?php  echo $employee_row["user_password"] ?>"/>
                        </div>

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-2">
                            <label class="control-label">Confirm Password</label>
                        </div>
                        <div class="col-md-3">
                            <input type="password" class="form-control" name="confpassword" value= "<?php  echo $employee_row["user_password"] ?>"/>
                        </div>

                        <?php
                        }
                    }
                    ?>
                    <br><br><br><br>
                    <div class="row" style="margin-left:500px">
                        <button type="submit" class= "btn btn-success">Update</button>
                        <button type="reset" class= "btn btn-warning">Reset</button>
                        <a href="<?php echo site_url('dashboardController/delEmployee')?>?user_id=<?php echo $user_id ?>" class="btn btn-danger">
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

                