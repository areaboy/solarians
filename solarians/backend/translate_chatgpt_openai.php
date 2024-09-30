<?php
error_reporting(0);

if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
session_start();
$userid_sess =  htmlentities(htmlentities($_SESSION['uid_s'], ENT_QUOTES, "UTF-8"));


include('settings.php');
include('db_connection.php');

$id = strip_tags($_POST['id']);
$lang = strip_tags($_POST['lang']);



if ($id == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_openai2'>Post Id is empty</div>";
exit();
}

if ($lang == ''){
echo "<div style='background:red;padding:8px;color:white;border:none;' id='alerts_openai2'>Translating Language is empty</div>";
exit();
}



$result = $db->prepare("SELECT * FROM posts_solar WHERE id=:id");
$result->bindValue(':id', trim($id), PDO::PARAM_STR);
//$result->bindValue(':uid', trim($projectid), PDO::PARAM_INT);
$result->execute();

$count_post = $result->rowCount();
$row = $result->fetch();


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



$text_prompt ="translate this text in $lang line by line.  Post Title: $title.Post Description: $content.Post Created by: $fullname.Solar Inverter Capacity: $solar_inverter_capacity (Watts). Solar Battery Type: $battery_type Battery. Solar Battery Capacity:  $battery_capacity (Watts). Solar Panel Capacity: $solar_panel_capacity  (Watts).";

// Start ChatGPT Text Analysis


$url ="https://api.openai.com/v1/chat/completions";
$data_param ='{
    "model": "gpt-4o",
    "messages": [
      {
        "role": "user",
        "content": "'.$text_prompt.'"
      }
    ]
  }';



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $chatgpt_accesstoken"));  
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_param);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$output = curl_exec($ch); 

if($output == ''){
echo "<div id='alerts_openai2' style='background:red;color:white;padding:10px;border:none;'>API Call to Chatgpt AI Failed. Ensure there is an Internet  Connections...</div><br>";
exit();
}

$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// catch error message before closing
if (curl_errno($ch)) {
   //echo $error_msg = curl_error($ch);
}

curl_close($ch);



$json = json_decode($output, true);
$id = $json["id"];

$mx_error = $json["error"]["message"];
if($mx_error != ''){
echo "<div id='alerts_openai2' style='background:red;color:white;padding:10px;border:none;'>Chatgpt API Error Message: $mx_error.</div><br>";
//exit();
}

if($http_status == 400){
echo "<div id='alerts_openai2' style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT request was malformed or missing some required parameters</div><br>";
exit();
}

if($http_status == 429){
echo "<div id='alerts_openai2' style='background:red;color:white;padding:10px;border:none;'>You have hit your OpenAI/ChatGPT assigned rate limit.</div><br>";
exit();
}

if($http_status == 403){
echo "<div id='alerts_openai2' style='background:red;color:white;padding:10px;border:none;'>You have exceeded the allowed number of tokens in your OpenAI/ChatGPT request.</div><br>";
exit();
}

if($http_status == 401){
echo "<div id='alerts_openai2' style='background:red;color:white;padding:10px;border:none;'> OpenAI/ChatGPT API key or token was invalid, expired, or revoked.</div><br>";
exit();
}

if($http_status == 404){
echo "<div id='alerts_openai2' style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT requested resource API Model was not found</div><br>";
exit();
}

if($http_status == 500){
echo "<div id='alerts_openai2' style='background:red;color:white;padding:10px;border:none;'>An issue occurred on the OpenAI/ChatGPT server side</div><br>";
exit();
}

if($http_status == 403){
echo "<div id='alerts_openai2' style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT API key or token lacks the required permissions</div><br>";
exit();
}

if($http_status == 200){
//echo "<div style='background:green;color:white;padding:10px;border:none;'>Chatgpt API Call Successful....</div><br>";

if($id != ''){
echo "<div style='background:green;color:white;padding:10px;border:none;'>Posts Successfully Translated to <b>($lang)</b> by ChatGPT/OpenAI....</div><br>";
$content = $json["choices"][0]["message"]["content"];

echo "<div class='well'> $content </div>";

//$val = str_replace(',', ',<br>', $content);
//$val2 = str_replace('.', '<br>', $content);


}
}

// end ChatGpt Text Analysis


}


?>



