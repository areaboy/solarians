<?php
error_reporting(0); 
?>



<?php
session_start();
include ('backend/session_authenticate.php');
include ('backend/settings.php');

$userid_sess =  htmlentities(htmlentities($_SESSION['uid_s'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname_s'], ENT_QUOTES, "UTF-8"));
$country_sess =   htmlentities(htmlentities($_SESSION['country_s'], ENT_QUOTES, "UTF-8"));
$country_nickname_sess =   htmlentities(htmlentities($_SESSION['country_nickname_s'], ENT_QUOTES, "UTF-8"));
$photo_sess =  htmlentities(htmlentities($_SESSION['photo_s'], ENT_QUOTES, "UTF-8"));
$address_sess =  htmlentities(htmlentities($_SESSION['address_s'], ENT_QUOTES, "UTF-8"));
$lat_sess = htmlentities(htmlentities($_SESSION['lat_s'], ENT_QUOTES, "UTF-8"));
$lng_sess = htmlentities(htmlentities($_SESSION['lng_s'], ENT_QUOTES, "UTF-8"));
$map_zoom_sess = htmlentities(htmlentities($_SESSION['map_zoom_s'], ENT_QUOTES, "UTF-8"));

$post_title = strip_tags($_GET['title']);
$notify_id = strip_tags($_GET['notifyId']);

if($post_title ==''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Direct Dashboard Page Access not Allowed...</div>";
exit();
}

if($notify_id  ==''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Direct Dashboard Page Access not Allowed...</div>";
exit();
}


// Ensure that only Alpha numeric Character are passed to prevent remote file inclusion Attack....
$post_title_vaidate = preg_replace("/[^a-zA-Z0-9]+/", "", $post_title);
$notify_id_vaidate = preg_replace("/[^a-zA-Z0-9]+/", "", $notify_id);




// update table notification with Unread for read Updates starts
include('backend/db_connection.php');


$update= $db->prepare('UPDATE notification_solar set status =:status where id =:id');
$update->execute(array( 
':id' => $notify_id_vaidate,
':status' => 'read' 
));

?>




<!DOCTYPE html>
<html lang="en">

<head>
 <title><?php echo $title; $titlex = $title; ?> - Welcome <?php echo $fullname_sess; ?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="<?php echo $description; ?>" />

<link rel="stylesheet" href="css/index_dashboard1.css">
<link rel="stylesheet" href="bootstraps/bootstrap.min.css">
<script src="jquery/jquery.min.js"></script>
<script src="bootstraps/bootstrap.min.js"></script>
<script src="javascript/moment.js"></script>
<script src="javascript/livestamp.js"></script>
 <script src="markdown/marked.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
<script>

// stopt all bootstrap drop down menu from closing on click inside
$(document).on('click', '.dropdown-menu', function (e) {
  e.stopPropagation();
});

</script>






<!-- start column nav-->


<div class="text-center">
<nav class="navbar navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navgator">
        <span class="navbar-header-collapse-color icon-bar"></span>
        <span class="navbar-header-collapse-color icon-bar"></span>
        <span class="navbar-header-collapse-color icon-bar"></span> 
        <span class="navbar-header-collapse-color icon-bar"></span>                       
      </button>
     
<li class="navbar-brand home_click imagelogo_li_remove" ><img title='<?php  echo $titlex; ?>-logo' alt='<?php  echo $titlex; ?>-logo' class="img-rounded imagelogo_data" src="image/logo.png"></li>
    </div>
    <div class="collapse navbar-collapse" id="navgator">


      <ul class="nav navbar-nav navbar-right">




<!--start post comments notification-->

<script>

$(document).ready(function(){

var userid_sess_data = '<?php echo $userid_sess; ?>';
$("#loader-notify_alert_posts").fadeIn(400).html('<br><div style="color:black;background:white;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i></div>');
var datasend = {userid_sess_data:userid_sess_data};

//alert(userid_sess_data);
	
		$.ajax({
			
			type:'POST',
			url:'backend/notify_alert.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

//alert(msg);

$("#loader-notify_alert_posts").hide();
$("#result-notify_alert_posts").html(msg);
//setTimeout(function(){ $('#result-notify_alert_posts').html(''); }, 5000);	


			
	
}
			
		});
		
		

});


</script>


<li>
<span style='color:white;' class="dropdown fa fa-bell">
  <a style="color:white;font-size:14px;cursor:pointer;" title='Real-Time Notification System' class="btn1 btn-default1 dropdown-toggle"  data-toggle="dropdown">
  <span class="notify_count"><span id="loader-notify_alert_posts"></span><span id="result-notify_alert_posts"></span></span>
</a>

<ul class="dropdown-menu" style='width:350px;height: 400px;overflow-y : scroll;'>
<h4 style='color:blue;'>Real-Time Notification System</h4>
<button class="btn btn-primary" id="refresh_notify" title="Refresh Notification">Refresh Notification</button>
<br>


<script>

$(document).ready(function(){


var userid_sess_data = '<?php echo $userid_sess; ?>';
var username_sess_data = '<?php echo $userid_sess; ?>';

var sender_id=userid_sess_data;
var sender_username=username_sess_data;


if(sender_id ==''){
alert('something is wrong with Senders Id');
}


else{


$("#loader-load-notify-post").fadeIn(400).html('<br><div style="color:white;background:#ec5574;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i>&nbsp;Please Wait,Loading Your Notification Alerts...</div>');
var datasend = {sender_id:sender_id, sender_username:sender_username};


	
		$.ajax({
			
			type:'POST',
			url:'backend/notification_load.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

$("#loader-load-notify-post").hide();
$("#result-load-notify-post").html(msg);
//setTimeout(function(){ $('#result-load-notify-post(''); }, 5000);				

//location.reload();	
}
			
		});
		
		}


});










$(document).ready(function(){

  $('#refresh_notify').click(function () {
var userid_sess_data = '<?php echo $userid_sess; ?>';
var username_sess_data = '<?php echo $userid_sess; ?>';

var sender_id=userid_sess_data;
var sender_username=username_sess_data;


if(sender_id ==''){
alert('something is wrong with Senders Id');
}


else{


$("#loader-load-notify-post").fadeIn(400).html('<br><div style="color:white;background:#ec5574;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i>&nbsp;Please Wait,Loading Your Notification Alerts...</div>');
var datasend = {sender_id:sender_id, sender_username:sender_username};


	
		$.ajax({
			
			type:'POST',
			url:'backend/notification_load.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

$("#loader-load-notify-post").hide();
$("#result-load-notify-post").html(msg);
//setTimeout(function(){ $('#result-load-notify-post(''); }, 5000);				

//location.reload();	
}
			
		});
		
		}





// start notify 1


var userid_sess_data = '<?php echo $userid_sess; ?>';
$("#loader-notify_alert_posts").fadeIn(400).html('<br><div style="color:black;background:white;padding:10px;"><i class="fa fa-spinner fa-spin" style="font-size:20px"></i></div>');
var datasend = {userid_sess_data:userid_sess_data};

//alert(userid_sess_data);
	
		$.ajax({
			
			type:'POST',
			url:'backend/notify_alert.php',
			data:datasend,
                        crossDomain: true,
			cache:false,
			success:function(msg){

//alert(msg);

$("#loader-notify_alert_posts").hide();
$("#result-notify_alert_posts").html(msg);
//setTimeout(function(){ $('#result-notify_alert_posts').html(''); }, 5000);	


			
	
}
			
		});
		


// end notify 1


});


});


</script>



<!-- form START-->
<div id="loader-load-notify-post"></div>
<div id="result-load-notify-post"></div>


<!--form ENDS-->

<p></p>

</ul></span>
&nbsp;&nbsp;
</li>


<!--end post comments notifications-->




 <li style='display:none;' class="navgate_no"><a title='Add New Solar Updates' data-toggle='modal' data-target='#myModal_solar' style="color:white;font-size:14px;">
<button class="category_post1">Add New <br>Solar Updates</button></a></li>




 <li style='display:none;' class="navgate_no"><a title='Solar Installation Companies Mapping' href="map_companies.php" style="color:white;font-size:14px;">
<button class="category_post1">Solar Installation<br> Companies Map</button></a></li>



 <li style='display:none;' class="navgate_no"><a title='Solar Chatbot AI' data-toggle='modal' data-target='#myModal_chatbot' style="color:white;font-size:14px;">
