<?php  
require_once('./config/funtion.php');
require_once('./config/config.php');

if(isset($_GET['url'])){
    $url_rough=$_GET['url'];
    $url = preg_replace('/[^A-Za-z0-9\-]/','', $url_rough);
}

if(strpos($url,"/") !=false){
    $url = 'trang-chu';
    header('location: ../');
}

$category = get_data_row("SELECT cmp_background, bgt_type, cmp_active, cmp_name, cmp_rewrite_name, cmp_id, post_type_id FROM categories_multi_parent WHERE cmp_rewrite_name = '$url' AND web_id = $web_id");
$arr_post_type_id =explode(",",  $category['post_type_id']);
$handle_post_type_id = implode("','", $arr_post_type_id);

$url_slide = explode(",", $category['cmp_background']);

if(empty($category) || $category['cmp_active']==0){
    header('location: 404.php');
}

$post_type = get_data_rows("SELECT * FROM post_type WHERE post_type_id IN ('".$handle_post_type_id."')");


$info_support = get_data_row("SELECT con_admin_email, con_hotline, con_link_fb, con_link_insta, con_link_twitter
                              FROM configuration WHERE web_id = $web_id");
?>
<!DOCTYPE html>
<html>

<head>
    <title> 
        <?php 
            if($category['cmp_name']=='trang chủ'){
                echo 'Dịch vụ vệ sinh';
            }
            else {
                echo 'Dịch vụ vệ sinh - '. $category['cmp_name'];
            }
        ?> 
    </title>
    <? include("./includes/inc_head.php"); ?>
</head>

<body>
    <!--------------- HEADER --------------->
    <? include("./includes/inc_header.php"); ?>

    <!--------------- CONTENT --------------->
    <div class="slide-container" style="padding-top: 20px;">
        <?php if($category['bgt_type']=='slide'){?>
            <div class="slider-slick home-slide">
                <?php  foreach($url_slide as $key=>$url){?>
                    <div class="slick-item">
                        <img src="../../data/web_1/<?php echo $url?>" alt="slide image"> 
                    </div>
                <?php }?>
            </div>
        <?php } else if($category['bgt_type']=='static'){?>
            <div class="slide-static">
                <div class="slide-static-item">
                    <img src="../../data/web_1/<?php echo $url_slide[0]?>" alt="slide image" style="width: 100%  ">
                </div>
            </div>
        <?php }?>
    </div>

    <div class="main-container">
        <div class="container">
            <?php foreach($post_type as $pt){?>
                <?php if($pt['post_type_show']==1 && $pt['post_type_active']==1){?>
                    <?php 
                        $pt_id = $pt['post_type_id'];
                        $post=get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id");
                    ?>
                    <div class="service-title">
                        <p style="margin: 0">
                            <?php echo $pt['post_type_title']?>
                        </p>
                    </div>
    
                    <div class="cleaning-title">
                        <p style="margin: 0">
                            <?php echo $pt['post_type_description']?>
                        </p>
                    </div>
                    <div class="row">
                    <?php foreach($post as $p){?>
                        <div class="col-lg-4 col-md-6">
                            <div class="service-container">
                                <a href="detail.php?name=<?php echo $p['post_rewrite_name']?>&title=<?php echo $p['post_title']?>&breadcrumbs=<?php echo $category['cmp_rewrite_name']?>&nameBreadcrumbs=<?php echo $category['cmp_name']?>" target="_self">
                                    <div class="service-card">
                                        <div class="service-front">
                                            <img src="../../data/web_1/<?php echo $p['post_image_background']?>" alt="carpet cleaning">
                                        </div>
                                        <div class="service-back">
                                            <div><?php echo $p['post_description']?></div>
                                        </div>
                                    </div>
        
                                    <div class="service-name">
                                        <?php echo $p['post_title']?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php }?>
                    </div>
                <?php } else{?>
                    <?php 
                        $pt_id = $pt['post_type_id'];
                        $post=get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id");
                    ?>
                    <div id="post">
                        <div class="container">
                            <div class="row">
                                <div class="left-post col-lg-9">
                                    <ul id="breadcrumbs" class="breadcrumbs">
                                        <li class="item-home">
                                            <a href="http://localhost:8091/home/Cleaning_website/" target="_self">Trang chủ</a>
                                        </li>
                                        <li class="separator"> » </li>
                                        <li class="item-cat">
                                            <p><?php echo $category['cmp_name']?></p>
                                        </li>
                                    </ul>
                                    <div class="post-container">
                                        <div class="post-title"><?php echo  $pt['post_type_title']?></div>
                                        <div class="post-content">
                                            <?php foreach($post as $p){?>
                                            <?php 
                                                $date = explode(" ", $p['post_datetime_create']);
                                                $strtotime = strtotime($date[0]);
                                                $dateFormat = date("Y/m/d", $strtotime);    
                                            ?>
                                            <div class="post-item">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                        <div class="post-item-img">
                                                            <a href="detail.php?name=<?php echo $p['post_rewrite_name']?>&title=<?php echo $p['post_title']?>&breadcrumbs=<?php echo $category['cmp_rewrite_name']?>&nameBreadcrumbs=<?php echo $category['cmp_name']?>" target="_self">
                                                                <img src="../../data/image/images/Web-1/window-washing.jpg" alt="post image">
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-8 col-md-8 col-sm-12 col-12" style="padding: 0">
                                                        <div class="post-item-content">
                                                            <a href="detail.php?name=<?php echo $p['post_rewrite_name']?>&title=<?php echo $p['post_title']?>&breadcrumbs=<?php echo $category['cmp_rewrite_name']?>&nameBreadcrumbs=<?php echo $category['cmp_name']?>" target="_self">
                                                                <div class="post-item-title">
                                                                    <?php echo $p['post_title']?>
                                                                </div>
                                                            </a>

                                                            <div class="post-item-date"> <?php echo $dateFormat?> </div>

                                                            <div class="post-item-text">
                                                                <p>
                                                                    <?php echo $p['post_description']?>
                                                                </p>
                                                            </div>

                                                            <div class="post-item-more">
                                                                <a href="detail.php?name=<?php echo $p['post_rewrite_name']?>&title=<?php echo $p['post_title']?>&breadcrumbs=<?php echo $category['cmp_rewrite_name']?>&nameBreadcrumbs=<?php echo $category['cmp_name']?>" target="_self">
                                                                    Xem chi tiết
                                                                    <i class="fas fa-chevron-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="right-post col-lg-3">
                                    <div class="right-post-container">
                                        <div class="right-post-title">
                                            Hỗ trợ trực tuyến
                                        </div>
                                        <div class="right-post-support">
                                            <div class="right-post-logo">
                                                <img src="../../data/image/images/Web-1/hotline2-new.png" alt="hotline logo">
                                            </div>
                                            <div class="right-post-contact">
                                                <i class="fas fa-phone-alt"></i>
                                                <?php echo $info_support['con_hotline']?>
                                            </div>
                                            <div class="right-post-contact">
                                                <i class="far fa-envelope"></i>
                                                <?php echo $info_support['con_admin_email']?>
                                            </div>
                                            <div class="right-post-media">
                                                <a href="<?php echo $info_support['con_link_fb']?>" target="_self">
                                                    <i class="fab fa-facebook fb-icon"></i>
                                                </a>
                                                <a href="<?php echo $info_support['con_link_twitter']?>" target="_self">
                                                    <i class="fab fa-twitter tw-icon"></i>
                                                </a>
                                                <a href="<?php echo $info_support['con_link_insta']?>" target="_self">
                                                    <i class="fab fa-instagram ins-icon"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-post-container">
                                        <div class="right-post-title">
                                            Facebook fanpage
                                        </div>

                                        <div class="right-post-fanpage">
                                            <!-- <p style="font-size: 15px;">Chèn fanpage facebook vào đây</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
        </div>
        
    </div>

    <!--------------- FOOT --------------->

    <? include("./includes/inc_footer.php") ?>
    
    <div id="scroll-top">
        <i class="fas fa-chevron-up"></i>
    </div>
    <div  id="contact">
        <div id="phone">
            <i class="fas fa-phone-alt"></i>
        </div>
        <a id="number" href="tel:<?php echo str_replace(".", "", $info_footer['con_hotline'])?>"> <?php echo $info_footer['con_hotline']?> </a>
    </div>
    
    <? include("./includes/inc_foot.php"); ?>

</body>

</html>