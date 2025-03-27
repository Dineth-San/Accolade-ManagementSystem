<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
} else {
    header("location: login");
}
?>

<head>
    <?php $this->load->view('head'); ?>
    <title>Dashboard</title>
    <style>
        *{
            font-family: verdana;
        }
        h4{
            color:black;
        }
        div>h4:hover{
            font-size:30px;
            transition: 0.5s;
        }
        #tray:hover{
            transition:0.5s;
            border: 8px solid #007BFF;
        }
        body{
            background-image: url("../images/background.jfif");
        }
    </style>
</head>

<body>

    <?php $this->load->view('nav'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

            <br>

                <a href="<?php echo base_url() . 'dashboardcontroller/student_details'; ?>">
                    <div id="tray" class="col-md-12 panel" style="background-color: #b5b5b5; height: 200px; display:inline-block; border-radius:30px; ; ">

                        <div class="row" style="height:10px">
                        </div>

                        <h4 class="h4" align="center">Student Details</h4>

                        <div class="row" style="height:10px">
                        </div>

                        <h5 align="center">
                            <img src="../images/student_details.jpg" width="100px" height="100px"/>
                        </h5>
                    </div>
                    <br><br>
                </a>

                <a href="<?php echo base_url() . 'dashboardcontroller/subject_details'; ?>">
                    <div id="tray" class="col-md-12 panel" style="background-color: #b5b5b5; height: 200px; display:inline-block; border-radius:30px; ; ">

                        <div class="row" style="height:10px">
                        </div>

                        <h4 class="h4" align="center">Subject Details</h4>

                        <div class="row" style="height:10px">
                        </div>

                        <h5 align="center">
                            <img src="../images/subject_details.png" width="100px" height="100px"/>
                        </h5>
                    </div>
                    <br><br>
                </a>

                <a href="<?php echo base_url() . 'dashboardcontroller/teacher_staff_details'; ?>">
                    <div id="tray" class="col-md-12 panel" style="background-color: #b5b5b5; height: 200px; display:inline-block; border-radius:30px;">

                        <div class="row" style="height:10px">
                        </div>

                        <h4 class="h4" align="center">Teacher & Staff Member Details</h4>

                        <div class="row" style="height:10px">
                        </div>

                        <h5 align="center">
                            <img src="../images/teacher_details.jpg" width="100px" height="100px"/>
                        </h5>
                    </div>
                    <br><br>
                </a>
            
                <a href="<?php echo base_url() . 'dashboardcontroller/timetables'; ?>">
                    <div id="tray" class="col-md-12 panel" style="background-color: #b5b5b5; height: 200px; display:inline-block; border-radius:30px;">

                        <div class="row" style="height:10px">
                        </div>

                        <h4 class="h4" align="center">Timetables</h4>

                        <div class="row" style="height:10px">
                        </div>

                        <h5 align="center">
                            <img src="../images/timetables.png" width="100px" height="100px"/>
                        </h5>
                    </div>
                    <br><br>
                </a>

                <a href="<?php echo base_url() . 'dashboardcontroller/student_fee'; ?>">
                    <div id="tray" class="col-md-12 panel" style="background-color: #b5b5b5; height: 200px; display:inline-block; border-radius:30px; ">

                        <div class="row" style="height:10px">
                        </div>

                        <h4 class="h4" align="center">Student Fee Details</h4>

                        <div class="row" style="height:10px">
                        </div>

                        <h5 align="center">
                            <img src="../images/student_fee.png" width="100px" height="100px"/>
                        </h5>
                    </div>
                </a>
                <br><br>
            </div>
        </div>
    </div>


</body>

</html>
<?php $this->load->view('script'); ?>