<button class="category_post1">Solar <br>Chatbot AI</button></a></li>


 <li class="navgate_no"><a title='Go Back to Dashboard' href="dashboard.php" style="color:white;font-size:14px;">
<button class="category_post1">Go Back to Dashboard</button></a></li>

 <li style='display:none;' class="navgate_no"><a title='My Profile' href="my_profile.php" style="color:white;font-size:14px;">
<button class="category_post1">My Profile</button></a></li>


 <li style='display:none;'class="navgate_no"><a title='Logout' href="logout.php" style="color:white;font-size:14px;">
<button class="category_post1">Logout</button></a></li>


             
<li class="navgate"><img style="max-height:40px;max-width:40px;" class="img-circle" width="40px" height="40px"
 src="backend/user_photos/<?php echo $photo_sess; ?>" >



<span class="dropdown">
  <a style="color:white;font-size:14px;cursor:pointer;" title='View More Data' class="btn1 btn-default1 dropdown-toggle"  data-toggle="dropdown">
<br><?php echo $fullname_sess; ?>
  <span class="caret"></span>(More)</a>

<ul class="dropdown-menu col-sm-12">
<li><a title='My Profile' href="my_profile.php">My Profile</a></li>
<li><a title='Logout' href="logout.php">Logout</a></li>

</ul></span>

</li>



      </ul>




    </div>
  </div>



</nav>


    </div><br /><br />

<!-- end column nav-->





<div class='row'>
<br><br><br>


<center><h4>Welcome 
<b style='color:purple'> <?php echo $fullname_sess; ?></b>  to
 <b style='color:purple'><?php echo $title; ?></b> -- Connectng all <b style='color:purple'>Solarians </b> and sharing informations together..</h4></center><br>



<!--Start Left-->
<div class='col-sm-3 well'>

<style>

</style>

<h4>List of NearBy <b style='color:purple'><?php echo $country_nickname_sess; ?></b> Solar Installation Companies</h4>
<script>

$(document).ready(function(){

 $(".email_send_btnx").click(function(){

//window.open('mailto:test@gmail.com?subject=subject&body=body');
var user_email = $(this).data('c_email');
if(confirm('This Email will be sent via your Browser Clients. Please Ensure that your Browser allows Opening a Popup Window')){
window.open("mailto:"+user_email);
}
});
});

</script>

<?php
include('backend/db_connection.php');
$result = $db->prepare('SELECT * FROM company_solar WHERE country=:country order by id desc');
$result->execute(array(':country'=>$country_sess));
$nosofrows = $result->rowCount();
if($nosofrows  == 0){
echo "<div style='background:red;color:white;padding:10px;border:none'>No Solar Installation  Company Registered for <b>$country_sess</b> Yet....</div>";
}

while($rowv = $result->fetch()){
$id = $rowv['id'];
$company_name = $rowv['company_name'];
$company_desc = $rowv['company_desc'];
$email = $rowv['email'];
$address = $rowv['address'];
$lat = $rowv['lat'];
$lng = $rowv['lng'];
$photo = $rowv['photo'];
$country = $rowv['country'];
?>
    





<div style='background:#ccc;color:black;border-radius:15%;padding:6px; border:none;' class='cat_cssx col-sm-12'>

<b>Company Name:</b>  <?php echo $company_name; ?><br>
<b>Company Address:</b>  <?php echo $address; ?><br>

<button data-c_email='<?php echo $email; ?>' class='email_send_btnx btn btn-primary btn-xs pull-right' title='Send Email'>Send Email</button><br>


<div class='col-sm-6'>
<button class='map_call_btn btn_map_locations btn btn-success btn-xs' data-country='<?php echo $country; ?>' data-company_name='<?php echo $company_name; ?>' data-company_address='<?php echo $address; ?>' data-id='<?php echo $id; ?>' data-lat='<?php echo $lat; ?>' data-lng='<?php echo $lng; ?>' title='Map Geo-Location' data-toggle='modal' data-target='#myModal_maploc'>Map Geo-Location</button></div>

<div class='col-sm-6'>
<button class='btn_map_refresh map_call_btn btn_map_locations btn btn-warning btn-xs' data-country='<?php echo $country; ?>' data-company_name='<?php echo $company_name; ?>' data-company_address='<?php echo $address; ?>'  data-id='<?php echo $id; ?>' data-lat='<?php echo $lat; ?>' data-lng='<?php echo $lng; ?>' title='Map Direction' data-toggle='modal' data-target='#myModal_mapdir'>Map Direction</button></div>


</div>


<br>
<?php
}

?>


</div>

<!--End Left-->










<!--Start Center-->
<div class='col-sm-9'>


  <script>
        
        $(document).ready(function(){
            
            //$(window).scroll(function(){
 $('#loadmore_btn').click(function () {

                
                //var position = $(window).scrollTop();
                //var bottom = $(document).height() - $(window).height();



             // if( position == bottom ){


                    var row_limit = Number($('#row_limit').val());
                    var total_count = Number($('#total_count').val());
		    var querytotal  = total_count;
                    var rowpage = 2;
                    row_limit = row_limit + rowpage;

					
					 if(row_limit >= querytotal){
               
                   alert('No More Content to Load');
$("#nomore_content_check").html("<div style='background:purple;color:white;padding:10px;bottom:0'>No More Content to Load <br> <center><button style='background:#3b5998;border:none;color:white;padding:10px;cursor:pointer' title='Refresh Page' class='reloadData'>Refresh Page</button></center> </div>");   
$('#loader_posts').hide();
                }

                    if(row_limit <= querytotal){
                        $('#row_limit').val(row_limit);
$("#loader_posts").fadeIn(400).html('<br><div style="color:black;background:white;padding:10px;"><img src="loader.gif"> Please Wait. Loading Content</div>');

                        $.ajax({
                            url: 'backend/posts_paginate.php',
                            type: 'post',
                            data: {row_limit:row_limit},
                            success: function(response){
                                $(".post:last").after(response).show().fadeIn("slow");
$('#loader_posts').hide();
                            }
                        });
                    }
                //}

            });
        
        });





// Get Data for Comment
$(document).ready(function(){
$('.comment_btns').click(function(){



var postid = $(this).data('postid');
var title = $(this).data('title');
$('.postid_p').html(postid);
$('.title_p').html(title);
//$('.title_value').val(title).value;
var post_id = postid;


var comment_count = $(this).data('comment_countx');
//$("#comment_totalx_"+postid).html(comment_count);
$("#comment_totalx").html(comment_count);

if(post_id == ''){
alert('Post Id cannot be empty');
return false;
}
$("#loader-comment").fadeIn(400).html('<span style="color:;background:;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Loading Comments.</span>');
        $.ajax({
            url: 'backend/comment_loading.php',
            type: 'post',
            data: {post_id:post_id},
            dataType: 'html',
            success: function(data){
$("#result_comment").html(data);
$("#loader-comment").hide();

            }
        });

});
});





// Get Data for Comment for Post Pagination
$(document).ready(function(){
//$('.comment_btns2').click(function(){
$(document).on( 'click', '.comment_btns2', function(){ 


var postid = $(this).data('postid');
var title = $(this).data('title');
$('.postid_p').html(postid);
$('.title_p').html(title);
//$('.title_value').val(title).value;
var post_id = postid;


var comment_count = $(this).data('comment_countx');
//$("#comment_totalx_"+postid).html(comment_count);
$("#comment_totalx").html(comment_count);

if(post_id == ''){
alert('Post Id cannot be empty');
return false;
}
$("#loader-comment").fadeIn(400).html('<span style="color:;background:;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Loading Comments.</span>');
        $.ajax({
            url: 'backend/comment_loading.php',
            type: 'post',
            data: {post_id:post_id},
            dataType: 'html',
            success: function(data){
$("#result_comment").html(data);
$("#loader-comment").hide();

            }
        });

});
});




// post comments


