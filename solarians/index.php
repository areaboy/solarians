<?php 
//error_reporting(0);
include('backend/settings.php');


// Check if Google Map Javascript API Key has been Set
if($google_map_keys == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Contact Admin to Set  Google Map Javascript API Key at
<b>(backend/settings.php)</b> File</div>";
exit();
}


//Check if OpenAI ChatGPT API Key has been Set
if($chatgpt_accesstoken == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Contact Admin to Set  OpenAi ChatGPT API Key at
<b>(backend/settings.php)</b> File</div>";
exit();
}


// Check if Google Gemini API Key has been Set
if($google_gimini_apikey == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Contact Admin to Set Google Gemin API Key at
<b>(backend/settings.php)</b> File</div>";
exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <title><?php echo $title; ?></title>
  <meta name="description" content="<?php echo $description; ?>" />

<link rel="stylesheet" href="css/index1cc.css">
<link rel="stylesheet" href="bootstraps/bootstrap.min.css">
<script src="jquery/jquery.min.js"></script>
<script src="bootstraps/bootstrap.min.js"></script>


  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      //overflow: hidden; /* Prevent scrollbars */
    }

    .container {
      position: relative;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .background-image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover; /* Ensures image covers entire viewport */
      z-index: -1; /* Place image behind content */
    }

    .content {
      text-align: center;
      color: white; /* White text for contrast */
    }

    h1 {
      font-size: 2rem;
      margin-bottom: 10px;
    }

    p {
      font-size: 1.2rem;
      margin-bottom: 20px;
    }

    .button {
      background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
      color: white;
      padding: 15px 30px;
      border: none;
      border-radius: 5px;
      font-size: 1.1rem;
      cursor: pointer;
    }

 .button2 {
      background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
      color: white;
      padding: 15px 30px;
      border: none;
      border-radius: 5px;
      font-size: 1.1rem;
      cursor: pointer;
    }

.button2:hover {
background: orange;
color:black;
}

    /* Navigation Menu */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black background */
      padding: 10px;
      z-index: 10; /* Place navigation on top */
      display: flex;
      align-items: center; /* Vertically align logo and menu */
    }

    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: flex-end; /* Align menu items to the right */
      align-items: center;
    }

    nav li {
      margin: 0 10px;
    }

    nav a {
      color: white;
      text-decoration: none;
    }

    nav a:hover {
      //text-decoration: underline;
background: orange;
color:black;
padding:10px;
border:none;
    }

    /* Logo Styling */
    .logo {
      max-width: 100px; /* Adjust max-width as needed */
      height: auto;
      margin-left: 20px; /* Adjust margin as needed */
    }

.upload_progress{
padding:10px;
background:green;
color:white;
cursor:pointer;
min-width:30px;
}

#imageupload_preview
{
max-height:200px;
max-width:200px;
}

.cat_css{
background-color:#B931B9;
padding: 10px;
color:white;
border-radius: 20%;
border: none;
cursor: pointer;

}
.cat_css:hover {
background: orange;
color:black;
}


.upload_progress2{
padding:10px;
background:green;
color:white;
cursor:pointer;
min-width:30px;
}

#imageupload_preview2
{
max-height:200px;
max-width:200px;
}

  </style>
</head>
<body>
  <nav>
    <img src="image/logo.png" alt="Your Logo" class="logo">
    <ul style='display:none;'>
      <li><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </nav>



<script>

// users signup starts

