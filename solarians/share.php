<?php
error_reporting(0); 
?>



<?php
include ('backend/settings.php');

$post_title = strip_tags($_GET['post_id']);


if($post_title ==''){
echo "<div style='background:red;padding:8px;color:white;border:none;'>Direct Dashboard Page Access not Allowed...</div>";
exit();
}

// Ensure that only Alpha numeric Character are passed to prevent remote file inclusion Attack....
$post_title_vaidate = preg_replace("/[^a-zA-Z0-9]+/", "", $post_title);

// update table notification with Unread for read Updates starts
include('backend/db_connection.php');

?>




<!DOCTYPE html>
<html lang="en">

<head>
 <title>Welcome to Solarians </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="" />

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
     
<li class="navbar-brand home_click imagelogo_li_remove" ><img title='logo' alt='logo' class="img-rounded imagelogo_data" src="image/logo.png"></li>
    </div>
    <div class="collapse navbar-collapse" id="navgator">


      <ul class="nav navbar-nav navbar-right">







      </ul>




    </div>
  </div>



</nav>


    </div><br /><br />

<!-- end column nav-->





<div class='row'>
<br><br><br>


<center><h4>Welcome To Solarians.</h4></center><br>



<!--Start Left-->
<div class='col-sm-0'>



</div>

<!--End Left-->










<!--Start Center-->
<div class='col-sm-12'>








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
<a style='float:right;background:navy;color:white;padding:6px;border:none;' href="https://www.facebook.com/sharer/sharer.php?u=share.php?post_id=<?php echo $title_seo; ?>" target="_blank">
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


