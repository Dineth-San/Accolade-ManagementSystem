<!DOCTYPE html>
<head>
    <title>Timetables</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
    <style>
        body{
                background-color:#faf0e6;
            }
        h2{
            font-family: verdana;
        }
        .as:hover{
            transition: 0.5s;
            background-color: #b728d4;
            padding-top:100px;
            margin-right:100px;
            border: 4px solid #25632a;
        }
        .a2:hover{
            transition: 0.5s;
            background-color: #166cc7;
            padding:100px;
            border: 4px solid #25632a;
        }
        .as{
            background-color: #dd74f2;
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
        .a2{
            background-color: #4696eb;
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
    <h2 align="center" style="font-weight:bold">TIMETABLES</h2>
    <hr>
        
    <a href="<?php echo base_url() . 'dashboardcontroller/AStimetbl'; ?>">
        <div class="as" style="color:black;">
            AS
        </div>
    </a>
    <a href="<?php echo base_url() . 'dashboardcontroller/A2timetbl'; ?>">
        <div class="a2" style="color:black;">
            A2
        </div>
    </a>


</body>
</html>