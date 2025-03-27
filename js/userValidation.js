$(document).ready(function(){


    $("form").submit(function(){

       var fname=  $("#fname").val();
       var lname=  $("#lname").val();
       var email=  $("#email").val();
       var dob=  $("#dob").val();
       var nic=   $("#nic").val();
       var cno=  $("#cno").val();
       var user_role=  $("#user_role").val();
        

        if(fname=="")
        {
                $("#alertmsg").addClass(" alert  alert-danger");
                $("#alertmsg").html("<h5>First Name must be filled!</h5>")
                return false;
        }
        if(lname=="")
        {
                $("#alertmsg").addClass(" alert  alert-danger");
                $("#alertmsg").html("<h5>Last Name must be filled!</h5>")
                return false;
        }
        if(email=="")
        {
                $("#alertmsg").addClass(" alert  alert-danger");
                $("#alertmsg").html("<h5>Email must be filled!</h5>")
                return false;
        }
        if(dob=="")
        {
                $("#alertmsg").addClass(" alert  alert-danger");
                $("#alertmsg").html("<h5> Date of Birth Must be Entered! </h5>")
                return false;
        }
        if(nic=="")
        {
                $("#alertmsg").addClass(" alert  alert-danger");
                $("#alertmsg").html("<h5>NIC must be Entered!</h5>")
                return false;
        }
        if(user_role=="")
        {
                $("#alertmsg").addClass(" alert  alert-danger");
                $("#alertmsg").html("<h5>User Role must Be Selected!!!</h5>")
                return false;
        }

        ///  regular expression validations

        var patnic=/^[0-9]{9}[vVxX]$/;
          var patcontact = /^\+94[0-9]{9}$/; 
          var patemail= /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;

          if(!nic.match(patnic))
          {
              $("#alertmsg").html("NIC is Invalid");
              $("#alertmsg").addClass("alert alert-danger");
            
              return false;
          }

          if(!cno.match(patcontact))
          {
              $("#alertmsg").html("Contact Number is Invalid");
              $("#alertmsg").addClass("alert alert-danger");
            
              return false;
          }

          if(!email.match(patemail))
          {
              $("#alertmsg").html("Invalid Email!!!");
              $("#alertmsg").addClass("alert alert-danger");
            
              return false;
          }




    });


})