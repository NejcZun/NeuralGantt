$(document).ready(function(){

    $("#txt_uname").keyup(function(){
        var uname = $("#txt_uname").val().trim();
        if(uname != ''){
          // change from grey to correct hex value
          $("#uname_response_true").css("color", "grey");

          $.ajax({
              url: './vendors/functions/check_uname.php',
              type: 'post',
              data: {username : uname},
              success: function(response){
                  if(response > 0){
                    $("#uname_response_false").css("color","red");
                    $("#uname_response_false").show();
                    $("#uname_response_true").hide();
                  }else{
                    $("#uname_response_true").css("color", "green");
                    $("#uname_response_true").show();
                    $("#uname_response_false").hide();
                  }
              }
            })
        }
        else{
          // change from grey to correct hex value
          $("#uname_response_true").css("color", "#b6b6b6");
          $("#uname_response_false").hide();
          $("#uname_response_true").show();
        }
      });

      $("#txt_email").keyup(function(){
        var email = $("#txt_email").val().trim();
        var re = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
        if(re.test(email)){
          // change from grey to correct hex value
          $("#email_response_true").css("color", "grey");

          $.ajax({
              url: './vendors/functions/check_email.php',
              type: 'post',
              data: {email : email},
              success: function(response){
                  if(response > 0 ) {
                    $("#email_response_false").css("color","red");
                    $("#email_response_false").show();
                    $("#email_response_true").hide();
                  }else{
                    $("#email_response_true").css("color", "green");
                    $("#email_response_true").show();
                    $("#email_response_false").hide();
                  }
              }
            })
        }
        else{
          // change from grey to correct hex value
          $("#email_response_true").css("color", "#b6b6b6");
          $("#email_response_false").hide();
          $("#email_response_true").show();
        }
      });
      
      // one letter & one number & length => 5
      $("#txt_password").keyup(function(){
        var password = $("#txt_password").val().trim();
        var re = new RegExp(/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,}$/);
        if(password != ''){
            if(re.test(password)){
            // change from grey to correct hex value
            $("#password_response_true").css("color", "green");
            $("#password_response_false").hide();
            $("#password_response_true").show();
          }
          else{
            // change from grey to correct hex value
            $("#password_response_false").css("color", "red");
            $("#password_response_true").hide();
            $("#password_response_false").show();
          }
        }
        else{
          $("#password_response_true").css("color", "#b6b6b6");
          $("#password_response_false").hide();
          $("#password_response_true").show();
        }
      });

      $("#txt_confirm_password").keyup(function(){
        var password = $("#txt_password").val().trim();
        var confirm_pass = $("#txt_confirm_password").val().trim();
        if(confirm_pass != ''){
            if(password === confirm_pass){
            // change from grey to correct hex value
            $("#confirm_password_response_true").css("color", "green");
            $("#confirm_password_response_false").hide();
            $("#confirm_password_response_true").show();
          }
          else{
            // change from grey to correct hex value
            $("#confirm_password_response_false").css("color", "red");
            $("#confirm_password_response_true").hide();
            $("#confirm_password_response_false").show();
          }
        }
        else{
          $("#confirm_password_response_true").css("color", "#b6b6b6");
          $("#confirm_password_response_false").hide();
          $("#confirm_password_response_true").show();
        }
      });

  });