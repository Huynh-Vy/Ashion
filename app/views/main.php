<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'; ?>
</head>
<body>
    <header>
        <?php include 'header.php'; ?>  
    </header>

    <?php if(isset($slider)) {?>
    <section>
        <div class="slider">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <?php 
                        $i = 1;
                        while($row = $slider->fetch_assoc()) { ?>
                        <div class="carousel-item <?=$i == 1 ? 'active' : ''?>">
                            <a href="<?=$row['link']?>" title="<?=$row['title']?>" target="_blank">
                                <img src="<?=$row['thumb']?>" class="d-block w-100" alt="<?=$row['title']?>" style="height:550px">
                            </a>

                            <div class="content">
                                <div class="title"><span><?=$row['title']?></span></div>
                            </div>
                        </div>

                    <?php $i++; } ?>
                </div>

                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <?php } ?>

    <section>
        <div class="container">
            <div class="product">
                <main>
                    <?php include $template.'.php'; ?>
                </main>

                <?php if(!isset($hide_row)) {?>
                <div class="product_hot">
                    <div class="thread">
                        <span>S???n ph???m b??n ch???y</span>
                    </div>
                    <div class="thread_decorate"></div>

                    <div class="product_list_hot">
                        <div class="row">
                            <?php $productSale = Helper::productSale(); ?>
                            <?php while ($row = $productSale->fetch_assoc()) { ?>
                                <div class="col-md-3">
                                    <div class="item">
                                        <?=$row['price_sale'] != 0 ? '<div class="sale-info">Sale</div>' : ''?>
                                        <div class="image">
                                            <a href="/san-pham/<?=$row['id']?>/<?=toSlug($row['name'])?>.html" title="<?=$row['name']?>" target="_blank">
                                                <img src="<?=$row['thumb']?>" alt="<?=$row['name']?>">
                                            </a>
                                        </div>

                                        <div class="info">
                                            <div class="name">
                                                <a href="/san-pham/<?=$row['id']?>/<?=toSlug($row['name'])?>.html" title="<?=$row['name']?>" target="_blank">
                                                    <?=$row['name']?>
                                                </a>
                                            </div>

                                            <div class="price">
                                                <?=Helper::price($row['price'], $row['price_sale'])?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="shop_benefit">
                <div class="row">
                    <div class="col-md-3">
                        <div class="benefit_item">
                            <div class="icon">
                               <i class="fas fa-car"></i>
                            </div>
                            <div class="content">
                                <div class="title">
                                   Giao h??ng mi???n ph??
                                </div>
                                <div class="text">
                                    Cho t???t c??? h??a ????n tr??n 1 tri???u
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="benefit_item">
                            <div class="icon">
                                <span><i class="far fa-money-bill-alt"></i></span>
                            </div>
                            <div class="content">
                                <div class="title">
                                   Cam k???t ho??n ti???n
                                </div>
                                <div class="text">
                                    N???u c?? l?? do h???p l??
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="benefit_item">
                            <div class="icon">
                                <span><i class="fas fa-cog"></i></span>
                            </div>
                            <div class="content">
                                <div class="title">
                                   H??? tr??? 24/7
                                </div>
                                <div class="text">
                                    H??? tr??? th?????ng xuy??n
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="benefit_item">
                            <div class="icon">
                                <span><i class="fas fa-shield-alt"></i></span>
                            </div>
                            <div class="content">
                                <div class="title">
                                   thanh to??n an to??n
                                </div>
                                <div class="text">
                                    b???o ?????m 100% an to??n khi thanh to??n
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="image">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <div class="insta_image">
                            <img src="/public/images/insta-1.jpg" target="" alt="Instagram_1">
                        </div>

                        <div class="insta-info">
                            <div class="insta-icon"><i class="fab fa-instagram"></i></div>
                            <div class="email">@ ashion-shop</div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="insta_image">
                            <img src="/public/images/insta-2.jpg" target="" alt="Instagram_2">
                        </div>

                        <div class="insta-info">
                            <div class="insta-icon"><i class="fab fa-instagram"></i></div>
                            <div class="email">@ ashion-shop</div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="insta_image">
                            <img src="/public/images/insta-3.jpg" target="" alt="Instagram_3">
                        </div>

                        <div class="insta-info">
                            <div class="insta-icon"><i class="fab fa-instagram"></i></div>
                            <div class="email">@ ashion-shop</div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="insta_image">
                            <img src="/public/images/insta-4.jpg" target="" alt="Instagram_4">
                        </div>

                        <div class="insta-info">
                            <div class="insta-icon"><i class="fab fa-instagram"></i></div>
                            <div class="email">@ ashion-shop</div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="insta_image">
                            <img src="/public/images/insta-5.jpg" target="" alt="Instagram_5">
                        </div>

                        <div class="insta-info">
                            <div class="insta-icon"><i class="fab fa-instagram"></i></div>
                            <div class="email">@ ashion-shop</div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="insta_image">
                            <img src="/public/images/insta-6.jpg" target="" alt="Instagram_6">
                        </div>

                        <div class="insta-info">
                            <div class="insta-icon"><i class="fab fa-instagram"></i></div>
                            <div class="email">@ ashion-shop</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
    
        
    
    

    

    <?php include 'footer.php'; ?>
    
</body>
</html>