$(document).ready(function(){
$(document).on( 'click', '.comment_send_btn', function(){ 
 //$("."comment_send_btn").click(function(){
var postid = $(this).data('postid');
var id = this.id; 
var comdesc = $('#comdesc').val();

if(comdesc == ''){
alert('comment cannot be empty');
return false;
}
        // AJAX Request


$("#loader_comments_send").fadeIn(400).html('<br><div style="color:;background:;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Sending Comments.</div>');

        $.ajax({
            url: 'backend/comment.php',
            type: 'post',
            data: {postid:postid,comdesc:comdesc},
            dataType: 'json',
            success: function(data){

                var comment = data['comment'];
                var comdesc = data['comdesc'];
                var comment_username = data['comment_username'];
                 var comment_fullname = data['comment_fullname'];
 var comment_photo = data['comment_photo'];
 var comment_time = data['comment_time'];
//$("#comment_total").text(comment);
$("#comment_total_"+postid).text(comment);

$("#comment_totalx").html(comment);

var com_counting =comment;
if(com_counting > 0){
$("#no_comment_hide").hide();
}

  var comment_json = "<div class='comment_css' style=''>" +
                   
 "<img style='border-style: solid; border-width:3px; border-color:#ec5574; width:40px;height:40px; max-width:40px;max-height:40px;border-radius: 50%;' src='backend/user_photos/" + comment_photo +" '/><br>" +
      "<span style='font-size:14px;text-align:left;color:#ec5574;'><b>Name</b>: " + comment_fullname + "</span><br>" +              
                    "<b style='font-size:12px;text-align:left;'>Comment: </b>" + comdesc + "<br>" +
"<span style='color:#800000'><b> <span class='fa fa-calendar'></span>Time:</b> <span data-livestamp='" + comment_time + "'></span></span>"+
                    "</div>";
$("#result_comments_send").append(comment_json)
alert('Comment Added Successfully');

$('#comdesc').val('');

$("#loader_comments_send").hide();

            }
        });

    });

});







$(document).ready(function(){

 //$(".plike_btns").click(function(){
$(document).on( 'click', '.plike_btns', function(){ 

 var post_id = this.id; 
var id = post_id;
var title = $(this).data('title');

if(id == ''){
alert('Post Id cannot be empty');
return false;
}
        // AJAX Request


$("#loader-plike_"+id).fadeIn(400).html('<span style="color:;background:;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Sending your Likes.</span>');

        $.ajax({
            url: 'backend/post_like.php',
            type: 'post',
            data: {post_id:post_id, title:title},
            dataType: 'json',
            success: function(data){

var msg = data['msg'];
if(msg=='failed'){
alert('You Already Like This Posts');
$("#loader-plike_"+id).hide();
}
if(msg=='success'){
                var like = data['like'];       
$("#plike_total_"+id).text(like);
alert('Like Sent Successfully');
$("#loader-plike_"+id).hide();
}

            }
        });
    });
});

// post like ends



</script>






        <div class="content">

            <?php


            $rowpage = 1;
            $limit = 0;

$res= $db->prepare("SELECT count(*) as totalcount FROM posts_solar WHERE title_seo=:title_seo");
$res->execute(array(':title_seo' =>$post_title_vaidate));
$t_row = $res->fetch();
$totalcount = $t_row['totalcount'];

if($totalcount == 0){
echo "<div style='background:red;color:white;padding:10px;border:none;'>No Post Found.</div>";
//exit();
}


$result = $db->prepare("SELECT * FROM posts_solar WHERE title_seo=:title_seo order by id desc limit :row1, :rowpage");
$result->bindValue(':rowpage', (int) trim($rowpage), PDO::PARAM_INT);
$result->bindValue(':row1', (int) trim($limit), PDO::PARAM_INT);
$result->bindValue(':title_seo', trim($post_title_vaidate), PDO::PARAM_STR);
//$result->bindValue(':uid', trim($projectid), PDO::PARAM_INT);
$result->execute();

$count_post = $result->rowCount();

while($row = $result->fetch()){


$id = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$postid = $id;
$title = htmlentities(htmlentities($row['title'], ENT_QUOTES, "UTF-8"));
$title_seo = htmlentities(htmlentities($row['title_seo'], ENT_QUOTES, "UTF-8"));
$content = htmlentities(htmlentities($row['content'], ENT_QUOTES, "UTF-8"));
$fullname = htmlentities(htmlentities($row['fullname'], ENT_QUOTES, "UTF-8"));
$userphoto = htmlentities(htmlentities($row['userphoto'], ENT_QUOTES, "UTF-8"));
$timer1 = htmlentities(htmlentities($row['timer'], ENT_QUOTES, "UTF-8"));
$post_userid = htmlentities(htmlentities($row['userid'], ENT_QUOTES, "UTF-8"));
$image = htmlentities(htmlentities($row['image'], ENT_QUOTES, "UTF-8"));
$microcontent = substr($content, 0, 120)."...";
$microtitle = substr($title, 0, 80)."..";
$points = htmlentities(htmlentities($row['points'], ENT_QUOTES, "UTF-8"));
$total_comment = htmlentities(htmlentities($row['total_comments'], ENT_QUOTES, "UTF-8"));
$t_like = htmlentities(htmlentities($row['total_like'], ENT_QUOTES, "UTF-8"));
$ai_model = htmlentities(htmlentities($row['ai_model'], ENT_QUOTES, "UTF-8"));
$country_nickname = htmlentities(htmlentities($row['country_nickname'], ENT_QUOTES, "UTF-8"));
$country_name = htmlentities(htmlentities($row['country_name'], ENT_QUOTES, "UTF-8"));

$solar_inverter_capacity = htmlentities(htmlentities($row['solar_inverter_capacity'], ENT_QUOTES, "UTF-8"));
$battery_type = htmlentities(htmlentities($row['battery_type'], ENT_QUOTES, "UTF-8"));
$battery_capacity = htmlentities(htmlentities($row['battery_capacity'], ENT_QUOTES, "UTF-8"));
$solar_panel_capacity = htmlentities(htmlentities($row['solar_panel_capacity'], ENT_QUOTES, "UTF-8"));
$solar_panel_installed_quantity = htmlentities(htmlentities($row['solar_panel_installed_quantity'], ENT_QUOTES, "UTF-8"));
$video = htmlentities(htmlentities($row['video'], ENT_QUOTES, "UTF-8"));




//style='display:inline-block;height:600px;'
      ?>

                    <div class="post col-sm-4_no well" id="post_<?php echo $id; ?>">


<img style='max-height:60px;max-width:60px;' class='img-circle' src='backend/user_photos/<?php echo $userphoto; ?>' alt='User Image'>

<span style='color:blue;'><b>Created By: </b> <?php echo $fullname;?></span>

<a class='readmore_btn2 pull-right' title='Visit Solarians/Users Profile' style='color:white;' href='user_profile.php?userid=<?php echo $post_userid; ?>'>Visit Solarians/Users Profile</a>
<br>
<a style='float:right;background:navy;color:white;padding:6px;border:none;' href="https://www.facebook.com/sharer/sharer.php?u=https://fredjarsoft.com/solarians/share.php?post_id=<?php echo $title_seo; ?>" target="_blank">
  Share on Facebook
</a><br><br>

<div class='translate_btn translate_css' data-toggle='modal' data-post_idx='<?php echo $id;?>' data-post_titlex='<?php echo $title;?>' data-target='#myModal_translate' title='Translate via ChatGPT/Gemini AI'>Translate via ChatGPT/Gemini AI</div>

<h3 style='font-size:18px;color:<?php echo $header_color; ?>'>Title: <?php echo $microtitle; ?></h3>

<b style='font-size:14px;color:#800000'>Content Description:</b> <?php echo $content; ?><br>

<span style='color:fuchsia;'><b> Points Awarded So Far for Solarian Contributions: </b> <span class='point_count'><?php echo $points; ?> (Points)</span></span> <br>


<span style=''><b> Solar Inverter Capacity: </b> <?php echo $solar_inverter_capacity; ?></span> (Watts)<br>
<span style=''><b> Solar Battery Type: </b> <?php echo $battery_type; ?></span> Battery<br>
<span style=''><b> Solar Battery Capacity: </b> <?php echo $battery_capacity; ?></span>  (Watts)<br>
<span style=''><b> Solar Panel Capacity: </b> <?php echo $solar_panel_capacity; ?>  (Watts)</span> <br>
<span style=''><b> Solar Panel Installed Quantity: </b> <?php echo $solar_panel_installed_quantity; ?> </span> <br>


<span>

&nbsp;<span data-comment_countx='<?php echo $total_comment; ?>' data-title='<?php echo $title; ?>' data-postid='<?php echo $postid; ?>' id="<?php echo $postid; ?>" data-toggle='modal' data-target='#myModal_comments' style="color:#800000;font-size:26px;cursor:pointer;" title="Comments" class="fa fa-comments-o comment_btns" title='Comments' data-toggle='modal' data-target='#myModal_comments' id='<?php echo $postid; ?>' data-total_comment='<?php echo $total_comment; ?>'> <span style='font-size:14px;'>Comments</span>  </span>
<span style='font-size:14px;color:#800000;'>(<span id="comment_total_<?php echo $postid; ?>"><?php echo $total_comment; ?></span>)</span>

</span>


<span>

<span data-title='<?php echo $title; ?>' style="font-size:26px;color:#800000;cursor:pointer;" class="plike_btns fa fa-heart-o" id="<?php echo $postid; ?>" title="Like">
&nbsp;<span id="<?php echo $postid; ?>"  style="color:#800000;" /></span>
<span style='font-size:14px'>(<span id="plike_total_<?php echo $postid; ?>"><?php echo $t_like; ?></span>)</span>
</span> 

<span id="loader-plike_<?php echo $postid; ?>"></span>
</span>

<br>
<span style='color:#800000;'><b> Created Since: </b> <span data-livestamp="<?php echo $timer1;?>"></span></span> <br>





<button style='display:none' class='readmore_btn btn btn-warning'><a title='Click to Comment and Like' style='color:white;' 
href='dashboard_post.php?title=<?php echo $title_seo; ?>'>Click to Comment and Like </a></button>
<br>

<div class='row'>
<div class='col-sm-6'>
<b>Solar Panel Image Display</b><br>
<img style='min-height:400px;min-width:400px;max-height:400px;max-width:400px;' class='img-rounded' src='backend/solar_post_images/<?php echo $image; ?>' alt='User Image'><br>
 </div>

<div class='col-sm-6'>
<b>Solar Panel Youtube Video Show</b><br>

 <iframe width="400" height="400"  style='min-height:400px;min-width:400px;max-height:400px;max-width:400px;'
src="https://www.youtube.com/embed/<?php echo $video; ?>">
</iframe> 
<br>
 </div>
</div>

         
</div>





            <?php

                }
            ?>
