<section class="cart_info">
    <div class="product_new">
        <div class="thread">
            <span><?=$title?></span>
        </div>
        <div class="thread_decorate"></div>

        <?php if($products !== false) {?>
        <form action="/cap-nhat-don-hang.html" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sản Phẩm</th>
                        <th scope="col">Hình Ảnh</th>
                        <th scope="col">Đơn Giá</th>    
                        <th scope="col" style="width: 13%">Số Lượng</th>
                        <th scope="col">Thành Tiền</th>
                        <th scope="col">Chỉnh sửa đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1 ;
                    $sumAll = 0;
                    while ($row = $products->fetch_assoc()) { 
                        $price = $row['price_sale'] > 0 ? (int) $row['price_sale'] : (int) $row['price'];
                        $qty = intval($_SESSION['cart'][$row['id']]['qty']);
                        $sum = $price * $qty;
                        $sumAll += $sum;
                    ?>
                        <tr>
                            <td><?=$i?></td>
                            <td>
                                <h3><?=$row['name']?></h3>
                            </td>
                            <td>
                                <img src="<?=$row['thumb']?>" style="width: 80px; height: 100px">
                            </td>
                            <td>
                                <?=number_format($price)?><sup>đ</sup>
                            </td>
                            <td><input type="number" class="input_qty" value="<?=$qty?>" 
                                        style="width: 59%; border: 1px solid #dfd9d9;" name="cart[<?=$row['id']?>]"></td>
                            <td><?=number_format($sum)?><sup>đ</sup></td>
                            <td>
                                <a href="/xoa-gio-hang.html?id=<?=$row['id']?>" title="Xóa giỏ hàng" target="">Xóa</a>
                            </td>
                        </tr>
                    <?php $i++;} ?>
                        <tr>
                            <td colspan="5" style="text-align: right; padding-right: 37px"><strong >Thành Tiền</strong></td>
                            <td colspan="2" style="color: #e60808"><strong><?=number_format($sumAll)?></strong><sup>đ</sup></td>
                        </tr>
                </tbody>
            </table>

            <div class="button-group">
                <a href="/" class="btn btn-primary">Tiếp Tục Mua Hàng</a>
                <button type="submit" class="btn btn-danger">Cập Nhật Đơn Hàng</button>
                <a href="/dat-hang.html" class="btn btn-success">Đặt Hàng</a>
            </div>
        </form>
                    
        <?php } else {
            echo '<h4>Chưa có sản phẩm nào trong giỏ hàng</h4>';
        }?>
    </div>
</section>