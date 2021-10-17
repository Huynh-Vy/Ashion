<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="logo">
                    <a href="#" title="Ashion logo">
                        <img src="/public/images/logo.png" alt="Ashion logo">
                    </a>
                </div>
            </div>

            <div class="col-md-8">
                <div class="menu">
                    <ul class="root_menu">
                        <li><a href="/" title="" target="_blank">Trang Chủ</a></li>
                        
                        <li>
                            <?php 
                                $allMenu = Helper::getAllMenu();
                                while($row = $allMenu->fetch_assoc()) {
                            ?>
                            <a href="/danh-muc/<?=$row['id']?>/<?=toSlug($row['name'])?>" title="<?=$row['name']?>"
                                    style="margin-right: 15px;" target="_blank"><?=$row['name']?></a>

                            <?php } ?>
                        </li>

                        
                        <li style="margin-left:-7px"><a href="/lien-he.html" title="" target="_blank">Liên Hệ</a></li>
                        <li>
                            <a href="/gio-hang.html" title="" target="_blank">
                                Giỏ Hàng 
                                <?=isset($_SESSION['cart']) ? '<span class="badge badge-light">' . count($_SESSION['cart']) .'</span>' : ''?>
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-2">
                <div class="share">
                    <div class="share-content">
                        <li><a href="https://www.facebook.com/" title="facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com" title="twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="" title="google plus"><i class="fab fa-google-plus-g"></i></a></li>
                        <li><a href="https://youtube.com" title="youtube"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="https://www.instagram.com/" title="instagram"><i class="fab fa-instagram"></i></a></li>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>