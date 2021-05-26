<?php  
require_once('./helper/function.php');

$web_id = 1;
$url = 'trang-chu';

if(isset($_GET['url'])){
    $url = $_GET['url'];
}

if(isset($_GET['page'])){
    echo '<h1>'.$_GET['page'].'</h1>';
}

if(strpos($url,"/") !=false){
    header('location: http://localhost:8091/home/Cleaning_website/');
}

$category = get_data_row("SELECT cmp_background, bgt_type, cmp_active, cmp_name, cmp_rewrite_name, cmp_id FROM categories_multi_parent WHERE cmp_rewrite_name = '$url' AND web_id = $web_id");

$url_slide = explode(",", $category['cmp_background']);
if(empty($category) || $category['cmp_active']==0){
    header('location: http://localhost:8091/home/Cleaning_website/');
}

$post_type = get_data_rows("SELECT * FROM post_type");
// $post = get_data_rows("SELECT * FROM post, post_type WHERE post.post_type_id = post_type.post_type_id");  

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
            <?php 
                foreach($post_type as $pt){
                    $arr_cmp_id = explode(",", $pt['cmp_id']);
                    if(in_array($category['cmp_id'], $arr_cmp_id)){
                        $pt_id = $pt['post_type_id'];
                        $post = get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id");
                        if($pt['post_type_show'] ==1){
                            echo '
                                <div class="service-title">
                                    <p style="margin: 0">
                                        '.$pt['post_type_title'].'
                                    </p>
                                </div>
                
                                <div class="cleaning-title">
                                    <p style="margin: 0">
                                        '.$pt['post_type_description'].'
                                    </p>
                                </div>
                            ';
                        
                            echo '<div class="row">';        
                                foreach($post as $p){
                                    echo '
                                        <div class="col-lg-4 col-md-6">
                                            <div class="service-container">
                                                <a href="detail.php?name='.$p['post_rewrite_name'].'&title='.$p['post_title'].'&breadcrumbs='.$category['cmp_rewrite_name'].'&nameBreadcrumbs='.$category['cmp_name'].'" target="_self">
                                                    <div class="service-card">
                                                        <div class="service-front">
                                                            <img src="../../data/web_1/'.$p['post_image_background'].'" alt="carpet cleaning">
                                                        </div>
                                                        <div class="service-back">
                                                            <div>'.$p['post_description'].'</div>
                                                        </div>
                                                    </div>
                        
                                                    <div class="service-name">
                                                        '.$p['post_title'].'
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    ';
                                }
                            echo '</div>';
                        }
                        else {
                            
                            
                            echo'<div id="post">';
                            echo'   <div class="row">';
                            echo'       <div class="left-post col-lg-9">
                                            <ul id="breadcrumbs" class="breadcrumbs">
                                                <li class="item-home">
                                                    <a href="#" target="_self">Trang chủ</a>
                                                </li>
                                                <li class="separator"> » </li>
                                                <li class="item-cat">
                                                    <a href="#" target="_self">Dịch vụ giặt là công nghiệp</a>
                                                </li>
                                                <li class="separator"> » </li>
                                                <li class="item-current">
                                                    <a href="#" target="_self">Dịch vụ giặt thảm gia đình</a>
                                                </li>
                                            </ul>
                                            <div class="post-container">
                                                <div class="post-title">'.$pt['post_type_title'].'</div>
                                                <div class="post-content">
                            ';
                                                foreach($post as $p){
                                                    $date1 = $p['post_datetime_create'];
                                                    $date = date_format($date1, "Y/m/d");
                                                    echo'
                                                        <div class="post-item">
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                                                    <div class="post-item-img">
                                                                        <a href="" target="_self">
                                                                            <img src="../../data/image/images/Web-1/'.$p['post_image_background'].'" alt="post image">
                                                                        </a>
                                                                    </div>
                                                                </div>
                            
                                                                <div class="col-lg-8 col-md-8 col-sm-12 col-12" style="padding: 0">
                                                                    <div class="post-item-content">
                                                                        <a href="" target="_self">
                                                                            <div class="post-item-title">
                                                                                '.$p['post_title'].'
                                                                            </div>
                                                                        </a>
                            
                                                                        <div class="post-item-date"> '.$date.' </div>
                            
                                                                        <div class="post-item-text">
                                                                            <p>
                                                                                '.$p['post_description'].'
                                                                            </p>
                                                                        </div>
                            
                                                                        <div class="post-item-more">
                                                                            <a href="" target="_self">
                                                                                Xem chi tiết
                                                                                <i class="fas fa-chevron-right"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    ';
                                                }
                            echo'               </div>
                                            </div>
                                        </div>';
                            echo'   </div>';        
                            echo'</div>';
                        }

                    } 
                }
            ?>
        </div>
        <!-- <div class="panigation">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="<?php echo $category['cmp_rewrite_name']?>&page=1">1</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo $category['cmp_rewrite_name']?>&page=2">2</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo $category['cmp_rewrite_name']?>&page=3">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div> -->
    </div>

    <!--------------- FOOT --------------->

    <? include("./includes/inc_footer.php") ?>
    

    <div id="contact">
        <div id="phone">
            <i class="fas fa-phone-alt"></i>
        </div>

        <div id="number"> <?php echo $info_footer['con_hotline']?> </div>
    </div>
    
    <? include("./includes/inc_foot.php"); ?>

</body>

</html>