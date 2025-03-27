
<?php

    include_once "application/models/student_model.php";

    $roleObj = new Student_Model();

    $RoleResult= $roleObj->getRoles();


?>

<html>
    <head>
        <title>Role Details</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <style>
            *{
                font-family: verdana;
                font-size: 15px;
            }
            td{
                height: 75px;
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
                    <h2 align="center" style="font-weight:bold">ROLE DETAILS</h2>
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
                                <th>Role ID</th>
                                <th>Role Name</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                        <form action="<?php echo site_url('dashboardController/update_roles')?>" method= "post">
                        <?php
                                while($role_row= $RoleResult->fetch_assoc()){
                            ?>
                            <tr>
                            <td><input required type="text" class="form-control" name="role_id" value="<?php  echo $role_row["role_id"]  ?>"></td>
                            <td><input required type="text" class="form-control" name="name" value="<?php  echo $role_row["role_name"]  ?>"></td>
                            <td><input required type="text" class="form-control" name="salary" value="<?php  echo $role_row["salary"] ?>"></td>
                            <td><button type="submit" class= "btn btn-success">Submit</button></td>
                            </tr>
                            <?php  
                                }        
                            ?>
                        </tbody>   
                    </table>
                    </form>
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
