<!DOCTYPE html>
<html lang="fa">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mohammad Zeinali Sichani - ساخت جستجوی پیشرفته AJAX با PHP و Javascript</title>
    <style>
    body {
        text-align: center;
        overflow-x: hidden;
    }
 
    #introduce {
        color: white;
        text-decoration: none;
        font-weight: bold;
        display: block;
        width: 100%;
        padding: 5px 10px;
        background-color: #4CAF50;
        text-align: center;
        font-size: 25px;
        margin-bottom: 45px;
    }
 
    .container{
        width: 70%;
        margin: 15px auto;
        direction: rtl;
    }
 
    article {
    width: 25%;
    border: 2px solid skyblue;
    padding: 10px;
    float: right;
    margin-left: 15px;
    }
 
    article img {
    width: 200px;
    }
 
    article h2{
        height: 82px;
    }
 
    article p{
        height: 56px;
        overflow: hidden;
    }
 
    article a {
    text-decoration: none;
    font-weight: bold;
    background-color: #FF9800;
    color: white;
    width: 100%;
    padding: 10px 0;
    display: block;
    }
 
    .like-wrapper .like-shape{
        background-size: 25px;
        background-repeat: no-repeat;
        width: 25px;
        height: 25px;
        display: inline-block;
        vertical-align: middle;
        cursor: pointer;
        background-image: url("img/heart-empty.png");
        transition: all 0.3s;
    }
     
    .like-wrapper .like-shape:active{
        transform: scale(2.5);
    }
 
    .like-wrapper .like-shape.full{
        background-image: url("img/heart-full.png");
    }
 
 
    </style>
</head>
 
<body>
    <a id="introduce" target="_blank" href="https://mohammadzeinali.com">فروشگاه تخصصی موبایل</a>
 
    <div class="container">
 
<?php 
 
require_once "posts.php";
 
$posts = get_posts();
 
?>
 
 
<?php
 
foreach ($posts as $row):
 
?>
    <article>
        <img src="<?php echo $row['thumbnail'] ?>" alt="<?php echo $row['title'] ?>">
 
        <h2><?php echo $row['title'] ?></h2>
 
        <p><?php echo $row['content'] ?></p>
         
        <?php
         
        $full_heart_html = "";
         
        if(@$_COOKIE['posts_like_list']){
            if(!is_array($_COOKIE['posts_like_list'])) $_COOKIE['posts_like_list'] = json_decode($_COOKIE['posts_like_list'] , true);
             
             
             
            if(in_array($row['id'] , $_COOKIE['posts_like_list'])){
                $full_heart_html = "full";
            }
        }
         
         
        ?>
 
 
        <div class="like-wrapper">
            <span id="like-number"><?php echo $row['post_like'] ?></span>
            <span class="like-shape <?php echo $full_heart_html ?>" id="post_like_<?php echo $row['id'] ?>" data-post-id="<?php echo $row['id'] ?>"></span>
        </div><br>
 
 
        <a href="<?php echo $row['link'] ?>" target="_blank">ادامه مطلب</a>
 
    </article>
 
<?php endforeach;?>
    </div>
 
    <script src="app.js"></script>
</body>
</html>