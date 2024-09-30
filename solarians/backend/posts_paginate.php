<?php
error_reporting(0);
session_start();
include ('db_connection.php');


$userid_sess =  htmlentities(htmlentities($_SESSION['uid_s'], ENT_QUOTES, "UTF-8"));
$fullname_sess =  htmlentities(htmlentities($_SESSION['fullname_s'], ENT_QUOTES, "UTF-8"));
$country_sess =   htmlentities(htmlentities($_SESSION['country_s'], ENT_QUOTES, "UTF-8"));
$country_nickname_sess =   htmlentities(htmlentities($_SESSION['country_nickname_s'], ENT_QUOTES, "UTF-8"));
$photo_sess =  htmlentities(htmlentities($_SESSION['photo_s'], ENT_QUOTES, "UTF-8"));
$address_sess =  htmlentities(htmlentities($_SESSION['address_s'], ENT_QUOTES, "UTF-8"));
$lat_sess = htmlentities(htmlentities($_SESSION['lat_s'], ENT_QUOTES, "UTF-8"));
$lng_sess = htmlentities(htmlentities($_SESSION['lng_s'], ENT_QUOTES, "UTF-8"));
$map_zoom_sess = htmlentities(htmlentities($_SESSION['map_zoom_s'], ENT_QUOTES, "UTF-8"));

$row = 0;
if(isset($_POST['row_limit'])){
    $row = strip_tags($_POST['row_limit']);
}

$rowpage = 2;



$result = $db->prepare("SELECT * FROM posts_solar order by id desc limit :row1, :rowpage");
$result->bindValue(':rowpage', (int) trim($rowpage), PDO::PARAM_INT);
$result->bindValue(':row1', (int) trim($row), PDO::PARAM_INT);
//$result->bindValue(':country_nickname', trim($country_nickname_sess), PDO::PARAM_STR);
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

                    <div class="post col-sm-4x well" id="post_<?php echo $id; ?>" >





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






	