function imagePreview(e) 
{
 var readImage = new FileReader();
 readImage.onload = function()
 {
  var displayImage = document.getElementById('imageupload_preview');
  displayImage.src = readImage.result;
 }
 readImage.readAsDataURL(e.target.files[0]);
}


            $(function () {
                $('#save_btn').click(function () {
					
				
                    var email = $('#email_u').val();
                    var password = $('#password_u').val();
                    var confirm_password =$('#confirm-password_u').val();
                    var fullname = $('#fullname_u').val();
                    var file_fname = $('#file_content').val();
                    var country = $(".country1").val();
                    var address = $('#address_u').val();
                    //preparing Email for validations
                    var atemail = email.indexOf("@");
                    var dotemail = email.lastIndexOf(".");



if(password != confirm_password){
alert('Password Does not Match');
return false;
}

// start if validate
if(file_fname==""){
alert('please Select File to Upload');
}




else if(email==""){
alert('please Enter Email Address');
}

else  if (atemail < 1 || ( dotemail - atemail < 2 )){
alert("Please enter valid email Address")
}


else if(password==""){
alert('please Enter Password');
}


else if(fullname==""){
alert('please Enter Your Fullname');
}

else if(address==""){
alert('please Enter Your Full Location Address');
}


else if(country==""){
alert('please Reload or Refresh the Page and Try Again..');
}


else{

var fname=  $('#file_content').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a Valid image. Only Images Files are allowed");
return false;
    }


          var form_data = new FormData();
          form_data.append('file_content', $('#file_content')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('email', email);
          form_data.append('fullname', fullname);
          form_data.append('password', password);
          form_data.append('country', country);
          form_data.append('address', address);

                    $('.upload_progress').css('width', '0');
                    $('#btn').attr('disabled', 'disabled');
					$('#loaderx').hide();
                    $('#loader').fadeIn(400).html('<br><div class="well" style="color:black"><img src="loader.gif">&nbsp;Please Wait, Your Data is being  Submitted.</div>');
                    $.ajax({
                        url: 'backend/signup.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress').css('width', upload_percent + '%');
                                    $('.upload_progress').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader').hide();
				$('.result_data').fadeIn('slow').prepend(msg);
				$('#alerts_signup').delay(5000).fadeOut('slow');
                                $('#alerts_signupx').delay(5000).fadeOut('slow');
                              
//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_content').val('');
$('#email_u').val('');
$('#fullname_u').val('');
$('#password_u').val('');
$('#confirm-password_u').val('');
$('#address_u').val('');
$(".country1").val('');
}




                        }
                    });
} // end if validate




                });
            });

// user registration ends





//users login starts

$(document).ready(function(){
$('#login_btn_user').click(function () {

var email  = $('#email_user').val();
var password = $('#password_user').val();



 if(email==""){
alert('please Enter Email');
}

else if(password==""){
alert('please Enter Password');
}




else{


$("#loader-login_user").fadeIn(400).html('<br><div style="color:black;background:#ccc;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Your are being login as User...</div>');
var datasend = {email:email, password:password};


	
		$.ajax({
			
			type:'POST',
			url:'backend/login.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

$("#loader-login_user").hide();
$("#result-login_user").html(msg);
setTimeout(function(){ $("#result-login_user").html(''); }, 5000);

                        
//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (sucessful) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/sucessful/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#email_user').val('');		
$('#password_user').val('');	
}

	
}
			
		});
		
		}

});

});

//  users login ends




// company regitration  starts

