<?php
error_reporting(0);

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
session_start();
$userid_sess =  htmlentities(htmlentities($_SESSION['uid_s'], ENT_QUOTES, "UTF-8"));


include('settings.php');
include('db_connection.php');

$id = strip_tags($_POST['id']);




if ($id == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_translate'>Post Id is empty</div>";
exit();
}


$result = $db->prepare("SELECT * FROM posts_solar WHERE id=:id");
$result->bindValue(':id', trim($id), PDO::PARAM_STR);
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


?>




                    <div class="post col-sm-4_no well" id="post_<?php echo $id; ?>">



<img style='max-height:60px;max-width:60px;' class='img-circle' src='backend/user_photos/<?php echo $userphoto; ?>' alt='User Image'>

<span style='color:blue;'><b>Created By: </b> <?php echo $fullname;?></span>

<h3 style='font-size:18px;color:<?php echo $header_color; ?>'>Title: <?php echo $microtitle; ?></h3>

<b style='font-size:14px;color:#800000'>Content Description:</b> <?php echo $content; ?><br>


<span style=''><b> Solar Inverter Capacity: </b> <?php echo $solar_inverter_capacity; ?></span> (Watts)<br>
<span style=''><b> Solar Battery Type: </b> <?php echo $battery_type; ?></span> Battery<br>
<span style=''><b> Solar Battery Capacity: </b> <?php echo $battery_capacity; ?></span>  (Watts)<br>
<span style=''><b> Solar Panel Capacity: </b> <?php echo $solar_panel_capacity; ?>  (Watts)</span> <br>
<span style=''><b> Solar Panel Installed Quantity: </b> <?php echo $solar_panel_installed_quantity; ?> </span> <br>
<span style='color:#800000;'><b> Created Since: </b> <span data-livestamp="<?php echo $timer1;?>"></span></span> <br>


</div>





            <?php

                }

}
            ?>