<center>
<div id="loader_posts" class="loader_posts"></div>
<div id="nomore_content_check_no"></div>
            <input type="hidden" id="row_limit" value="0">
            <input type="hidden" id="total_count" value="<?php echo $totalcount; ?>">
<br><br>
<button style='display:none;'  id="loadmore_btn" title='Load More Content' class="loadmore_css col-sm-12">Load More Content</button>
<br><br>
</center>
<div class="col-sm-12">.</div>
<br class="col-sm-12"><br class="col-sm-12">



</div>








</div>
<!--End Center-->





</div>
<!--Row-->



<script>

// Solarian Posts starts

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
                $('#solar_btn').click(function () {
				
                    var file_fname = $('#file_content').val();
                    var battery_type = $(".battery_type:checked").val();
 var video_id = $('#video_id').val();
 var titleo = $('#titleo').val();
 var desco = $('#desco').val();
 var solar_inverter_capacity = $('#solar_inverter_capacity').val();
 var solar_panel_capacity = $('#solar_panel_capacity').val();
 var solar_panel_installed_quantity = $('#solar_panel_installed_quantity').val();
 //var battery_type = $('#battery_type').val();
var solar_battery_capacity = $('#solar_battery_capacity').val();


// start if validate
if(file_fname==""){
alert('please Select File to Upload');
}
else if(video_id==""){
alert('Please Enter Youtube Video ID. Not Complete Video URL');
}

else if(titleo==""){
alert('Post Title Cannot be Empty');
}
else if(desco==""){
alert('Post Description Cannot be Empty');
}
else if(solar_inverter_capacity==""){
alert('solar_inverter_capacity cannot be empty');
}
else if(isNaN(solar_inverter_capacity)){
  alert("solar_inverter_capacity must be a number");
}
else if(solar_panel_capacity==""){
alert('solar_panel_capacity cannot be empty');
}
else if(solar_panel_installed_quantity==""){
alert('Solar Panel Installed Quantity cannot be empty');
}


else if(battery_type==undefined){
alert('please Select Your Battery Type..');
}
else if(solar_battery_capacity==""){
alert('Solar Battery Capacity Cannot be Empty');
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
          form_data.append('video_id', video_id);
          form_data.append('titleo', titleo);
          form_data.append('desco', desco);
          form_data.append('solar_inverter_capacity', solar_inverter_capacity);
          form_data.append('solar_panel_capacity', solar_panel_capacity);
          form_data.append('solar_panel_installed_quantity', solar_panel_installed_quantity);
          form_data.append('battery_type', battery_type);
          form_data.append('solar_battery_capacity', solar_battery_capacity);


                    $('.upload_progress').css('width', '0');
					$('#loaderx').hide();
                    $('#loader_solar').fadeIn(400).html('<br><div class="well" style="color:black"><img src="loader.gif">&nbsp;Please Wait, Your Data is being Processed.</div>');
                    $.ajax({
                        url: 'backend/solar_post.php',
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
				$('#loader_solar').hide();
				$('.result_solar').fadeIn('slow').prepend(msg);
				$('#alerts_solar').delay(5000).fadeOut('slow');
                                $('#alerts_solara').delay(5000).fadeOut('slow');
                                $('#alerts_solarx').delay(5000).fadeOut('slow');
                              
//strip all html elemnts using jquery
var html_stripped = jQuery(msg).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#file_content').val('');
this.checked = false;  //javascript
$("input:radio").attr("checked", false);
//$(this).prop('checked', false);
}

}
});





} // end if validate




                });
            });

// Solarian Posts ends

</script>








<!-- Solarian  Modal starts -->



<div id="myModal_solar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header"  style='background: #B931B9;color:white;padding:10px;'>
        <h4 class="modal-title">Post Content on Your Solar Usage or Installations  or Experience</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">




<div class="form-group">
<label style="">Upload Solar Image to be Shared....</label>
<input style="background:#c1c1c1;" class="col-sm-12 form-control" type="file" id="file_content" name="file_content" accept="image/*" onchange="imagePreview(event)" />
 <img id="imageupload_preview"/>
</div><br>



<div class="form-group">
<label style="">Youtube Video Link ID(Video showing your Solar as being Advertized..)</label>

<span style='color:purple'>https://www.youtube.com/watch?v=<span style='color:red'><b>SHHQoxyYecg</b></span></span>
<input style="" class="col-sm-12 form-control" type="text" id="video_id" name="video_id" placeholder="SHHQoxyYecg"/>

</div><br>



<div class="form-group">
<label style="">Post Title</label>
<input style="" class="col-sm-12 form-control" type="text" id="titleo" name="titleo" placeholder="Post Tile"/>

</div><br>


<div class="form-group">
<label style="">Post Description</label>
<textarea class="col-sm-12 form-control" rows="5" cols="10" id="desco" name="desco" placeholder="Post Description"></textarea>

</div><br>


<div class="form-group">
<label style="">Solar Inverter Capacity in (Watts)</label>
<span style='color:red'><b>numbers only</b></span>
<input style="" class="col-sm-12 form-control" type="text" id="solar_inverter_capacity" name="solar_inverter_capacity" placeholder="Solar Inverter Capacity in (Watts)"/>

</div><br>




<div class="form-group">
<label style="">Solar Panel Capacity in (Watts)</label>
<span style='color:red'><b>numbers only</b></span>
<input style="" class="col-sm-12 form-control" type="text" id="solar_panel_capacity" name="solar_panel_capacity" placeholder="Solar Panel Capacity in (Watts)"/>

</div><br>



<div class="form-group">
<label style="">Solar Panel Installed Quantity</label>
<span style='color:red'><b>numbers only</b></span>
<input style="" class="col-sm-12 form-control" type="text" id="solar_panel_installed_quantity" name="solar_panel_installed_quantity" placeholder="Solar Panel Installed Quantity"/>

</div><br>



<div class="form-group">
<label style="">Solar Battery Type</label><br>

<div class='col-sm-4 country_css'>
<input type="radio" id="battery_type" name="battery_type" value="Lithium" class="battery_type"/>
Lithium<br>
</div>

<div class='col-sm-4 country_css'>
<input type="radio" id="battery_type" name="battery_type" value="Gel" class="battery_type"/>
Gel<br>
</div>

<div class='col-sm-4 country_css'>
<input type="radio" id="battery_type" name="battery_type" value="Tubular" class="battery_type"/>
Tubular<br>
</div>

</div>



