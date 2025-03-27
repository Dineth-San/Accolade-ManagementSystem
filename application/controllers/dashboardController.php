<?php



    class DashboardController extends CI_Controller{

        public function __construct(){
            parent::__construct();

            //load form helper library
            $this->load->helper('form');

            //load form validation library
            $this->load->library('form_validation');

            //load session library
            $this->load->library('session');

            //load database
            $this->load->model('student_model');

        }
    
        public function index(){
            
        }

        public function student_details(){
            $this->load->view('student_details');
        }
        public function subject_details(){
            $this->load->view('subject_details');
        }
        public function teacher_staff_details(){
            $this->load->view('teacher_staff_details');
        }
        public function dashboard(){
            $this->load->view('dashboard');
        }
        public function teacher_details(){
            $this->load->view('teacher_details');
        }
        public function employee_details(){
            $this->load->view('employee_details');
        }
        public function change_student_details(){
            $this->load->view('change_student_details');
        }
        public function addStudent(){
            $this->load->view('add_students');
        }
        public function change_teacher_details(){
            $this->load->view('change_teacher_details');
        }
        public function addTeacher(){
            $this->load->view('add_Teachers');
        }
        public function change_employee_details(){
            $this->load->view('change_employee_details');
        }
        public function addEmployee(){
            $this->load->view('add_Employees');
        }
        public function RoleDet(){
            $this->load->view('role_details');
        }
        public function timetables(){
            $this->load->view('timetables');
        }
        public function AStimetbl(){
            $this->load->view('AStimetbl');
        }
        public function A2timetbl(){
            $this->load->view('A2timetbl');
        }
        public function ASreg(){
            $this->load->view('ASreg');
        }
        public function Register(){
            $this->load->view('Register');
        }
        public function student_fee(){
            $this->load->view('student_fee');
        }

    
        public function activate_deactivate_student(){
            if (isset($_GET["status"])) {
            $status = $_GET["status"];
            $studentObj = new Student_Model();


            switch($status){

                case "activate":

                    $student_id= ($_GET["student_id"]);

                    $studentObj->activateStu($student_id);

                    $this->load->view('change_student_details');

                    break;

                    

                case "deactivate":

                    $student_id= ($_GET["student_id"]);

                    $studentObj->deactivateStu($student_id);

                    $this->load->view('change_student_details');

                    break;
                }

            }
            
         
        }


        public function update_student_records(){

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $student_id = ($_POST["student_id"]);
                $name = ($_POST["name"]);
                $subject_1 = ($_POST["subject_1"]);
                $subject_2 = ($_POST["subject_2"]);
                $subject_3 = ($_POST["subject_3"]);
                $subject_4 = ($_POST["subject_4"]);
                $grade = ($_POST["grade"]);
                $email = ($_POST["email"]);
                $dob = ($_POST["dob"]);

                $patemail = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";


                if($subject_1==$subject_2 || $subject_1==$subject_3 || $subject_1==$subject_4 || $subject_2==$subject_3 || $subject_2==$subject_4 || $subject_3==$subject_4){
                    $data = array(
                        'error_message' => 'Subjects cannot be duplicated'
                        );
                        $this->load->view('change_student_details', $data);
                }

                else if($name == ""){
                    $data = array(
                        'error_message' => 'Enter Name'
                        );
                        $this->load->view('change_student_details', $data);
                }

                else if($subject_1 == "" || $subject_2 == "" || $subject_3 == "" || $subject_4 == ""){
                    $data = array(
                        'error_message' => 'Enter All Subjects'
                        );
                        $this->load->view('change_student_details', $data);
                }
                
                else if($grade == ""){
                    $data = array(
                        'error_message' => 'Enter Grade'
                        );
                        $this->load->view('change_student_details', $data);
                }

                else if($email == ""){
                    $data = array(
                        'error_message' => 'Enter Email'
                        );
                        $this->load->view('change_student_details', $data);
                }

                else if($dob == ""){
                    $data = array(
                        'error_message' => 'Enter DOB'
                        );
                        $this->load->view('change_student_details', $data);
                }

                else if(!preg_match($patemail,$email)){
                    $data = array(
                        'error_message' => 'Invalid Email Pattern'
                        );
                        $this->load->view('change_student_details', $data);
                }

                else{
                    $updateObj = new Student_Model();
                    $updateObj->UpdateStu($student_id, $name, $subject_1, $subject_2, $subject_3, $subject_4, $grade, $email, $dob);
                    $data = array(
                        'error_message' => 'Details Successfully Changed'
                        );
                    $this->load->view('change_student_details', $data);
                }
            }
        }

        public function delStu(){
            $student_id = $_GET["student_id"];
            $delObj = new Student_Model();
            $delObj->delStudent($student_id);
            $this->load->view('student_details');
        }

        public function addStu(){
            $name=$_POST["name"];
            $subject_1 = $_POST["subject_1"];
            $subject_2 = $_POST["subject_2"];
            $subject_3 = $_POST["subject_3"];
            $subject_4 = $_POST["subject_4"];
            $dob = $_POST["dob"];
            $grade = $_POST["grade"];
            $parent_email = $_POST["parent_email"];

            $patemail = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";

            if(!preg_match($patemail,$parent_email)){
                $data = array(
                    'error_message' => 'Invalid Email Pattern'
                    );
                    $this->load->view('add_students', $data);
            }
            else if($name == ""){
                $data = array(
                    'error_message' => 'Enter Name'
                    );
                    $this->load->view('add_students', $data);
            }
            else if($parent_email == ""){
                $data = array(
                    'error_message' => 'Enter Email'
                    );
                    $this->load->view('add_students', $data);
            }
            else if($grade == ""){
                $data = array(
                    'error_message' => 'Choose Grade'
                    );
                    $this->load->view('add_students', $data);
            }
            else if($subject_1 == "" || $subject_2 == "" || $subject_3 == "" || $subject_4 == ""){
                $data = array(
                    'error_message' => 'Choose 4 Subjects'
                    );
                    $this->load->view('add_students', $data);
            }
            else if($subject_1==$subject_2 || $subject_1==$subject_3 || $subject_1==$subject_4 || $subject_2==$subject_3 || $subject_2==$subject_4 || $subject_3==$subject_4){
                $data = array(
                    'error_message' => 'Subjects cannot be duplicated'
                    );
                    $this->load->view('add_students', $data);
            }
            else{

                $addObj = new Student_Model();
                $addObj->addStudent($name, $subject_1, $subject_2, $subject_3, $subject_4, $grade, $dob, $parent_email);

                $data = array(
                    'error_message' => 'Student Successfully Added'
                    );
                    $this->load->view('student_details', $data);
            }
        }

        public function update_teacher_details(){

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $teacher_id = ($_POST["teacher_id"]);
                $name = ($_POST["name"]);
                $email = ($_POST["email"]);
                $dob = ($_POST["dob"]);

                $patemail = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";

                if(!preg_match($patemail,$email)){
                    $data = array(
                        'error_message' => 'Invalid Email Pattern'
                        );
                        $this->load->view('change_teacher_details', $data);
                }

                else if($name == ""){
                    $data = array(
                        'error_message' => 'Enter Name'
                        );
                        $this->load->view('change_teacher_details', $data);
                }

                else if($email == ""){
                    $data = array(
                        'error_message' => 'Enter Email'
                        );
                        $this->load->view('change_teacher_details', $data);
                }

                else if($dob == ""){
                    $data = array(
                        'error_message' => 'Enter DOB'
                        );
                        $this->load->view('change_teacher_details', $data);
                }
                else{
                    $updateObj = new Student_Model();
                    $updateObj->updateTeacher($teacher_id, $name, $email, $dob);
                    $data = array(
                        'error_message' => 'Details Succesffully Changed'
                        );
                    $this->load->view('change_teacher_details');
                }
            }
        }

        public function delTeacher(){
            $teacher_id = $_GET["teacher_id"];
            $delObj = new Student_Model();
            $delObj->delTeacher($teacher_id);
            $this->load->view('teacher_details');
        }

        public function addTeach(){
            $name=$_POST["name"];
            $subject = $_POST["subject"];
            $dob = $_POST["dob"];
            $email = $_POST["email"];

            $patemail = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";

            if(!preg_match($patemail,$email)){
                $data = array(
                    'error_message' => 'Invalid Email Pattern'
                    );
                    $this->load->view('add_Teachers', $data);
            }
            else if($name == ""){
                $data = array(
                    'error_message' => 'Enter Name'
                    );
                    $this->load->view('add_Teachers', $data);
            }
            else if($email == ""){
                $data = array(
                    'error_message' => 'Enter Email'
                    );
                    $this->load->view('add_Teachers', $data);
            }
            else{

                $addObj = new Student_Model();
                $addObj->addTeach($name, $subject, $dob, $email);

                $data = array(
                    'error_message' => 'Student Successfully Added'
                    );
                    $this->load->view('teacher_details', $data);
            }
        }

        public function update_employee_details(){

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user_id = ($_POST["user_id"]);
                $fname = ($_POST["fname"]);
                $lname = ($_POST["lname"]);
                $email = ($_POST["email"]);
                $role = ($_POST["role"]);
                $dob = ($_POST["dob"]);
                $password = ($_POST["password"]);
                $confpassword = ($_POST["confpassword"]);

                $patemail = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
                $patpw = "/^.{8,}$/";

                if(!preg_match($patemail,$email)){
                    $data = array(
                        'error_message' => 'Invalid Email Pattern'
                        );
                        $this->load->view('change_employee_details', $data);
                }

                else if(!preg_match($patpw,$password)){
                    $data = array(
                        'error_message' => 'Invalid Password Pattern'
                        );
                        $this->load->view('change_employee_details', $data);
                }

                else if($password!==$confpassword){
                    $data = array(
                        'error_message' => 'Entered Passwords must be identical'
                        );
                        $this->load->view('change_employee_details', $data);
                }

                else if($fname == ""){
                    $data = array(
                        'error_message' => 'Enter First Name'
                        );
                        $this->load->view('change_employee_details', $data);
                } 
                
                else if($lname == ""){
                    $data = array(
                        'error_message' => 'Enter Last Name'
                        );
                        $this->load->view('change_employee_details', $data);
                }

                else if($email == ""){
                    $data = array(
                        'error_message' => 'Enter Email'
                        );
                        $this->load->view('change_employee_details', $data);
                }

                else if($dob == ""){
                    $data = array(
                        'error_message' => 'Enter DOB'
                        );
                        $this->load->view('change_employee_details', $data);
                }

                else if($role == ""){
                    $data = array(
                        'error_message' => 'Enter Role'
                        );
                        $this->load->view('change_employee_details', $data);
                }
                
                else if($password == ""){
                    $data = array(
                        'error_message' => 'Enter Password'
                        );
                        $this->load->view('change_employee_details', $data);
                }
                
                else if($confpassword == ""){
                    $data = array(
                        'error_message' => 'Confirm Password'
                        );
                        $this->load->view('change_employee_details', $data);
                }

                else{
                    $updateObj = new Student_Model();
                    $updateObj->updateEmployee($user_id, $fname, $lname, $email, $dob, $role, $password);
                    $data = array(
                        'error_message' => 'Details Succesffully Changed'
                        );
                    $this->load->view('change_employee_details', $data);
                }
            }
        }

        public function delEmployee(){
            $user_id = $_GET["user_id"];
            $delObj = new Student_Model();
            $delObj->delEmployee($user_id);
            $this->load->view('employee_details');
        }

        public function addEmp(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $fname = ($_POST["fname"]);
                $lname = ($_POST["lname"]);
                $email = ($_POST["email"]);
                $role = ($_POST["role"]);
                $dob = ($_POST["dob"]);
                $password = ($_POST["password"]);
                $confpassword = ($_POST["confpassword"]);

                $patemail = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
                $patpw = "/^.{8,}$/";

                if(!preg_match($patemail,$email)){
                    $data = array(
                        'error_message' => 'Invalid Email Pattern'
                        );
                        $this->load->view('add_Employees', $data);
                }

                else if(!preg_match($patpw,$password)){
                    $data = array(
                        'error_message' => 'Invalid Password Pattern'
                        );
                        $this->load->view('add_Employees', $data);
                }

                else if($password!==$confpassword){
                    $data = array(
                        'error_message' => 'Entered Passwords must be identical'
                        );
                        $this->load->view('add_Employees', $data);
                }

                else if($fname == ""){
                    $data = array(
                        'error_message' => 'Enter First Name'
                        );
                        $this->load->view('add_Employees', $data);
                } 
                
                else if($lname == ""){
                    $data = array(
                        'error_message' => 'Enter Last Name'
                        );
                        $this->load->view('add_Employees', $data);
                }

                else if($email == ""){
                    $data = array(
                        'error_message' => 'Enter Email'
                        );
                        $this->load->view('add_Employees', $data);
                }

                else if($dob == ""){
                    $data = array(
                        'error_message' => 'Enter DOB'
                        );
                        $this->load->view('add_Employees', $data);
                }

                else if($role == ""){
                    $data = array(
                        'error_message' => 'Enter Role'
                        );
                        $this->load->view('add_Employees', $data);
                }
                
                else if($password == ""){
                    $data = array(
                        'error_message' => 'Enter Password'
                        );
                        $this->load->view('add_Employees', $data);
                }
                
                else if($confpassword == ""){
                    $data = array(
                        'error_message' => 'Confirm Password'
                        );
                        $this->load->view('add_Employees', $data);
                }

                else{
                    $updateObj = new Student_Model();
                    $updateObj->addEmp($fname, $lname, $email, $dob, $role, $password);
                    $data = array(
                        'error_message' => 'Employee Succesffully Added'
                        );
                    $this->load->view('employee_details', $data);
                }
            }
        }
        
        public function update_roles(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $role_id = ($_POST["role_id"]);
                $name = ($_POST["name"]);
                $salary = ($_POST["salary"]);

                $salarypat = "/^[0-9]+\.[0-9]+$/";

                if(!preg_match($salarypat,$salary)){
                    $data = array(
                        'error_message' => 'Enter valid salary pattern'
                        );
                        $this->load->view('role_details', $data);
                }

                
                else if($name == ""){
                    $data = array(
                        'error_message' => 'Enter Role Name'
                        );
                        $this->load->view('role_details', $data);
                }
                
                else if($salary == ""){
                    $data = array(
                        'error_message' => 'Enter Salary'
                        );
                        $this->load->view('role_details', $data);
                }
                
                else{
                    $updateObj = new Student_Model();
                    $updateObj->updateRoles($role_id, $name, $salary);
                    $data = array(
                        'error_message' => 'Details Succesffully Changed'
                        );
                    $this->load->view('role_details', $data);
                }
            }
        }

        
    }
