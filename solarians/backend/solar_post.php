<?php
//error_reporting(0);

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

session_start();
$userid_sess =  htmlentities(htmlentities($_SESSION['uid_s'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname_s'], ENT_QUOTES, "UTF-8"));
$country_sess =   htmlentities(htmlentities($_SESSION['country_s'], ENT_QUOTES, "UTF-8"));
$country_nickname_sess =   htmlentities(htmlentities($_SESSION['country_nickname_s'], ENT_QUOTES, "UTF-8"));
$photo_sess =  htmlentities(htmlentities($_SESSION['photo_s'], ENT_QUOTES, "UTF-8"));
$address_sess =  htmlentities(htmlentities($_SESSION['address_s'], ENT_QUOTES, "UTF-8"));
$lat_sess = strip_tags($_SESSION['lat_s']);
$lng_sess = strip_tags($_SESSION['lng_s']);
$map_zoom_sess = strip_tags($_SESSION['map_zoom_s']);


include('settings.php');
include('db_connection.php');

$title_post = strip_tags($_POST['titleo']);
$video_id = strip_tags($_POST['video_id']);
$desco = strip_tags($_POST['desco']);
$solar_inverter_capacity = strip_tags($_POST['solar_inverter_capacity']);
$solar_panel_capacity = strip_tags($_POST['solar_panel_capacity']);
$solar_panel_installed_quantity = strip_tags($_POST['solar_panel_installed_quantity']);
$battery_type = strip_tags($_POST['battery_type']);
$solar_battery_capacity = strip_tags($_POST['solar_battery_capacity']);



$file_content = strip_tags($_POST['file_fname']);
	
$timer = time();
include("time/now.fn");
$created_time=strip_tags($now);
$mt = microtime(true);
$mdx = md5($mt);
$uidx = uniqid();
$userid = $uidx.$timer.$mdx;
$tit = $uidx.$timer.$mdx;


if ($file_content == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>Files Upload is empty</div>";
exit();
}


if ($title_post == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>Post Title is empty</div>";
exit();
}

if ($desco == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>Post Description is empty</div>";
exit();
}


if ($solar_inverter_capacity == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>solar_inverter_capacity is empty</div>";
exit();
}

if ($solar_panel_capacity == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>solar_panel_capacity is empty</div>";
exit();
}

if ($solar_panel_installed_quantity == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>solar_panel_installed_quantity is empty</div>";
exit();
}

if ($battery_type == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>battery_type is empty</div>";
exit();
}

$upload_path = "solar_post_images/";

$filename_string = strip_tags($_FILES['file_content']['name']);
// thus check files extension names before major validations

$allowed_formats = array("PNG", "png", "gif", "GIF", "jpeg", "JPEG", "BMP", "bmp","JPG","jpg");
$exts = explode(".",$filename_string);
$ext = end($exts);

if (!in_array($ext, $allowed_formats)) { 
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>File Formats not allowed. Only Images are allowed.<br></div>";
exit();
}


$fsize = $_FILES['file_content']['size']; 
$ftmp = $_FILES['file_content']['tmp_name'];

if ($fsize > 50 * 1024 * 1024) { // allow file of less than 5 mb
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>File greater than 50 mb not allowed<br></div>";
exit();
}



$allowed_types=array(
'image/gif',
'image/jpeg',
'image/png',
'image/jpg',
'image/GIF',
'image/JPEG',
'image/PNG',
'image/JPG'
);

if ( ! ( in_array($_FILES["file_content"]["type"], $allowed_types) ) ) {
 echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>Only Images are allowed<br><br></div>";
exit();
}

//validate image using file info  method
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $_FILES['file_content']['tmp_name']);


if ( ! ( in_array($mime, $allowed_types) ) ) {
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_recycle'>Only Images are allowed...<br></div>";
exit();
}
finfo_close($finfo);

//insert into database
$final_filename =$userid.$filename_string;


if (move_uploaded_file($ftmp, $upload_path . $final_filename)) {

//Process the Uploaded Image by Gemini AI..


$statement = $db->prepare('INSERT INTO posts_solar
(title,title_seo,content,fullname,timer,userid,userphoto,points,total_comments,total_like,country_nickname,country_name,image,solar_inverter_capacity,battery_type,battery_capacity,solar_panel_capacity,solar_panel_installed_quantity,video)

                          values
(:title,:title_seo,:content,:fullname,:timer,:userid,:userphoto,:points,:total_comments,:total_like,:country_nickname,:country_name,:image,
:solar_inverter_capacity,:battery_type,:battery_capacity,:solar_panel_capacity,:solar_panel_installed_quantity,:video)');

$statement->execute(array( 
':title' => $title_post,
':title_seo' => $tit,
':content' => $desco,		
':fullname' => $fullname_sess,
':timer' => $timer,
':userid' =>$userid_sess,
':userphoto' =>$photo_sess,
':points' =>$points,
':total_comments' =>'0',
':total_like' =>'0',
':country_nickname' =>$country_nickname_sess,
':country_name' =>$country_sess,
':image' => $final_filename,
':solar_inverter_capacity' => $solar_inverter_capacity,
':battery_type' => $battery_type,
':battery_capacity' => $solar_battery_capacity,
':solar_panel_capacity' => $solar_panel_capacity,
':solar_panel_installed_quantity' => $solar_panel_installed_quantity,
':video' => $video_id
));


$stmtx = $db->query("SELECT LAST_INSERT_ID()");
$lastInserted_Id = $stmtx->fetchColumn();


// get users points and make updates
$result_u = $db->prepare('SELECT * FROM users_solar where userid =:userid');
$result_u->execute(array(':userid' => $userid_sess));
$nosofrows_u = $result_u->rowCount();
$row_u = $result_u->fetch();
$user_point = $row_u['points'];
$user_point_added = $user_point + 100;	

// update users Tables for users points
$result = $db->prepare('UPDATE users_solar set points=:points where userid =:userid');
$result->execute(array(':points' => $user_point_added, ':userid' => $userid_sess));

// update posts table for users points
$result = $db->prepare('UPDATE posts_solar set points=:points where userid =:userid');
$result->execute(array(':points' => $user_point_added, ':userid' => $userid_sess));


// send post broadcast notifications to all Solarians

$result = $db->prepare('SELECT * FROM users_solar');
$result->execute(array());
$nosofrows = $result->rowCount();


if($nosofrows > 0){
//foreach($row['data'] as $v1){
while($row = $result->fetch()){

$reciever_userid = $row['id'];
$reciever_userid2 = $row['userid'];
		    
//insert into notification table	

$statement1 = $db->prepare('INSERT INTO notification_solar
(post_id,userid,fullname,photo,reciever_id,status,type,timing,title,title_seo)
                        values
(:post_id,:userid,:fullname,:photo,:reciever_id,:status,:type,:timing,:title,:title_seo)');
$statement1->execute(array( 

':post_id' => $lastInserted_Id,
':userid' => $userid_sess,
':fullname' => $fullname_sess,
':photo' => $photo_sess,
':reciever_id' => $reciever_userid2,
':status' => 'unread',
':type' => 'post',
':timing' => $timer,
':title' => $title_post,
':title_seo' => $tit
));

}
}

if($statement){
echo  "<script>alert('Content Successfully Posted');</script>";
echo "<div style='background:green;padding:8px;color:white;border:none;'>Content Successfully Posted..</div>";
echo "<script>
location.reload();
</script>
";

}else{
echo "<div id='alerts_recycle' style='background:red;padding:8px;color:white;border:none;'>Content Posting  Failed...</div>";
}

}// close file upload

}


?>