<div class="form-group">
<label style="">Solar Battery Capacity in (Watts)</label>
<span style='color:red'><b>numbers only</b></span>
<input style="" class="col-sm-12 form-control" type="text" id="solar_battery_capacity" name="solar_battery_capacity" placeholder="Solar Battery Capacity in (Watts)"/>
</div><br>


<br>

 <div class="form-group col-sm-12">
                            <div id="alerts_solarx" class="upload_progress" style="width:0%">0%</div>
                        <div id="loaderx_solar"></div>
						<div id="loader_solar"></div>
                        <div class="result_solar"></div>
                    </div>

                    <input type="button" id="solar_btn" class="btn btn-primary" value="Post Now" />


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- Solarian Post  Modal ends -->

<script>
$(document).ready(function(){
$('.map_call_btn').click(function(){

var country_call = $(this).data('country');
var company_address_call = $(this).data('company_address');
var company_name_call = $(this).data('company_name');

$('.country_call_p').html(country_call);
$('.company_address_call_p').html(company_address_call);
$('.company_name_call_p').html(company_name_call);

$('.company_address_call_value').val(company_address_call).value;

});
});



$(document).ready(function(){
$(document).on( 'click', '.map_call_btn2', function(){ 


var country_call = $(this).data('country');
var company_address_call = $(this).data('company_address');
var company_name_call = $(this).data('company_name');

$('.country_call_p').html(country_call);
$('.company_address_call_p').html(company_address_call);
$('.company_name_call_p').html(company_name_call);

$('.company_address_call_value').val(company_address_call).value;

});
});



// clear Modal div content on modal closef closed
$(document).ready(function(){
$('#myModal_maploc').on('hidden.bs.modal', function() {
//alert('Modal Closed');
   //$('.maploc_clean').empty();  
 console.log("modal closed and content cleared");
 });
});


$(document).ready(function(){
$('#myModal_mapdir').on('hidden.bs.modal', function() {
//alert('Modal Closed dir');
 $('.mapdir_clean_dir').empty();  
 console.log("modal closed and content cleared");
 });
});


</script>



<!-- map  Geo Location modal starts here -->


<div class="container_map">

  <div class="modal fade" id="myModal_maploc" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">
 

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h4 class="modal-title">Map Locations for <span style='color:purple' class='company_name_call_p'></span></h4>

<b>Address: </b> <span class='company_address_call_p'></span> (<span class='country_call_p'></span>)

        </div>
        <div class="modal-body">


<!-- start map loading-->
<style>
/*
#map {
        height: 80%;
      }
    
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
*/
.res_center_css{
position:absolute;top:50%;left:50%;margin-top: -50px;margin-left -50px;width:100px;height:100px;
}

</style>

<div id="loader_map_locx" class='res_center_css'></div>

    <div  style='width:600px; height:600px;' id="map" class='maploc_clean'></div>

    <script>
   var customLabel = {
        Vaccine: {
          label: 'P'
        }
      };

        function initMap() {


$(document).on( 'click', '.btn_map_locations2', function(){ 

var company_id = $(this).data('id');
var lngx = $(this).data('lng');
var latx = $(this).data('lat');

var country_call = $(this).data('country');
var company_address_call = $(this).data('company_address');
var company_name_call = $(this).data('company_name');

// convert Latitude Longitue to Float
const latx_convert = parseFloat(latx);
const lngx_convert = parseFloat(lngx);


        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(latx_convert, lngx_convert),
          zoom: 11
        });
        var infoWindow = new google.maps.InfoWindow;

$('#loader_map_locx').fadeIn(400).html('<br><div style="color:black;background:#c1c1c1;padding:10px;"><img src="loader.gif">  &nbsp;Please Wait, Google Map is being Loaded...</div>');

          //downloadUrl('map1_backend.php', function(data) {
			  downloadUrl('backend/map_single_location.php?company_id='+company_id, function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              //var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
var timing = markerElem.getAttribute('timing');
//var data_type = markerElem.getAttribute('data_type');
 var type = markerElem.getAttribute('type');
var email = markerElem.getAttribute('email');
var company_name = markerElem.getAttribute('company_name');
var photo =markerElem.getAttribute('photo');
var company_desc =markerElem.getAttribute('company_desc');
var country =markerElem.getAttribute('country');
var lati =markerElem.getAttribute('lat');
var lngi =markerElem.getAttribute('lng');

              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

$('#loader_map_locx').hide();

              var infowincontent = document.createElement('div');
             var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};



                var map_data = "<div style='background:#c1c1c1; border-bottom: 2px dashed #008080;'>" +
"<div style='background:purple;color:white;padding:10px;'>Map Location</div><br />" +
//"<a target='_blank' title='Click' class='btn btn-primary' href=map.php?id=" + timing +" >Click</a><br><br>" +

"<img src='backend/company_photos/" + photo +"' style='width:100px;max-width:100px;max-height:100px;height:100px;' class='pull-right img-rounded'>" +
"<h3><b>Company Name:</b> " + company_name + "</h3>" +
"<span><b>Company Description:</b> " + company_desc + "</span><br />" +
"<span><b>Company Email:</b> " + email + "</span><br />" +
"<span><b>Latitude:</b> " + lati + "</span><br />" +
"<span><b>Longitude:</b> " + lngi + "</span><br />" +
"<span><b>Location Address: </b>" + address + "</span><br />" +
"<span><b>Country: </b>" + country + "</span><br />" +

  "<span><b> <span class='fa fa-calendar'></span>Time Published: </b></span>" +
"<span data-livestamp='" + timing + "'></span></span><br /><br />"+
                    "</div>";


              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label,
 title : 'welcome'
              });
              marker.addListener('click', function() {
                //infoWindow.setContent(infowincontent);

//infoWindow.setContent('<b>'+name + "</b><br>" + address);

infoWindow.setContent(map_data);
                infoWindow.open(map, marker);
              });
            });
          });
}); //end  jquery click button 2


$('.btn_map_locations').click(function(){


var company_id = $(this).data('id');
var lngx = $(this).data('lng');
var latx = $(this).data('lat');

var country_call = $(this).data('country');
var company_address_call = $(this).data('company_address');
var company_name_call = $(this).data('company_name');

// convert Latitude Longitue to Float
const latx_convert = parseFloat(latx);
const lngx_convert = parseFloat(lngx);

//alert(company_address_call);

        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(latx_convert, lngx_convert),
          zoom: 11
        });
        var infoWindow = new google.maps.InfoWindow;

$('#loader_map_locx').fadeIn(400).html('<br><div style="color:black;background:#c1c1c1;padding:10px;"><img src="loader.gif">  &nbsp;Please Wait, Google Map is being Loaded...</div>');

          //downloadUrl('map1_backend.php', function(data) {
			  downloadUrl('backend/map_single_location.php?company_id='+company_id, function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              //var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
var timing = markerElem.getAttribute('timing');
//var data_type = markerElem.getAttribute('data_type');
 var type = markerElem.getAttribute('type');
var email = markerElem.getAttribute('email');
var company_name = markerElem.getAttribute('company_name');
var photo =markerElem.getAttribute('photo');
var company_desc =markerElem.getAttribute('company_desc');
var country =markerElem.getAttribute('country');
var lati =markerElem.getAttribute('lat');
var lngi =markerElem.getAttribute('lng');

              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

$('#loader_map_locx').hide();

              var infowincontent = document.createElement('div');
             var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};



                var map_data = "<div style='background:#c1c1c1; border-bottom: 2px dashed #008080;'>" +
"<div style='background:purple;color:white;padding:10px;'>Map Location</div><br />" +
//"<a target='_blank' title='Click' class='btn btn-primary' href=map.php?id=" + timing +" >Click</a><br><br>" +

"<img src='backend/company_photos/" + photo +"' style='width:100px;max-width:100px;max-height:100px;height:100px;' class='pull-right img-rounded'>" +
"<h3><b>Company Name:</b> " + company_name + "</h3>" +
"<span><b>Company Description:</b> " + company_desc + "</span><br />" +
"<span><b>Company Email:</b> " + email + "</span><br />" +
"<span><b>Latitude:</b> " + lati + "</span><br />" +
"<span><b>Longitude:</b> " + lngi + "</span><br />" +
"<span><b>Location Address: </b>" + address + "</span><br />" +
"<span><b>Country: </b>" + country + "</span><br />" +

  "<span><b> <span class='fa fa-calendar'></span>Time Published: </b></span>" +