function imagePreview2(e) 
{
 var readImage2 = new FileReader();
 readImage2.onload = function()
 {
  var displayImage2 = document.getElementById('imageupload_preview2');
  displayImage2.src = readImage2.result;
 }
 readImage2.readAsDataURL(e.target.files[0]);
}


            $(function () {
                $('#register_btn').click(function () {
					
				
                    var email = $('#company_email').val();
                    var company_name = $('#company_name').val();
                    var company_desc =$('#company_desc').val();
                    var address = $('#address').val();
                    var file_fname = $('#file_content2').val();
                    var country = $(".country2").val();

                    //preparing Email for validations
                    var atemail = email.indexOf("@");
                    var dotemail = email.lastIndexOf(".");



// start if validate
if(file_fname==""){
alert('please Select File logo to Upload');
}




else if(email==""){
alert('please Enter Email Address');
}

else  if (atemail < 1 || ( dotemail - atemail < 2 )){
alert("Please enter valid email Address")
}


else if(company_name==""){
alert('please Enter Company Name');
}


else if(company_desc==""){
alert('please Enter Your Company Description');
}



else if(address==""){
alert('please Enter Your Company Full Location Address');
}


else{

var fname=  $('#file_content2').val();
var ext = fname.split('.').pop();
//alert(ext);

// add double quotes around the variables
var fileExtention_quotes = ext;
fileExtention_quotes = "'"+fileExtention_quotes+"'";

 var allowedtypes = ["PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg"];
    if(allowedtypes.indexOf(ext) !== -1){
//alert('Good this is a valid Image');
}else{
alert("Please Upload a Valid image. Only Images Files are allowed");
return false;
    }


          var form_data = new FormData();
          form_data.append('file_content', $('#file_content2')[0].files[0]);
          form_data.append('file_fname', file_fname);
          form_data.append('email', email);
          form_data.append('company_name', company_name);
          form_data.append('company_desc', company_desc);
          form_data.append('address', address);
          form_data.append('country', country);

                    $('.upload_progress2').css('width', '0');
                    $('#btn').attr('disabled', 'disabled');
					$('#loaderx').hide();
                    $('#loader2').fadeIn(400).html('<br><div class="well" style="color:black"><img src="loader.gif">&nbsp;Please Wait, Your Company Data is being  Submitted.</div>');
                    $.ajax({
                        url: 'backend/solar_company_register.php',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        ache: false,
                        type: 'POST',
                        xhr: function () {
                      //var xhr = new window.XMLHttpRequest();
                            var xhr = $.ajaxSettings.xhr();
                            xhr.upload.addEventListener("progress", function (event) {
                                var upload_percent = 0;
                                var upload_position = event.loaded;
                                var upload_total  = event.total;

                                if (event.lengthComputable) {
                                    var upload_percent = upload_position / upload_total;
                                    upload_percent = parseInt(upload_percent * 100);
                                  //upload_percent = Math.ceil(upload_position / upload_total * 100);
                                    $('.upload_progress2').css('width', upload_percent + '%');
                                    $('.upload_progress2').text(upload_percent + '%');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function (msg) {
				$('#loader2').hide();
				$('.result_data2').fadeIn('slow').prepend(msg);
				$('#alerts_rego').delay(5000).fadeOut('slow');
                                $('#alerts_reg').delay(5000).fadeOut('slow');
                              
//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_content2').val('');
$('#company_email').val('');
$('#company_name').val('');
$('#company_desc').val('');
$('#address').val('');
$(".country2").val('');
}




                        }
                    });
} // end if validate




                });
            });


// company registration ends

</script>



  <div class="container">
    <img src="image/home.png" alt="Image Description" class="background-image">
    <div class="content">
      <h1 style='font-size:36px' class='button'><?php echo $title; ?></h1>
      <p style='font-size:20px' class='button'><?php echo $description; ?></p>


<p  class="col-sm-12">
<button  style='cursor:pointer;font-size:20px' class="button2" data-toggle="modal" data-target="#myModal_solar_company_registers"><b>Register Your Solar Company Data</b></button>
</p>

<p  class="row">

<center><span style='font-size:16px;color:pink'><b>Become a Solarians, Signup and Login Today</b></span></center>
<button style='cursor:pointer;font-size:20px' class="button2 col-sm-6" data-toggle="modal" data-target="#myModal_signup">Solarians/Users Signup</button>

<button style='cursor:pointer;font-size:20px' class="button2 col-sm-6" data-toggle="modal" data-target="#myModal_login">Solarians/Users Login</button>
</p>


    </div>
  </div>





<!-- Solar Companies Registration Modal starts -->



<div id="myModal_solar_company_registers" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header button"  style=''>
        <h4 class="modal-title">Solar Company Data Registration System</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">


<input type='hidden' class='country_selected2' value=''>
<div class="form-group">
<label style="">Select Company Photo Logo: </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content2" name="file_content2" accept="image/*" onchange="imagePreview2(event)" />
 <img id="imageupload_preview2"/>
</div><br>





 <div class="form-group">
              <label> Company Name: </label>
              <input type="text" class="col-sm-12 form-control" id="company_name" name="company_name" placeholder="Company Name.">
            </div>


 <div class="form-group">
              <label> Company Email: </label>
              <input type="text" class="col-sm-12 form-control" id="company_email" name="company_email" placeholder="Company Email.">
            </div>


 <div class="form-group">
              <label> Company Description: <span style='color:red'>(Max Length 200 Characters)</span></label>
              <textarea class="col-sm-12 form-control" id="company_desc" name="company_desc" placeholder="Company Description" maxlength="200"></textarea>
            </div>



 <div class="form-group">
              <label> Company Full Location Address followed by City Name, State Name, Country Name: <span style='color:red'>(Eg. Broadway 10012, New York, NY, USA)</span>

<span style='color:purple;font-size:12px;'>This Address will be converted into Google Geo Latitudes and Longitudes for Google Mapping...</span></label>
              <input type="text" class="col-sm-12 form-control" id="address" name="address" placeholder="Company Full Location Address">
            </div>

<div class="form-group">
              <label >Select Country</label>
 <select class="col-sm-12 form-control country2" id="country2" name="country2">
<option value="">--Select Country--</option>

<option value="United States">United States</option>
<option value="United Kingdom">United Kingdom</option>
<option value="Canada">Canada</option>
<option value="Mexico">Mexico</option>
<option value="Nigeria">Nigeria</option>
<option value="Ghana">Ghana</option>
<option value="Kenya">Kenya</option>
</select>
</div>



 <div class="form-group">
                            <div id="alerts_rego" class="upload_progress2" style="width:0%">0%</div>

                        <div id="loaderx2"></div>
						<div id="loader2"></div>
                        <div class="result_data2"></div>
                    </div>

                    <input type="button" id="register_btn" class="button2" value="Register Now" />


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="tn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- Solar Companies Registration Modal ends -->




<!-- Users signup Modal start -->



<div id="myModal_signup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header button"  style=''>
        <h4 class="modal-title">Users Signup System</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
Users Signup System....<br><br>


<div class="form-group">
<label style="">Select Profile Photo: </label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content" name="file_content" accept="image/*" onchange="imagePreview(event)" />
 <img id="imageupload_preview"/>
</div><br>


<input type='hidden' class='country_selected' value=''>



 <div class="form-group">
              <label> Fullname: </label>
              <input type="text" class="col-sm-12 form-control" id="fullname_u" name="fullname_u" placeholder="Fullname">
            </div>



 <div class="form-group">
              <label>Email: </label>
              <input type="text" class="col-sm-12 form-control" id="email_u" name="email_u"  placeholder="Email">
            </div>
 


 <div class="form-group">
              <label style="" for="psw">
<span class="fa fa-eye"></span> Password</label>
              <input type="password" class="col-sm-12 form-control" id="password_u" name="password_u" placeholder="Enter password">
            </div><br>

 <div class="form-group">
              <label style="" for="psw">
<span class="fa fa-eye"></span> Confirm Password</label>
              <input type="password" class="col-sm-12 form-control" id="confirm-password_u" name="confirm-password_u" placeholder=" Confirm Password">
            </div><br>


 <div class="form-group">
              <label>Your Location Address followed by City Name, State Name, Country Name: <span style='color:purple'>(Eg. 13th Avenue 35010, Alexander City, Alabama, United State )</span>
<span style='color:red;font-size:12px;'>This Address will be used for Google Directional Mapping... It will be kept Private. Only You can access your Address</span>
</label>
              <input type="text" class="col-sm-12 form-control" id="address_u" name="address_u" placeholder="Your Full Location Address">
            </div>

<div class="form-group">
              <label >Select Country</label>
 <select class="col-sm-12 form-control country1" id="country1" name="country1">
<option value="">--Select Country--</option>

<option value="United States">United States</option>
<option value="United Kingdom">United Kingdom</option>
<option value="Canada">Canada</option>
<option value="Mexico">Mexico</option>
<option value="Nigeria">Nigeria</option>
<option value="Ghana">Ghana</option>
<option value="Kenya">Kenya</option>
</select>
</div>



 <div class="form-group">
                            <div id='alerts_signupx'  class="upload_progress" style="width:0%">0%</div>

                        <div id="loaderx"></div>
						<div id="loader"></div>
                        <div class="result_data"></div>
                    </div>

                    <input type="button" id="save_btn" class="button2" value="Signup" />


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Users signup Modal ends -->



<!-- users login Modal start -->
<div class="modal fade" id="myModal_login">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header button" style=''>
        <h4 class="modal-title">Users Login System</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
 
Users Login System.....<br><br>

 <div class="form-group">
              <label>Email: </label>
              <input type="text" class="col-sm-12 form-control" id="email_user" name="email_user" value='test@gmail.com'>
            </div>
 
 <div class="form-group">
              <label>Password: </label>
              <input type="password" class="col-sm-12 form-control" id="password_user" name="password_user" value='123'>
            </div>

<br>
<div id="loader-login_user"></div>
<div id="result-login_user"></div>


                    <input type="button" id="login_btn_user" class="button2" value="Login Now" />



      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Users login Modal ends -->




</body>
</html>