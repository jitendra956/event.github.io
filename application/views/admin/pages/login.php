<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Event Admin </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Solution Integration" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <!-- <link rel="shortcut icon" href="assets/images/fevicon.png"> -->

        <!-- C3 Chart css -->
        <link href="<?php echo base_url();?>assets/libs/c3.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/app.min.css" rel="stylesheet" type="text/css"  id="app-stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    </head>
<body style="background-color: #fff;">



<!-- Header Section-->
<section>
  <div class="container">
    <div class="login-form-div">
      <div class="col-md-5">
       <form id="admin_login" method="post">
        <h2>Login</h2>
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="show_error"></div>
            
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>
               
                
                         </div>
            
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-12 text-center">
                    <button type="submit" class="View-btn btn-block">Login</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</section>
</body>

<div class="ajax_modal" style="display: none; z-index: 7777777777777777;">
      <div class="center">
          <img alt="" src="<?php echo base_url();?>assets/loader.gif" />
      </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
  
        <script type="text/javascript">
            var BASE_URL = "<?php echo base_url(); ?>";
            $('#admin_login').validate({
    rules: {
            username: "required",
            password: "required"
            // email: {
            //     required: true,
            //     email: true
            // },
            // phone: {
            //     required: true,
            //     number: true,
            //     minlength: 9,
            //     maxlength: 9
            // }//,
            // message: {
            //  required: true,
            //  minlength:10
            // }
            
        },
      messages: {
            username: "Please enter your Username!",
            password: "Please enter your Password!",
            // name: "Escribe tu nombre",
            // surnames: "POR FAVOR INGRESE SUS APELLIDOS",
            // email: "Escribe un correo válido",
            // phone: {
            //     required: "Este número de teléfono no es válido",
            //     number: "Please enter only numeric value",
            //     minlength: "Your phone must be 9 characters long",
            //     maxlength: "Your phone must be 9 characters long"
            // }//,
            // message : 'Por favor, escribe tu mensaje'
            
          },
    submitHandler: function(a, e) {
      //a is form object and e is event
      // e.preventDefault(); // avoid submitting the form here
      var formData = $("#admin_login").serialize();
      $.ajax({
        url: BASE_URL+'admin/auth/is_valid_login',
        type: "POST",
        data: formData,
        dataType:'json',
        // crossDomain: true,
        // async: false,
        beforeSend: function () {
        $(".ajax_modal").show();
        },
        complete: function () {
            $(".ajax_modal").hide();
        },
        success: function(data) {
          if(data.status == 'true'){
            // $('#contact_form')[0].reset();
            // $(".show_success").show();
            // $(".show_success").html(data.message);
            window.location = BASE_URL+'dashboard';
          }
          else
          {
            // $('.show_error').show();
            $('.show_error').html(data.message);
          }
          
        },
        error: function(err) {
          console.log(err)
        }
      });
    }
  });
        </script>
</html>