"<span data-livestamp='" + timing + "'></span></span><br /><br />"+
                    "</div>";


              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label,
 title : 'welcome'
              });
              marker.addListener('click', function() {
                //infoWindow.setContent(infowincontent);

//infoWindow.setContent('<b>'+name + "</b><br>" + address);

infoWindow.setContent(map_data);
                infoWindow.open(map, marker);
              });
            });
          });
		  
		   });  // close jquery clickbutton


const lat_data ='<?php echo $lat_sess; ?>';
const lng_data ='<?php echo $lng_sess; ?>';

// convert Latitude Longitue to Float
const lat_datax = parseFloat(lat_data);
const lng_datax = parseFloat(lng_data);

//start map direction

const directionsRenderer = new google.maps.DirectionsRenderer();
  const directionsService = new google.maps.DirectionsService();
  const mapx = new google.maps.Map(document.getElementById("gmap"), {
    zoom: 7,
    center: { lat: lat_datax, lng: lng_datax },
    disableDefaultUI: true,
  });

  directionsRenderer.setMap(mapx);
  directionsRenderer.setPanel(document.getElementById("gmap_sidebar"));

  const control = document.getElementById("gmap_floating-panel");

  mapx.controls[google.maps.ControlPosition.TOP_CENTER].push(control);

 //const onChangeHandler = function () {


$(document).ready(function(){
$('.btn_map_send').click(function(){
    calculateAndDisplayRoute(directionsService, directionsRenderer);
});
});

$(document).ready(function(){
$(document).on( 'click', '.btn_map_send2', function(){ 
    calculateAndDisplayRoute(directionsService, directionsRenderer);
});
});

// refresh map on each modal click
$(document).ready(function(){
$('.btn_map_refresh').click(function(){
    calculateAndDisplayRoute(directionsService, directionsRenderer);
//alert('refreshed');
});
});

$(document).ready(function(){
$(document).on( 'click', '.btn_map_refresh2', function(){ 
    calculateAndDisplayRoute(directionsService, directionsRenderer);
//alert('refreshed');
});
});

// End  Map direction





        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);

      }



// start finalizing Map Direction

function calculateAndDisplayRoute(directionsService, directionsRenderer) {
  //const start = document.getElementById("start").value;
  const end = document.getElementById("end_destination").value;
$('.loading_map').fadeIn(400).html('<div style="color:black;background:#c1c1c1;padding:6px;"><img src="loader.gif">  &nbsp;Please Wait, Google Map Direction is being Loaded...</div>');

  directionsService
    .route({
      origin: '<?php echo $address_sess; ?>',
      destination: end,
      travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
      directionsRenderer.setDirections(response);
if(response == '[object Object]'){
//alert(response);
     $('.loading_map').hide();
}

    })
    .catch((e) => {window.alert("Directions request failed due to Internet Connection.." + status); $('.loading_map').hide();}

);
 
}

// end finalizing Map Direction



      function doNothing() {}

 $('#myModal_maploc').on('shown.bs.modal', function(){
    //init();
initMap();

    });

 $('#myModal_mapdir').on('shown.bs.modal', function(){
    //init();
initMap();

    });


    </script>

  


<!-- end map loading-->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>



<!-- map Geo location modal ends here -->




<style>

/* Optional: Makes the sample page fill the window. 
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}
*/

.divbody{
 height: 100%;
  margin: 0;
  padding: 0;

}

#gmap_container {
  height: 100%;
  display: flex;
}

#gmap_sidebar {
  flex-basis: 15rem;
  flex-grow: 1;
  padding: 1rem;
  max-width: 30rem;
  height: 100%;
  box-sizing: border-box;
  overflow: auto;
}

#gmap {
  flex-basis: 0;
  flex-grow: 4;
  height: 100%;
}

#gmap_floating-panel {
  position: absolute;
  top: 10px;
  left: 25%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: "Roboto", "sans-serif";
  line-height: 30px;
  padding-left: 10px;
}

#gmap_floating-panel {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  padding: 5px;
  font-size: 14px;
  text-align: center;
  line-height: 30px;
  height: auto;
}

#gmap {
  flex: auto;
}

#gmap_sidebar {
  flex: 0 1 auto;
  padding: 0;
}
#gmap_sidebar > div {
  padding: 0.5rem;
}

</style>








<!-- map  direction modal starts here -->


<div class="container_map">

  <div class="modal fade" id="myModal_mapdir" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">
 

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h4 class="modal-title">Map Directions for <span style='color:purple' class='company_name_call_p'></span></h4>
<b>Address: </b> <span class='company_address_call_p'></span> (<span class='country_call_p'></span>)
        </div>
        <div class="modal-body">


<!-- start map loading-->




  <div class='divbody'>
    <div id="gmap_floating-panel">
      <strong>Start: (Your Location):</strong> <?php echo $address_sess; ?>
      
      <br />
      <strong>End: (Solarian Installation Company Location)</strong>
<span class='company_address_call_p'></span>
<input type='hidden' class='company_address_call_value' id='end_destination' value =''>
<div class='loading_map'></div>
<button class='btn_map_send btn btn-primary btn-xs' >Get Direction</button>


     
    </div>
    <div id="gmap_container">
      <div style='width:600px; height:600px;' id="gmap"></div>
      <div id="gmap_sidebar"  class='mapdir_clean_dir'></div>
    </div>
    <div style="display: none">
      <div id="gmap_floating-panel">
        <strong>Start:</strong>
        <select id="start">
        </select>
        <br />
        <strong>End:</strong>
        <select id="end">
        </select>
      </div>
    </div>
 


  </div>


<!-- end map loading-->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>



<!-- map Direction modal ends here -->







<!-- Comments starts here -->


<div class="container_map">

  <div class="modal fade" id="myModal_comments" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">
 

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h4 class="modal-title">Comments System For:  <span style='color:purple' class='title_p'></span></h4>

<center><b>Total Comments: </b> <span id="comment_totalx"></span></center><br>

        </div>
        <div class="modal-body">


<!-- start-->

<!--start comment-->



<div id="result_comment"></div>
<div id="loader-comment"></div>




<!--end comment-->


<!-- end -->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>



<!-- Comments modal ends here -->


<script>

// ChatGPT/Gemini AI TRANSLATION Starts

$(document).ready(function(){
$(document).on( 'click', '.translate_btn', function(){ 

 //var post_id = this.id; 

var id = $(this).data('post_idx');
var title = $(this).data('post_titlex');

$('.post_title_translate').html(title);
$('.post_id_translate').val(id).value;



$("#loader_postx").fadeIn(400).html('<span style="color:;background:;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Loading Post Contents....</span>');

        $.ajax({
            url: 'backend/post_load.php',
            type: 'post',
            data: {id:id},
            dataType: 'html',
            success: function(data){

$("#loader_postx").hide();
$("#result_postx").html(data);

 }
        });



});
});




$(document).ready(function(){
$(".translate_send_btn").click(function(){

var translate_ai = $(".translate_ai:checked").val();
var lang =  $("#lang").val();
var id =  $(".post_id_translate").val();

if(id==''){
alert('Post ID For Translation cannot be empty...');
return false;
}

if(translate_ai==undefined){
alert('Please Select AI to be used  for Translation...');
return false;
}
 if(lang==''){
alert('please Select Language For Translation..');
return false;
}


// Translation by ChatGPT OpenAI starts

if(translate_ai =='openai'){


$("#loader_translatex").fadeIn(400).html('<span style="color:;background:;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Translation By ChatGPT OpenAI in progress.</span>');

        $.ajax({
            url: 'backend/translate_chatgpt_openai.php',
            type: 'post',
            data: {id:id, lang:lang},
            dataType: 'html',
            success: function(data){

$("#loader_translatex").hide();
$("#result_translatex").html(data);
$('#alerts_openai2').delay(5000).fadeOut('slow');

//strip all html elemnts using jquery
var html_stripped = jQuery(data).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#lang').val('');
this.checked = false;  //javascript
$("input:radio").attr("checked", false);
//$(this).prop('checked', false);
}

 }
        });

}
// Translation by ChatGPT OpenAI Ends



// Translation by Google Gemini AI starts

if(translate_ai =='geminiai'){

$("#loader_translatex").fadeIn(400).html('<span style="color:;background:;padding:10px;"><img src="loader.gif">&nbsp;Please Wait, Translation By Google Gemini AI in progress.</span>');

        $.ajax({
            url: 'backend/translate_google_gemini.php',
            type: 'post',
            data: {id:id, lang:lang},
            dataType: 'html',
            success: function(data){

$("#loader_translatex").hide();
$("#result_translatex").html(data);
$('#alerts_geminiai2').delay(5000).fadeOut('slow');

//strip all html elemnts using jquery
var html_stripped = jQuery(data).text();
//alert(html_stripped);

//check occurrence of word (successfully) from backend output already html stripped.
var Frombackend = html_stripped;
var bcount = (Frombackend.match(/Successfully/g) || []).length;
//alert(bcount);

if(bcount > 0){
$('#lang').val('');
this.checked = false;  //javascript
$("input:radio").attr("checked", false);
//$(this).prop('checked', false);
}

 }
        });

}
// Translation by Google Gemini AI Ends





    });
});

