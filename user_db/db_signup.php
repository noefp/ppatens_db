<!-- <?php //include_once $_SERVER['DOCUMENT_ROOT'].'/ppatens_db/ppdb_header.php'; ?> -->
<?php include_once '/ppatens_db/ppdb_header.php'; ?>

<div class="page_container">

  <br>

  <h2 class="text-center yellow_col">Create an account</h2>
  <br>

  <div class="well" style="width:900px; margin:auto; padding-bottom:45px">

    <form id="signup_form" method="post">
      <div class="form-group">
        <label for="first_name_input">First name</label> <span id="first_name_err" style="color:#f00"></span>
        <input id="first_name_input" class="form-control" name="first_name">
      </div>
      <div class="form-group">
        <label for="last_name_input">Last name</label> <span id="last_name_err"style="color:#f00"></span>
        <input id="last_name_input" class="form-control" name="last_name">
      </div>
      <div class="form-group">
        <label for="remail_input">Email address</label> <span id="remail_err" style="color:#f00"></span>
        <input id="remail_input" type="email" class="form-control" name="email">
      </div>
      <div class="form-group">
        <label for="uni_input">Institution</label> <span id="uni_err" style="color:#f00"></span>
        <input id="uni_input" class="form-control" name="university">
      </div>
      <div class="form-group">
        <label for="dep_input">Department</label> <span id="dep_err" style="color:#f00"></span>
        <input id="dep_input" class="form-control" name="department">
      </div>
      <div class="form-group">
        <label for="city_input">City</label> <span id="city_err" style="color:#f00"></span>
        <input id="city_input" class="form-control" name="city">
      </div>
      <div class="form-group">
        <label for="country_input">Country</label> <span id="country_err" style="color:#f00"></span>
        <input id="country_input" class="form-control" name="country">
      </div>
      <div class="form-group">
        <label for="roth_input">Password</label> <span id="roth_err" style="color:#f00"></span>
        <input id="roth_input" type="password" class="form-control" name="password">
      </div>
      <div class="form-group">
        <label for="roth_input2">Confirm password</label> <span id="roth_err2" style="color:#f00"></span>
        <input id="roth_input2" type="password" class="form-control" name="pwd2">
      </div>
      <button type="submit" class="btn btn-default pull-right">Sign up</button>
    </form>


  </div>

</div>

<br>
<br>
<br>

<?php include_once $_SERVER['DOCUMENT_ROOT'].'/ppatens_db/ppdb_footer.php'; ?>

<script>
  $(document).ready(function() {

    function checkName(input, input_val, err_id) {

      var re = /^[A-Z][A-Za-z\.\- ]*$/;
      var is_ok=re.test(input_val);

      if (is_ok) {
        input.removeClass("alert-danger").addClass("alert-success");
      }
      else {
        input.removeClass("alert-success").addClass("alert-danger");
      }

      if ( !input_val ) {
        $(err_id).html("This field cannot be empty!");
      }
      else if ( !/^[A-Z]/.test(input_val) ) {
        $(err_id).html("First letter should be uppercase!");
      }
      else if (/[0-9]/.test(input_val) ) {
        $(err_id).html("This field cannot contain numbers!");
      }
      else if (/[^A-Za-z0-9\.\- ]/.test(input_val) ) {
        $(err_id).html("Special characters are not allowed in this field!");
      }
      else {
        $(err_id).html("");
      }
    }

    function checkEmail(input, input_val, err_id) {

      var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      var is_ok=re.test(input_val);

      if (is_ok) {
        input.removeClass("alert-danger").addClass("alert-success");
      }
      else {
        input.removeClass("alert-success").addClass("alert-danger");
      }

      if ( !input_val ) {
        $(err_id).html("This field cannot be empty!");
      }
      else if ( !is_ok ) {
        $(err_id).html("This email format is not valid!");
      }
      else {
        $(err_id).html("");
      }
    }

    function checkPwd(input, input_val, err_id) {

      if (input_val.length >= 8) {
        input.removeClass("alert-danger").addClass("alert-success");
      }
      else {
        input.removeClass("alert-success").addClass("alert-danger");
      }

      if ( !input_val ) {
        $(err_id).html("This field cannot be empty!");
      }
      else if ( input_val.length < 8 ) {
        $(err_id).html("The password must have 8 characters or more!");
      }
      else {
        $(err_id).html("");
      }
    }

    function confirmPwd(input, input2, input_val, input_val2, err_id) {

      if (input_val == input_val2 && input2.hasClass("alert-success")) {
        input.removeClass("alert-danger").addClass("alert-success");
      }
      else {
        input.removeClass("alert-success").addClass("alert-danger");
      }

      if ( !input_val ) {
        $(err_id).html("This field cannot be empty!");
      }
      else if ( input_val != input_val2 ) {
        $(err_id).html("Your password does not match!");
      }
      else {
        $(err_id).html("");
      }
    }


    $("#first_name_input").focusout(function () {
      checkName( $(this), $(this).val(), "#first_name_err" );
    });

    $("#last_name_input").focusout(function () {
      checkName( $(this), $(this).val(), "#last_name_err" );
    });

    $("#uni_input").focusout(function () {
      checkName( $(this), $(this).val(), "#uni_err" );
    });

    $("#dep_input").focusout(function () {
      checkName( $(this), $(this).val(), "#dep_err" );
    });

    $("#city_input").focusout(function () {
      checkName( $(this), $(this).val(), "#city_err" );
    });

    $("#country_input").focusout(function () {
      checkName( $(this), $(this).val(), "#country_err" );
    });

    $("#remail_input").focusout(function () {
      checkEmail( $(this), $(this).val(), "#remail_err" );
    });

    $("#roth_input").focusout(function () {
      checkPwd( $(this), $(this).val(), "#roth_err" );
    });

    $("#roth_input2").focusout(function () {
      confirmPwd( $(this), $("#roth_input"), $(this).val(), $("#roth_input").val(), "#roth_err2" );
    });

    //sign up
    $('#signup_form').submit(function(e) {
      e.preventDefault();
      // var nn=$('#email_input').val();
      // var pp=$('#other_input').val();

      // alert("hello!");
        if ( $("#first_name_input").hasClass("alert-success") && $("#last_name_input").hasClass("alert-success") && $("#uni_input").hasClass("alert-success") && $("#dep_input").hasClass("alert-success") && $("#city_input").hasClass("alert-success") && $("#country_input").hasClass("alert-success") && $("#remail_input").hasClass("alert-success") && $("#roth_input").hasClass("alert-success") && $("#roth_input2").hasClass("alert-success") ) {

          $.ajax({
             type: "POST",
             url: '/ppatens_db/user_db/db_signup_controller.php',
             data: $(this).serialize(),
             success: function(msg)
             {
               $("#error_p").html(msg);
               $("#errorModal").modal();
             }
           });
        }
        else {
          $("#error_p").html("Please fill all the fields from the form");
          $("#errorModal").modal();
        }
     });

  });
</script>
