<?php

    include_once "application/models/student_model.php";
    $subjectObj = new Student_Model();
    $SubjectResult= $subjectObj->getSubDet();

    
    $role_id = ($this->session->userdata['logged_in']['role']);
    $access = "none";
    if($role_id==1){
        $access = "block";
    }

?>
<html>
<title>A2 Timetable</title>
</style>
</head>
<body>
<head>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.min.css"/>
        <style>
            *{
                font-family: verdana;
                font-size: 15px;
            }
            .restricted{
                display: <?php echo $access ?>;
            }
             td{
                width:500px;
            }
            tr:nth-child(even) {
                background-color: #c2c2c2;
            }
            tr:nth-child(odd) {
                background-color: #cbf5ef;
            }
            table{
                border:1px black solid;
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
                    
                    <a href="<?php echo base_url() . 'dashboardController/timetables'; ?>">
                        <button style="float: left" class="btn btn-info"><span class="glyphicon glyphicon-circle-arrow-left"></span> Timetables
                        </button>
                    </a>
                        <h2 align="center" style="font-weight:bold">A2 TIMETABLE</h2>
                    <hr>
                    <br><br>
                </div>        
            </div>

            
            <div class="row">
                <div class="col-md-10 col-md-offset-1" >
                    <table class="table" id="maintable">
                        <tr>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Subject</th>
                        </tr>
                        <?php
                            for($i=1; $i<8; $i++){
                                if($i==1){
                                    $day = "Monday";
                                }
                                else if($i==2){
                                    $day = "Tuesday";
                                }
                                else if($i==3){
                                    $day = "Wednesday";
                                }
                                else if($i==4){
                                    $day = "Thursday";
                                }
                                else if($i==5){
                                    $day = "Friday";
                                }
                                else if($i==6){
                                    $day = "Saturday";
                                }
                                else{
                                    $day = "Sunday";
                                }
                        ?>
                        <tr>
                            <td rowspan="2"><?php echo $day ?></td>
                            <td><input style="width: 400px" class="form-control" type="text" id="<?php echo $day ?>Time1" value=""></td>
                            <td>
                                <select required class="form-control"  id="<?php echo $day ?>Activity1">
                                <option value=""></option>
                                <?php
                                while($subs_row=$SubjectResult->fetch_assoc()){
                                    {
                                        ?>
                                        <option value="<?php echo $subs_row["subject_name"]; ?>">
                                            <?php echo $subs_row["subject_name"]; ?> 
                                        </option>
                                        <?php
                                    }
                                }
                                $SubjectResult->data_seek(0);

                                ?>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input style="width: 400px" class="form-control" type="text" id="<?php echo $day ?>Time2" value=""></td>
                            <td>
                                <select required class="form-control"  id="<?php echo $day ?>Activity2">
                                <option value=""></option>
                                <?php
                                while($subs_row=$SubjectResult->fetch_assoc()){
                                    {
                                        ?>
                                        <option value="<?php echo $subs_row["subject_name"]; ?>">
                                            <?php echo $subs_row["subject_name"]; ?> 
                                        </option>
                                        <?php
                                    }
                                }
                                $SubjectResult->data_seek(0);

                                ?>

                                </select>
                            </td>
                        </tr>
                        
                        <?php
                            }
                        ?>
                    </table>
                    <br><br>
                    <button style="margin-left:45%" class="btn btn-success restricted" id="saveChanges">Save Changes</button>

                </div>
            </div>
        </div>



    <br><br><br><br><br>

<script>
    
    function loadTimetable() {

        const Monday1TimeInput = document.getElementById('MondayTime1');
        const Monday1ActivityInput = document.getElementById('MondayActivity1');
        const Monday2TimeInput = document.getElementById('MondayTime2');
        const Monday2ActivityInput = document.getElementById('MondayActivity2');

        const Tuesday1TimeInput = document.getElementById('TuesdayTime1');
        const Tuesday1ActivityInput = document.getElementById('TuesdayActivity1');
        const Tuesday2TimeInput = document.getElementById('TuesdayTime2');
        const Tuesday2ActivityInput = document.getElementById('TuesdayActivity2');

        const Wednesday1TimeInput = document.getElementById('WednesdayTime1');
        const Wednesday1ActivityInput = document.getElementById('WednesdayActivity1');
        const Wednesday2TimeInput = document.getElementById('WednesdayTime2');
        const Wednesday2ActivityInput = document.getElementById('WednesdayActivity2');

        const Thursday1TimeInput = document.getElementById('ThursdayTime1');
        const Thursday1ActivityInput = document.getElementById('ThursdayActivity1');
        const Thursday2TimeInput = document.getElementById('ThursdayTime2');
        const Thursday2ActivityInput = document.getElementById('ThursdayActivity2');

        const Friday1TimeInput = document.getElementById('FridayTime1');
        const Friday1ActivityInput = document.getElementById('FridayActivity1');
        const Friday2TimeInput = document.getElementById('FridayTime2');
        const Friday2ActivityInput = document.getElementById('FridayActivity2');

        const Saturday1TimeInput = document.getElementById('SaturdayTime1');
        const Saturday1ActivityInput = document.getElementById('SaturdayActivity1');
        const Saturday2TimeInput = document.getElementById('SaturdayTime2');
        const Saturday2ActivityInput = document.getElementById('SaturdayActivity2');

        const Sunday1TimeInput = document.getElementById('SundayTime1');
        const Sunday1ActivityInput = document.getElementById('SundayActivity1');
        const Sunday2TimeInput = document.getElementById('SundayTime2');
        const Sunday2ActivityInput = document.getElementById('SundayActivity2');


        Monday1TimeInput.value = localStorage.getItem('MondayTime1') || '';
        Monday1ActivityInput.value = localStorage.getItem('MondayActivity1') || '';
        Monday2TimeInput.value = localStorage.getItem('MondayTime2') || '';
        Monday2ActivityInput.value = localStorage.getItem('MondayActivity2') || '';

        Tuesday1TimeInput.value = localStorage.getItem('TuesdayTime1') || '';
        Tuesday1ActivityInput.value = localStorage.getItem('TuesdayActivity1') || '';
        Tuesday2TimeInput.value = localStorage.getItem('TuesdayTime2') || '';
        Tuesday2ActivityInput.value = localStorage.getItem('TuesdayActivity2') || '';

        Wednesday1TimeInput.value = localStorage.getItem('WednesdayTime1') || '';
        Wednesday1ActivityInput.value = localStorage.getItem('WednesdayActivity1') || '';
        Wednesday2TimeInput.value = localStorage.getItem('WednesdayTime2') || '';
        Wednesday2ActivityInput.value = localStorage.getItem('WednesdayActivity2') || '';

        Thursday1TimeInput.value = localStorage.getItem('ThursdayTime1') || '';
        Thursday1ActivityInput.value = localStorage.getItem('ThursdayActivity1') || '';
        Thursday2TimeInput.value = localStorage.getItem('ThursdayTime2') || '';
        Thursday2ActivityInput.value = localStorage.getItem('ThursdayActivity2') || '';

        Friday1TimeInput.value = localStorage.getItem('FridayTime1') || '';
        Friday1ActivityInput.value = localStorage.getItem('FridayActivity1') || '';
        Friday2TimeInput.value = localStorage.getItem('FridayTime2') || '';
        Friday2ActivityInput.value = localStorage.getItem('FridayActivity2') || '';

        Saturday1TimeInput.value = localStorage.getItem('SaturdayTime1') || '';
        Saturday1ActivityInput.value = localStorage.getItem('SaturdayActivity1') || '';
        Saturday2TimeInput.value = localStorage.getItem('SaturdayTime2') || '';
        Saturday2ActivityInput.value = localStorage.getItem('SaturdayActivity2') || '';

        Sunday1TimeInput.value = localStorage.getItem('SundayTime1') || '';
        Sunday1ActivityInput.value = localStorage.getItem('SundayActivity1') || '';
        Sunday2TimeInput.value = localStorage.getItem('SundayTime2') || '';
        Sunday2ActivityInput.value = localStorage.getItem('SundayActivity2') || '';

        
    }

    function saveChanges() {
        const Monday1TimeInput = document.getElementById('MondayTime1');
        const Monday1ActivityInput = document.getElementById('MondayActivity1');
        const Monday2TimeInput = document.getElementById('MondayTime2');
        const Monday2ActivityInput = document.getElementById('MondayActivity2');

        const Tuesday1TimeInput = document.getElementById('TuesdayTime1');
        const Tuesday1ActivityInput = document.getElementById('TuesdayActivity1');
        const Tuesday2TimeInput = document.getElementById('TuesdayTime2');
        const Tuesday2ActivityInput = document.getElementById('TuesdayActivity2');

        const Wednesday1TimeInput = document.getElementById('WednesdayTime1');
        const Wednesday1ActivityInput = document.getElementById('WednesdayActivity1');
        const Wednesday2TimeInput = document.getElementById('WednesdayTime2');
        const Wednesday2ActivityInput = document.getElementById('WednesdayActivity2');

        const Thursday1TimeInput = document.getElementById('ThursdayTime1');
        const Thursday1ActivityInput = document.getElementById('ThursdayActivity1');
        const Thursday2TimeInput = document.getElementById('ThursdayTime2');
        const Thursday2ActivityInput = document.getElementById('ThursdayActivity2');

        const Friday1TimeInput = document.getElementById('FridayTime1');
        const Friday1ActivityInput = document.getElementById('FridayActivity1');
        const Friday2TimeInput = document.getElementById('FridayTime2');
        const Friday2ActivityInput = document.getElementById('FridayActivity2');

        const Saturday1TimeInput = document.getElementById('SaturdayTime1');
        const Saturday1ActivityInput = document.getElementById('SaturdayActivity1');
        const Saturday2TimeInput = document.getElementById('SaturdayTime2');
        const Saturday2ActivityInput = document.getElementById('SaturdayActivity2');

        const Sunday1TimeInput = document.getElementById('SundayTime1');
        const Sunday1ActivityInput = document.getElementById('SundayActivity1');
        const Sunday2TimeInput = document.getElementById('SundayTime2');
        const Sunday2ActivityInput = document.getElementById('SundayActivity2');


        localStorage.setItem('MondayTime1', Monday1TimeInput.value);
        localStorage.setItem('MondayActivity1', Monday1ActivityInput.value);
        localStorage.setItem('MondayTime2', Monday2TimeInput.value);
        localStorage.setItem('MondayActivity2', Monday2ActivityInput.value);
        

        localStorage.setItem('TuesdayTime1', Tuesday1TimeInput.value);
        localStorage.setItem('TuesdayActivity1', Tuesday1ActivityInput.value);
        localStorage.setItem('TuesdayTime2', Tuesday2TimeInput.value);
        localStorage.setItem('TuesdayActivity2', Tuesday2ActivityInput.value);
        

        localStorage.setItem('WednesdayTime1', Wednesday1TimeInput.value);
        localStorage.setItem('WednesdayActivity1', Wednesday1ActivityInput.value);
        localStorage.setItem('WednesdayTime2', Wednesday2TimeInput.value);
        localStorage.setItem('WednesdayActivity2', Wednesday2ActivityInput.value);
        

        localStorage.setItem('ThursdayTime1', Thursday1TimeInput.value);
        localStorage.setItem('ThursdayActivity1', Thursday1ActivityInput.value);
        localStorage.setItem('ThursdayTime2', Thursday2TimeInput.value);
        localStorage.setItem('ThursdayActivity2', Thursday2ActivityInput.value);
        

        localStorage.setItem('FridayTime1', Friday1TimeInput.value);
        localStorage.setItem('FridayActivity1', Friday1ActivityInput.value);
        localStorage.setItem('FridayTime2', Friday2TimeInput.value);
        localStorage.setItem('FridayActivity2', Friday2ActivityInput.value);
        

        localStorage.setItem('SaturdayTime1', Saturday1TimeInput.value);
        localStorage.setItem('SaturdayActivity1', Saturday1ActivityInput.value);
        localStorage.setItem('SaturdayTime2', Saturday2TimeInput.value);
        localStorage.setItem('SaturdayActivity2', Saturday2ActivityInput.value);
        

        localStorage.setItem('SundayTime1', Sunday1TimeInput.value);
        localStorage.setItem('SundayActivity1', Sunday1ActivityInput.value);
        localStorage.setItem('SundayTime2', Sunday2TimeInput.value);
        localStorage.setItem('SundayActivity2', Sunday2ActivityInput.value);
        

    }

     // Load data on page load
    window.addEventListener('load', loadTimetable);

     // Save data when the "Save Changes" button is clicked
    const saveButton = document.getElementById('saveChanges');
    saveButton.addEventListener('click', saveChanges);

</script>

</body>
    <script type="text/javascript" src="../js/datatable/jquery-3.5.1.js"></script>
    <script src="../js/datatable/jquery.dataTables.min.js"></script>
    <script src="../js/datatable/dataTables.bootstrap.min.js"></script>

</html>

