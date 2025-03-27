
<?php

    include_once "application/models/student_model.php";

    $studentObj = new Student_Model();
    $subjectObj = new Student_Model();

    $StudentResult= $studentObj->getFeeStudents();
    $SubjectResult= $subjectObj->getFeeSubs();

    $role_id = ($this->session->userdata['logged_in']['role']);
    $access = "none";
    if($role_id==1){
        $access = "block";
    }

?>

<html>
    <head>
        <title>Payment Details</title>
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
            td{
                width:400px;
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
                    
                    <a href="<?php echo base_url() . 'dashboardcontroller/addStudent'?>">
                        <button class="btn btn-primary restricted" style="float: right"><span class="glyphicon glyphicon-plus"></span> Add Students</button>
                    </a>
                        <h2 align="center" style="font-weight:bold">PAYMENT DETAILS</h2>
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Monthly Fees</th>
                                <th>Paid/Unpaid</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                while($student_row=$StudentResult->fetch_assoc()){
                                    $student_id=$student_row["student_id"];
                                    $monthly= 0;
                                    for($i = 1; $i <= 4; $i++){
                                        $subject_row = $SubjectResult->fetch_assoc();
                                        $monthly += $subject_row["monthly_fee"];
                                    }

                            ?>
                            <tr>
                                <td><?php  echo $student_row["student_id"]  ?></td>
                                <td><?php  echo ucwords($student_row["student_name"])  ?></td>
                                <td><?php  echo $monthly ?></td>
                                <td><button class="btn btn-danger button">Unpaid</button>
                                    
                                <script>
                                    const buttons = document.querySelectorAll('.button');

                                    buttons.forEach(button => {
                                        if(button.textContent == 'Unpaid'){
                                            button.addEventListener('click', () => {
                                                sendEmail(button);
                                            });
                                        }
                                    });

                                    function sendEmail(button) {
                                        const studentId = button.closest('tr').querySelector('td:first-child').textContent;
                                        
                                        // Make an AJAX request to call the sendemail() function in the CodeIgniter controller
                                        const xhr = new XMLHttpRequest();
                                        xhr.open('GET', `dashboardController/sendemail/${studentId}`, true);
                                        xhr.send();
                                    }
                                </script>
                                    
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
    <script>


const unpaidStudentIds = [];
        const buttons2 = document.querySelectorAll('.button');

        function updateButtonState(button) {
            if (button.classList.contains('btn-success')) {
            button.classList.remove('btn-success');
            button.classList.add('btn-danger');
            button.textContent = 'Unpaid';
        } else {
            button.classList.remove('btn-danger');
            button.classList.add('btn-success');
            button.textContent = 'Paid';
        }
        
        }

        buttons2.forEach(button => {
            button.addEventListener('click', () => {
        updateButtonState(button);

        // Store button state in localStorage
            const studentId = button.closest('tr').querySelector('td:first-child').textContent;
            const currentMonth = new Date().getMonth();
            localStorage.setItem(`button_${studentId}`, currentMonth);
        });

    // Retrieve button state from localStorage
        const studentId = button.closest('tr').querySelector('td:first-child').textContent;
        const storedMonth = localStorage.getItem(`button_${studentId}`);
        const currentMonth = new Date().getMonth();

        if (storedMonth && Number(storedMonth) === currentMonth) {
            updateButtonState(button);
        }
        });
    </script>

    <script type="text/javascript" src="../js/datatable/jquery-3.5.1.js"></script>
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){

            $("#maintable").DataTable();

        });

    </script>    
</html>
