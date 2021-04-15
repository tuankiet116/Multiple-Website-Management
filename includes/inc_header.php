
<div class="head_logo_search">
    <div class="wrap_content">
        <span onclick="show_menu_mobile()" class="cate_mobile">
            <!-- <i class="fa fa-bars" aria-hidden="true"></i> -->
            <img alt="Menu" src="/images/icon_menu.png">
        </span>
        <div class="logo_top">
            <a title="Sim.Vn" href="/"><img alt="Sim.Vn" src="/images/logo_top.png"></a>
        </div>
        <div class="search_top">
            <div class="search_box">
                <form onsubmit="return searchPhone()">
                    <? $keyword = getValue("keyword", "str", "GET", "", 1); ?>
                    <input type="text" id="keyword" name="keyword" autocomplete="off" value="<?=$keyword?>" placeholder="Tìm kiếm sim" onkeypress="validateInputSearch()">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        
        </div>
        <div class="user_info">
            <?
            if($myuser->logged > 0){
                echo '
                    <div class="name_user">' . cut_string2($myuser->use_name,13) . ' <i class="fa fa-caret-down" aria-hidden="true"></i>
                        <div class="box_menu_user">
                            <ul>
                                <li><a href="/account/profile">Tài khoản của tôi</a></li>
                                <li><a href="/account/orders-list">Danh sách đơn mua</a></li>
                                <li><a href="/account/sale-list">Danh sách đơn bán</a></li>
                                <li><a href="/logout">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                ';
            }else{
                echo '<a href="'.LOGIN_URL.'"><p>Đăng nhập/Đăng ký</p></a>';
            }
            ?>
        </div>
        <?
       
        ?>
        
        <div class="clear"></div>
    </div>
</div>
<div class="menu_main">
    <div class="wrap_content">
        <ul class="main_menu">
        <?
        foreach ($arrMenuBar as $id => $info){
            $link = $info['url'];
            ?>
            <li><a href="<?=$link?>" title="<?=$info['name']?>"><?=$info['name']?> &nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                <?
                if(isset($info['child']) && count($info['child']) > 0){
                    $style = "grid-template-columns: auto auto";
                    if(count($info['child']) > 12) $style = "grid-template-columns: auto auto auto; width:500px";
                    ?>
                    <div class="menu_main_lv2">
                        <ul style="<?=$style?>">
                            <?
                            foreach ($info['child'] as $key => $value) {
                                $link_lv2 = $value['url'];
                                echo '<li><a title="' . $value["name"] . '" href="'. $link_lv2 . '">' . $value["name"] . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <?
                }
                ?>
                
            </li>
            <?
        }
        ?>
        </ul>
        <a class="down_app" hre="#"><b>Hotline: <?=$con_hotline?></b></a>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

