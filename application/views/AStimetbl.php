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
<title>AS Timetable</title>
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
                        <h2 align="center" style="font-weight:bold">AS TIMETABLE</h2>
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
                            <td><input style="width: 400px" class="form-control" type="text" id="<?php echo $day ?>TimeS1" value=""></td>
                            <td>
                                <select required class="form-control"  id="<?php echo $day ?>ActivityS1">
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
                            <td><input style="width: 400px" class="form-control" type="text" id="<?php echo $day ?>TimeS2" value=""></td>
                            <td>
                                <select required class="form-control"  id="<?php echo $day ?>ActivityS2">
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

        const Monday1TimeSInput = document.getElementById('MondayTimeS1');
        const Monday1ActivitySInput = document.getElementById('MondayActivityS1');
        const Monday2TimeSInput = document.getElementById('MondayTimeS2');
        const Monday2ActivitySInput = document.getElementById('MondayActivityS2');

        const Tuesday1TimeSInput = document.getElementById('TuesdayTimeS1');
        const Tuesday1ActivitySInput = document.getElementById('TuesdayActivityS1');
        const Tuesday2TimeSInput = document.getElementById('TuesdayTimeS2');
        const Tuesday2ActivitySInput = document.getElementById('TuesdayActivityS2');

        const Wednesday1TimeSInput = document.getElementById('WednesdayTimeS1');
        const Wednesday1ActivitySInput = document.getElementById('WednesdayActivityS1');
        const Wednesday2TimeSInput = document.getElementById('WednesdayTimeS2');
        const Wednesday2ActivitySInput = document.getElementById('WednesdayActivityS2');

        const Thursday1TimeSInput = document.getElementById('ThursdayTimeS1');
        const Thursday1ActivitySInput = document.getElementById('ThursdayActivityS1');
        const Thursday2TimeSInput = document.getElementById('ThursdayTimeS2');
        const Thursday2ActivitySInput = document.getElementById('ThursdayActivityS2');

        const Friday1TimeSInput = document.getElementById('FridayTimeS1');
        const Friday1ActivitySInput = document.getElementById('FridayActivityS1');
        const Friday2TimeSInput = document.getElementById('FridayTimeS2');
        const Friday2ActivitySInput = document.getElementById('FridayActivityS2');

        const Saturday1TimeSInput = document.getElementById('SaturdayTimeS1');
        const Saturday1ActivitySInput = document.getElementById('SaturdayActivityS1');
        const Saturday2TimeSInput = document.getElementById('SaturdayTimeS2');
        const Saturday2ActivitySInput = document.getElementById('SaturdayActivityS2');

        const Sunday1TimeSInput = document.getElementById('SundayTimeS1');
        const Sunday1ActivitySInput = document.getElementById('SundayActivityS1');
        const Sunday2TimeSInput = document.getElementById('SundayTimeS2');
        const Sunday2ActivitySInput = document.getElementById('SundayActivityS2');


        Monday1TimeSInput.value = localStorage.getItem('MondayTimeS1') || '';
        Monday1ActivitySInput.value = localStorage.getItem('MondayActivityS1') || '';
        Monday2TimeSInput.value = localStorage.getItem('MondayTimeS2') || '';
        Monday2ActivitySInput.value = localStorage.getItem('MondayActivityS2') || '';

        Tuesday1TimeSInput.value = localStorage.getItem('TuesdayTimeS1') || '';
        Tuesday1ActivitySInput.value = localStorage.getItem('TuesdayActivityS1') || '';
        Tuesday2TimeSInput.value = localStorage.getItem('TuesdayTimeS2') || '';
        Tuesday2ActivitySInput.value = localStorage.getItem('TuesdayActivityS2') || '';

        Wednesday1TimeSInput.value = localStorage.getItem('WednesdayTimeS1') || '';
        Wednesday1ActivitySInput.value = localStorage.getItem('WednesdayActivityS1') || '';
        Wednesday2TimeSInput.value = localStorage.getItem('WednesdayTimeS2') || '';
        Wednesday2ActivitySInput.value = localStorage.getItem('WednesdayActivityS2') || '';

        Thursday1TimeSInput.value = localStorage.getItem('ThursdayTimeS1') || '';
        Thursday1ActivitySInput.value = localStorage.getItem('ThursdayActivityS1') || '';
        Thursday2TimeSInput.value = localStorage.getItem('ThursdayTimeS2') || '';
        Thursday2ActivitySInput.value = localStorage.getItem('ThursdayActivityS2') || '';

        Friday1TimeSInput.value = localStorage.getItem('FridayTimeS1') || '';
        Friday1ActivitySInput.value = localStorage.getItem('FridayActivityS1') || '';
        Friday2TimeSInput.value = localStorage.getItem('FridayTimeS2') || '';
        Friday2ActivitySInput.value = localStorage.getItem('FridayActivityS2') || '';

        Saturday1TimeSInput.value = localStorage.getItem('SaturdayTimeS1') || '';
        Saturday1ActivitySInput.value = localStorage.getItem('SaturdayActivityS1') || '';
        Saturday2TimeSInput.value = localStorage.getItem('SaturdayTimeS2') || '';
        Saturday2ActivitySInput.value = localStorage.getItem('SaturdayActivityS2') || '';

        Sunday1TimeSInput.value = localStorage.getItem('SundayTimeS1') || '';
        Sunday1ActivitySInput.value = localStorage.getItem('SundayActivityS1') || '';
        Sunday2TimeSInput.value = localStorage.getItem('SundayTimeS2') || '';
        Sunday2ActivitySInput.value = localStorage.getItem('SundayActivityS2') || '';

        
    }

    function saveChanges() {
        const Monday1TimeSInput = document.getElementById('MondayTimeS1');
        const Monday1ActivitySInput = document.getElementById('MondayActivityS1');
        const Monday2TimeSInput = document.getElementById('MondayTimeS2');
        const Monday2ActivitySInput = document.getElementById('MondayActivityS2');

        const Tuesday1TimeSInput = document.getElementById('TuesdayTimeS1');
        const Tuesday1ActivitySInput = document.getElementById('TuesdayActivityS1');
        const Tuesday2TimeSInput = document.getElementById('TuesdayTimeS2');
        const Tuesday2ActivitySInput = document.getElementById('TuesdayActivityS2');

        const Wednesday1TimeSInput = document.getElementById('WednesdayTimeS1');
        const Wednesday1ActivitySInput = document.getElementById('WednesdayActivityS1');
        const Wednesday2TimeSInput = document.getElementById('WednesdayTimeS2');
        const Wednesday2ActivitySInput = document.getElementById('WednesdayActivityS2');

        const Thursday1TimeSInput = document.getElementById('ThursdayTimeS1');
        const Thursday1ActivitySInput = document.getElementById('ThursdayActivityS1');
        const Thursday2TimeSInput = document.getElementById('ThursdayTimeS2');
        const Thursday2ActivitySInput = document.getElementById('ThursdayActivityS2');

        const Friday1TimeSInput = document.getElementById('FridayTimeS1');
        const Friday1ActivitySInput = document.getElementById('FridayActivityS1');
        const Friday2TimeSInput = document.getElementById('FridayTimeS2');
        const Friday2ActivitySInput = document.getElementById('FridayActivityS2');

        const Saturday1TimeSInput = document.getElementById('SaturdayTimeS1');
        const Saturday1ActivitySInput = document.getElementById('SaturdayActivityS1');
        const Saturday2TimeSInput = document.getElementById('SaturdayTimeS2');
        const Saturday2ActivitySInput = document.getElementById('SaturdayActivityS2');

        const Sunday1TimeSInput = document.getElementById('SundayTimeS1');
        const Sunday1ActivitySInput = document.getElementById('SundayActivityS1');
        const Sunday2TimeSInput = document.getElementById('SundayTimeS2');
        const Sunday2ActivitySInput = document.getElementById('SundayActivityS2');


        localStorage.setItem('MondayTimeS1', Monday1TimeSInput.value);
        localStorage.setItem('MondayActivityS1', Monday1ActivitySInput.value);
        localStorage.setItem('MondayTimeS2', Monday2TimeSInput.value);
        localStorage.setItem('MondayActivityS2', Monday2ActivitySInput.value);
        

        localStorage.setItem('TuesdayTimeS1', Tuesday1TimeSInput.value);
        localStorage.setItem('TuesdayActivityS1', Tuesday1ActivitySInput.value);
        localStorage.setItem('TuesdayTimeS2', Tuesday2TimeSInput.value);
        localStorage.setItem('TuesdayActivityS2', Tuesday2ActivitySInput.value);
        

        localStorage.setItem('WednesdayTimeS1', Wednesday1TimeSInput.value);
        localStorage.setItem('WednesdayActivityS1', Wednesday1ActivitySInput.value);
        localStorage.setItem('WednesdayTimeS2', Wednesday2TimeSInput.value);
        localStorage.setItem('WednesdayActivityS2', Wednesday2ActivitySInput.value);
        

        localStorage.setItem('ThursdayTimeS1', Thursday1TimeSInput.value);
        localStorage.setItem('ThursdayActivityS1', Thursday1ActivitySInput.value);
        localStorage.setItem('ThursdayTimeS2', Thursday2TimeSInput.value);
        localStorage.setItem('ThursdayActivityS2', Thursday2ActivitySInput.value);
        

        localStorage.setItem('FridayTimeS1', Friday1TimeSInput.value);
        localStorage.setItem('FridayActivityS1', Friday1ActivitySInput.value);
        localStorage.setItem('FridayTimeS2', Friday2TimeSInput.value);
        localStorage.setItem('FridayActivityS2', Friday2ActivitySInput.value);
        

        localStorage.setItem('SaturdayTimeS1', Saturday1TimeSInput.value);
        localStorage.setItem('SaturdayActivityS1', Saturday1ActivitySInput.value);
        localStorage.setItem('SaturdayTimeS2', Saturday2TimeSInput.value);
        localStorage.setItem('SaturdayActivityS2', Saturday2ActivitySInput.value);
        

        localStorage.setItem('SundayTimeS1', Sunday1TimeSInput.value);
        localStorage.setItem('SundayActivityS1', Sunday1ActivitySInput.value);
        localStorage.setItem('SundayTimeS2', Sunday2TimeSInput.value);
        localStorage.setItem('SundayActivityS2', Sunday2ActivitySInput.value);
        

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

