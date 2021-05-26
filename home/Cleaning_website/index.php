<?php  
require_once('./config/funtion.php');
require_once('./config/config.php');


if(isset($_GET['url'])){
    $url = $_GET['url'];
}

if(strpos($url,"/") !=false){
    header('location: http://localhost:8091/home/Cleaning_website/');
}

$category = get_data_row("SELECT cmp_background, bgt_type, cmp_active, cmp_name, cmp_rewrite_name FROM categories_multi_parent WHERE cmp_rewrite_name = '$url' AND web_id = $web_id");

$url_slide = explode(",", $category['cmp_background']);
if(empty($category) || $category['cmp_active']==0){
    header('location: http://localhost:8091/home/Cleaning_website/');
}

$post_type = get_data_rows("SELECT * FROM post_type");
$id_category = get_data_row("SELECT cmp_id FROM categories_multi_parent WHERE cmp_rewrite_name = '$url' AND web_id = $web_id");

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
                    if(in_array($id_category['cmp_id'], $arr_cmp_id)){
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
                        $pt_id = $pt['post_type_id'];
                        $post = get_data_rows("SELECT * FROM post WHERE post_type_id = $pt_id");
                        echo ' <div class="row">';        
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
                }
            ?>
        </div>
        <div class="panigation">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="<?php echo $category['cmp_rewrite_name']?>&page=1" >1</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo $category['cmp_rewrite_name']?>&page=3" >...</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo $category['cmp_rewrite_name']?>&page=2" >4</a></li>
                    <li class="page-item"><a class="page-link" href="<?php echo $category['cmp_rewrite_name']?>&page=3" >5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
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