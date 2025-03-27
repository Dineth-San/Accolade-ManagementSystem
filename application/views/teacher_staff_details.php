<!DOCTYPE html>
<head>
    <title>Teacher And Staff Details</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
    <style>
        body{
                background-color:#faf0e6;
            }
        h2{
            font-family: verdana;
        }
        .teacher:hover{
            transition: 0.5s;
            background-color: #2ff740;
            padding-top:100px;
            margin-right:100px;
            border: 4px solid #25632a;
        }
        .employee:hover{
            transition: 0.5s;
            background-color: #1dd8f5;
            padding:100px;
            border: 4px solid #25632a;
        }
        .teacher{
            background-color: #7df0a1;
            margin-top:150px;
            width:30%;
            position: relative;
            padding:90px;
            left:15%;
            font-family: verdana;
            text-align:center;
            font-size: 30px;
            float: left;
        }
        .employee{
            background-color: #55d9e6;
            margin-top:150px;
            width:30%;
            font-family: verdana;
            position: relative;
            padding:90px;
            right:15%;
            text-align:center;
            font-size: 30px;
            float: right;
        }
        button{
            position:relative;
            left:20px;
            top:50px;
        }


    </style>
</head>
<body>

    <a href="<?php echo base_url() . 'dashboardController/dashboard'; ?>">
        <button style="float: left" class="btn btn-info"><span class="glyphicon glyphicon-circle-arrow-left"></span> Dashboard
        </button>    
    </a>

    <br><br>
    <h2 align="center" style="font-weight:bold">TEACHER AND STAFF DETAILS</h2>
    <hr>
        
    <a href="<?php echo base_url() . 'dashboardcontroller/teacher_details'; ?>">
        <div class="teacher">
            Teacher Details
            <img style="width: 75px; height: 75px;" src="../images/teacher.jpg" alt="teacher">
        </div>
    </a>
    <a href="<?php echo base_url() . 'dashboardcontroller/employee_details'; ?>">
        <div class="employee">
            Employee Details
            <img style="width: 75px; height: 75px;" src="../images/employee.jpg" alt="employee">
        </div>
    </a>


</body>
</html>