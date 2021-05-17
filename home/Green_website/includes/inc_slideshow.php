<?php
require_once('../../classes/database.php');
$web_id = 'web_id = 2';

// $slide = "SELECT * "
$arr_slide = array();
$sql = "SELECT * FROM categories_multi_parent WHERE bgt_type = 'slide' AND $web_id";
$result = new db_query($sql);
if (mysqli_num_rows($result->result)) {
    while ($row = mysqli_fetch_assoc($result->result)) {
        array_push($arr_slide, $row);
    }
}
unset($result, $sql);
?>

<div class="content">
    <div class="container-fluid">
        <div class="owl-carousel owl-1">
            <?php
                foreach ($arr_slide as $key => $slide) {
                    if ($slide['cmp_active'] == 1) {
                        echo '
                            <div>
                                <img src="' . $slide['cmp_background'] . '" alt="Carousel background" class="img-fluid">
                            </div>
                        ';
                    } 
                }
            ?>
        </div>
    </div>
</div>