<article class="detail">
    <div class="row">
        <div class="col-md-4">
            <div class="image">
                <img src="<?=$products['thumb']?>" alt="<?=$products['name']?>">
            </div>
        </div>

        <div class="col-md-8">
            <div class="content">
                <h1><?=$products['name']?></h1>

                <div class="price">
                    <strong>Giá: </strong><?=Helper::price($products['price'], $products['price_sale'])?>
                </div>

                <div class="description">
                    <p><?=$products['description']?></p>
                </div>

                <div class="content">
                    <p class="title">Thông tin sản phẩm:</p>
                    <p><?=decodeSafe($products['content'])?></p>
                </div>
            </div>   
        </div>

        <form action="/gio-hang.html" method="get">
            <div class="cart">
                <div class="row">
                    <div class="col-md-4">
                        <div class="cart_number">
                            <input type="number" name="qty" value="1">
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="id" value="<?=$products['id']?>">
                    <div class="col-md-8">
                        <div class="order" >
                            <input type="submit" class="btn btn-danger" name="order" value="Đặt Hàng">
                        </div>
                    </div> 
                </div>
            </div>
        </form> 
    </div>
</article>