// ChatGPT/Gemini AI TRANSLATION ends


// clear Modal div content on modal closef closed
$(document).ready(function(){
$('#myModal_translate').on('hidden.bs.modal', function() {
//alert('Modal Closed');
   $('.translate_clean').empty();  
 console.log("modal closed and content cleared");
 });
});


</script>







<!-- AI Translate starts here -->


<div class="container_map">

  <div class="modal fade" id="myModal_translate" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h3 class="modal-title">Posts Content Translations by ChatGPT/Gemini AI</h3>

        </div>
        <div class="modal-body">

Easily prevent language barrier by translating posts content to various languages to facilitates content reading and comprehension by various under-represented 
communities in their various languages powered by <b>OpenAI and Google Gemini AI</b><br><br>
<!-- start-->

<h3>Posts Title: </b> <span class="post_title_translate"></span></h3>
<input type='hidden' class='post_id_translate' value=''>



<div id='loader_postx'></div>
<div id='result_postx'></div><br>


<div class="form-group">
<label style="">Select AI to be used for Translations..</label><br>

<div class='col-sm-6 country_css'>
<input type="radio" id="translate_ai" name="translate_ai" value="openai" class="translate_ai"/>
ChatGPT/OpenAI<br>
</div>

<div class='col-sm-6 country_css'>
<input type="radio" id="translate_ai" name="translate_ai" value="geminiai" class="translate_ai"/>
Google Gemini AI<br>
</div>

</div>

<br>

 <div class="form-group col-sm-12">
              <label> Select Language for Translation: </label>


<select class="col-sm-12 form-control" id="lang" name="lang">
    <option value=''>--- Select Languages ----</option>
    <option value="Arabic">Arabic</option>
    <option value="Bengali">Bengali</option>
    <option value="Bosnian">Bosnian</option>
    <option value="Chinese">Chinese</option>
    <option value="Croatian">Croatian</option>
    <option value="Czech">Czech</option>
    <option value="Danish">Danish</option>
    <option value="Dutch - Nederlands">Dutch - Nederlands</option>
    <option value="Estonian">Estonian</option>
    <option value="Finnish">Finnish</option>
    <option value="French">French</option>
    <option value="Galician">Galician</option>
    <option value="Georgian">Georgian</option>
    <option value="German">German</option>
    <option value="Greek">Greek</option>
    <option value="Guarani">Guarani</option>
    <option value="Gujarati">Gujarati</option>
    <option value="Hausa">Hausa</option>
    <option value="Hawaiian">Hawaiian</option>
    <option value="Hindi">Hindi</option>
    <option value="Hebrew">Hebrew</option>
    <option value="Hungarian">Hungarian</option>
    <option value="Icelandic">Icelandic</option>
    <option value="Indonesian">Indonesian</option>
    <option value="Irish">Irish</option>
    <option value="Italian">Italian</option>
    <option value="Japanese">Japanese</option>
    <option value="Kannada">Kannada</option>
    <option value="Korean">Korean</option>
    <option value="Kurdish">Kurdish - Kurdî</option>
    <option value="Kyrgyz">Kyrgyz</option>
    <option value="Lao">Lao</option>
    <option value="latin">Latin</option>
    <option value="Latvian">Latvian</option>
    <option value="Lingala">Lingala</option>
    <option value="Lithuanian">Lithuanian</option>
    <option value="Macedonian">Macedonian</option>
    <option value="Malay">Malay</option>
    <option value="Malayalam">Malayalam</option>
    <option value="Maltese">Maltese</option>
    <option value="Marathi">Marathi</option>
    <option value="Mongolian">Mongolian</option>
    <option value="Nepali">Nepali</option>
    <option value="Norwegian">Norwegian</option>
    <option value="Persian">Persian </option>
    <option value="Polish">Polish</option>
    <option value="Portuguese">Portuguese</option>
    <option value="Punjabi">Punjabi</option>
    <option value="Romanian">Romanian</option>
    <option value="Russian">Russian</option>
    <option value="Scottish">Scottish</option>
    <option value="Serbian">Serbian</option>
    <option value="Serbo-Croatian">Serbo-Croatian</option>
    <option value="Slovenian">Slovenian</option>
    <option value="Somali">Somali</option>
    <option value="Spanish">Spanish</option>
    <option value="Sundanese">Sundanese</option>
    <option value="Swedish">Swedish</option>
    <option value="Tajik">Tajik</option>
    <option value="Tamil">Tamil</option>
    <option value="Telugu">Telugu</option>
    <option value="Turkish">Turkish</option>
    <option value="Turkmen">Turkmen</option>
    <option value="Ukrainian">Ukrainian</option>
    <option value="Urdu">Urdu</option>
    <option value="Vietnamese">Vietnamese</option>
</select>

            </div>

<div class='col-sm-12' id="loader_translatex"></div>
<div class='col-sm-12 translate_clean' id="result_translatex"></div>


<button class='translate_send_btn btn btn-primary'>Translate Post/Content Now</button>



<!-- end -->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>



<!-- AI Translate modal ends here -->





<script>

// ChatGPT/Gemini AI Chat Enquries Starts

$(document).ready(function(){
$(".ai_send_btn").click(function(){

var chatbot_ai = $(".chatbot_ai:checked").val();
if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used  by Chatbot.Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}


var id_data = this.id; 
var idx = $(this).data('idx');
var id = id_data.split('_')[0];
var content = id_data.split('_')[1];

if(id =='1'){
$("#loader_1").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Generating Content about Solar....</span>');

        $.ajax({
            url: 'backend/enquiry_openai_geminiai.php',
            type: 'post',
            data: {id:id,content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_1").hide();

//document.getElementById('content').innerHTML = marked.parse('# Marked bago in the browser\n\nRendered by **marked**.');
$("#result_1").html(marked.parse(data));
$('#alerts_openai').delay(5000).fadeOut('slow');
$('#alerts_geminiai').delay(5000).fadeOut('slow');

 }
 });

}



if(id =='2'){
$("#loader_2").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Checking How Does Solar Works....</span>');

        $.ajax({
            url: 'backend/enquiry_openai_geminiai.php',
            type: 'post',
            data: {id:id,content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_2").hide();
$("#result_2").html(marked.parse(data));
$('#alerts_openai').delay(5000).fadeOut('slow');
$('#alerts_geminiai').delay(5000).fadeOut('slow');

 }
 });

}


if(id =='3'){
$("#loader_3").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, List Advantages of Solar Energy Over Electricity....</span>');

        $.ajax({
            url: 'backend/enquiry_openai_geminiai.php',
            type: 'post',
            data: {id:id,content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_3").hide();
$("#result_3").html(marked.parse(data));
$('#alerts_openai').delay(5000).fadeOut('slow');
$('#alerts_geminiai').delay(5000).fadeOut('slow');

 }
 });

}



if(id =='4'){
$("#loader_4").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Checking How Does Solar Energy Makes Climates Greener....</span>');

        $.ajax({
            url: 'backend/enquiry_openai_geminiai.php',
            type: 'post',
            data: {id:id,content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_4").hide();
$("#result_4").html(marked.parse(data));
$('#alerts_openai').delay(5000).fadeOut('slow');
$('#alerts_geminiai').delay(5000).fadeOut('slow');

 }
 });

}


if(id =='5'){
$("#loader_5").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Analyzing Solar Battery Types....</span>');

        $.ajax({
            url: 'backend/enquiry_openai_geminiai.php',
            type: 'post',
            data: {id:id,content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_5").hide();
$("#result_5").html(marked.parse(data));
$('#alerts_openai').delay(5000).fadeOut('slow');
$('#alerts_geminiai').delay(5000).fadeOut('slow');

 }
 });

}



if(id =='6'){
$("#loader_6").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Checking How Much does it cost to own a Solar....</span>');

        $.ajax({
            url: 'backend/enquiry_openai_geminiai.php',
            type: 'post',
            data: {id:id,content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_6").hide();
$("#result_6").html(marked.parse(data));
$('#alerts_openai').delay(5000).fadeOut('slow');
$('#alerts_geminiai').delay(5000).fadeOut('slow');

 }
 });

}


if(id =='7'){
$("#loader_7").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Checking what Solars Panel is all about....</span>');

        $.ajax({
            url: 'backend/enquiry_openai_geminiai.php',
            type: 'post',
            data: {id:id,content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_7").hide();
$("#result_7").html(marked.parse(data));
$('#alerts_openai').delay(5000).fadeOut('slow');
$('#alerts_geminiai').delay(5000).fadeOut('slow');

 }
 });

}



if(id =='8'){
$("#loader_8").fadeIn(400).html('<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Checking how to Government Grants to build Solar Energy....</span>');

        $.ajax({
            url: 'backend/enquiry_openai_geminiai.php',
            type: 'post',
            data: {id:id,content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_8").hide();
$("#result_8").html(marked.parse(data));
$('#alerts_openai').delay(5000).fadeOut('slow');
$('#alerts_geminiai').delay(5000).fadeOut('slow');

 }
 });

}




});
});



