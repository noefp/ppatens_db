

<!-- Modal -->
<div id="loginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <!-- <div class="modal-header"> -->
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <!-- <h4 class="modal-title">Login</h4> -->
      <!-- </div> -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <br>
        <!-- <form id="login_form" action="user_db/db_login.php" method="post"> -->
        <form id="login_form" method="post">
          <div class="form-group">
            <label for="email">Email address:</label>
            <input id="email_input" type="email" class="form-control" name="email">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input id="oth_input" type="password" class="form-control" name="password">
          </div>
          <!-- <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
          </div> -->
          <button type="submit" class="btn btn-default pull-right">Log In</button>
        </form>
        <p>
          Do not have an account? <a href="user_db/db_signup.php">Register here</a>
        </p>
      </div>
    </div>

  </div>
</div>

<!-- error Modal -->
<div id="errorModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center><h4 class="modal-title"><b>Login Messages</b></h4></center>
      </div>
      <div class="modal-body">
        <center>
          <h4 id="error_p"></h4>
        </center>
      </div>
    </div>

  </div>
</div>


<script>

  $(document).ready(function() {


    $.ajax({
       type: "POST",
       url: '/ppatens_db/user_db/db_login_status.php',
       success: function(msg)
       {
         msg = msg.replace(/\r\n|\n|\r/gm,"");
         // alert("msg: "+msg);
         if (msg == 0) {
           $('#logout_link').css('display','none');
           $('#login_link').css('display','block');
         }
         else {
           $('#login_link').css('display','none');
           $('#logout_link').css('display','block');
         }
       }
    });



    //log out
    // $('#logout_link').click(function () {
    //
    //   $('#login_li').html('<a style="font-size:16px; cursor:pointer" data-toggle="modal" data-target="#loginModal">Log In <span class="glyphicon glyphicon-log-in" style="line-height: 1.2"></span></a>')
    // });
    $(document.body).on('hide.bs.modal,hidden.bs.modal', function () {
        $('body').css('padding-right','0');
    });

    //log in
    $('#login_form').submit(function(e) {
      e.preventDefault();
      // var nn=$('#email_input').val();
      // var pp=$('#other_input').val();

      // alert("hello!");

      $.ajax({
         type: "POST",
         url: '/ppatens_db/user_db/db_login.php',
         data: $(this).serialize(),
         success: function(msg)
         {
           msg = msg.replace(/\r\n|\n|\r/gm,"");
           $('#loginModal').modal("hide");

             if (msg == "Logged in") {
             $('#login_link').css('display','none');
             $('#logout_link').css('display','block');
             // alert("in!");

             // $('#login_li').html('<a id="logout_link" style="font-size:16px; cursor:pointer">Log Out <span class="glyphicon glyphicon-log-out" style="line-height: 1.2;"></span></a>');
           }

           $("#error_p").html(msg);
           $("#errorModal").modal();

             // $('body').css('padding-right','0');

         }
       });

     });

     //log out
     $('#logout_link').click(function () {

       $.ajax({
          type: "POST",
          url: '/ppatens_db/user_db/db_logout.php',
          success: function(msg)
          {
            $('#logout_link').css('display','none');
            $('#login_link').css('display','block');

            $("#error_p").html(msg);
            $("#errorModal").modal();
          }
        });

      });


  });
</script>