$(document).ready(function(){
//$(".clear_btn").click(function(){
$(document).on( 'click', '.clear_btn', function(){ 

$('.clear_res').empty();
$('.clear_res_chat').empty();  
alert('AI Responses Cleared Successfully..');

});
});

//ChatGPT/Gemini AI Chat Enquries ends



// clear Modal div content on modal closef closed
$(document).ready(function(){
$('#myModal_chatbot').on('hidden.bs.modal', function() {
//alert('Modal Closed');
   $('.ai_enquiry_clean').empty();  
$('.ai_chat_clean').empty(); 
 console.log("modal closed and content cleared");
 });
});







// ChatGPT/Gemini AI Text Chat Starts

$(document).ready(function(){
$(".aichat_btn").click(function(){

var chatbot_ai = $(".chatbot_ai:checked").val();
var content = $("#chat_message").val();

if(chatbot_ai==undefined){
alert('Please Select/Checkbox AI above to be used  by Chatbot. Select Either ChatGPT/OpenAI or Google Gemini AI');
return false;
}


if(content==''){
alert('AI Chat Message cannot be Empty...');
return false;
}


$("#loader_aichat").fadeIn(400).html(`<span style="color:black;background:#ddd;padding:4px;"><img src="loader.gif">&nbsp;Please Wait, Generating Chat Response by ${chatbot_ai}</span>`);

        $.ajax({
            url: 'backend/chat_openai_geminiai.php',
            type: 'post',
            data: {content:content,chatbot_ai:chatbot_ai},
            dataType: 'html',
            success: function(data){
$("#loader_aichat").hide();
$("#result_aichat").html(marked.parse(data));
$('#alerts_openai3').delay(5000).fadeOut('slow');
$('#alerts_geminiai3').delay(5000).fadeOut('slow');

$("#chat_message").val('');

 }
 });

 });
 });



</script>


<!-- AI Chatbot starts here -->


<div class="container_map">

  <div class="modal fade" id="myModal_chatbot" role="dialog">
    <div class="modal-dialog modal-lg  modal-appear-center1 pull-right1_no modaling_sizing1  full-screen-modal_no">
      <div class="modal-content">
        <div class="modal-header" style="color:black;background:#c1c1c1">

      
 <button type="button" class="close btn btn-warning" data-dismiss="modal">Close</button>

      <h3 class="modal-title"> ChatGPT & Gemini AI Chatbot</h3>

        </div>
        <div class="modal-body">

Easily Chat with <b>OpenAI and Google Gemini AI</b> to get more detailed insights about Solar, its Features,Batteries,  installations, Solar Greener Energy and much more...<br><br>


<!-- start-->


<div class="form-group">
<label style="">Select AI to be used by the Chatbot ..</label><br>

<div class='col-sm-6 country_css'>
<input type="radio" id="chatbot_ai" name="chatbot_ai" value="Open_AI" class="chatbot_ai"/>
ChatGPT/OpenAI<br>
</div>

<div class='col-sm-6 country_css'>
<input type="radio" id="chatbot_ai" name="chatbot_ai" value="Gemini_AI" class="chatbot_ai"/>
Google Gemini AI<br>
</div>

</div>


<div class="row">

<div class="col-sm-6">
<h3>AI Inqury About Solar Greener Energy</h3>

<span style='color:red;'> Click Any button below to Get ChatGPT or Gemini AI Responses on Solar Greener Energy.</span><br><br>


<div class='' id="loader_1"></div>
<div class='ai_enquiry_clean ai_enquiry_clean_1' id="result_1"></div>
<div class='ai_send_btn cat_css' data-idx='1' id='1_Tell Me what you know About Solar Energy' >Tell Me what you know About Solar Energy</div><br>


<div class='' id="loader_2"></div>
<div class='ai_enquiry_clean ai_enquiry_clean_2' id="result_2"></div>
<div class='ai_send_btn cat_css' data-idx='2' id='2_How Does Solar Works' >How Does Solar Works</div><br>

<div class='' id="loader_3"></div>
<div class='ai_enquiry_clean ai_enquiry_clean_3' id="result_3"></div>
<div class='ai_send_btn cat_css' data-idx='3' id='3_List Advantages of Solar Energy Over Electricity' >List Advantages of Solar Energy Over Electricity</div><br>

<div class='' id="loader_4"></div>
<div class='ai_enquiry_clean ai_enquiry_clean_4' id="result_4"></div>
<div class='ai_send_btn cat_css' data-idx='4' id='4_How Does Solar Energy Makes Climates Greener' >How Does Solar Energy Makes Climates Greener</div><br>

<div class='' id="loader_5"></div>
<div class='ai_enquiry_clean ai_enquiry_clean_5' id="result_5"></div>
<div class='ai_send_btn cat_css' data-idx='5' id='5_List Solar Battery Types. Which Solar Battery type is the Best and Why?' >List Solar Battery Types. Which Solar Battery is the Best and Why?</div><br>

<div class='' id="loader_6"></div>
<div class='ai_enquiry_clean ai_enquiry_clean_6' id="result_6"></div>
<div class='ai_send_btn cat_css' data-idx='6' id='6_How Much does it cost to own a Solar' >How Much does it cost to own a Solar</div><br>

<div class='' id="loader_7"></div>
<div class='ai_enquiry_clean ai_enquiry_clean_7' id="result_7"></div>
<div class='ai_send_btn cat_css' data-idx='7' id='7_What are Solar Panels' >What are Solar Panels</div><br>

<div class='' id="loader_8"></div>
<div class='ai_enquiry_clean ai_enquiry_clean_8' id="result_8"></div>
<div class='ai_send_btn cat_css' data-idx='8' id='8_How to get Government Grants to build Solar Energy' >How to get Government Grants to build Solar Energy</div><br>

You still have more question, Chat with the Chatbot Now..



</div>






<div class="col-sm-6">

<h4 style='color:purple''>Still have further Questions about  Solar Greener Energy, Chat with ChatGPT Or Google Gemini AI Now</h4>



<div class="form-group col-sm-12">
<textarea rows='3' cols='3' id='chat_message' class='col-sm-12' placeholder="Enter Chat Message"></textarea>
</div>
<br>


<div class='col-sm-12' id="loader_aichat"></div>
<div class='col-sm-12 ai_chat_clean' id="result_aichat"></div>
<br>

<button class='aichat_btn btn btn-primary'>Chat with OpenAI Or Gemini AI Now</button>
</div>

</div>

<!-- end -->





        </div>
      

   <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>


      </div>
    </div>
  </div>
</div>



<!-- AI Chat modal ends here -->





<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_map_keys; ?>&callback=initMap">
    </script>

<!-- footer Section start -->

<footer class=" navbar_footer text-center footer_bgcolor">

<div class="row">
        <div class="col-sm-12">


<p class="footer_text1"><?php echo $titlex; ?></p>
<p class="footer_text2"><?php  echo $description; ?></p>
<br>

        </div>



        </div>

<br/>
  <p></p>
</footer>

<!-- footer Section ends -->


   
</body>
</html>


