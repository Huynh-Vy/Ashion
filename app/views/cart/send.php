<section class="cart_send">
    <div class="product_new">
        <div class="thread">
            <span><?=$title?></span>
        </div>
        <div class="thread_decorate"></div>

        <?php 
            include _VIEW. '/admin/errors.php'; 
        ?>
        <form action="/dat-hang.html" method="post">
            <div class="row">
                <div class="col-md-5">
                    <div class="mb-3">
                        <label class="form-label">Tên Khách Hàng <sup>*</sup></label>
                        <input type="text" class="form-control" name="name" placeholder="Vui Lòng Nhập Tên Anh/Chị" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số Điện Thoại <sup>*</sup></label>
                        <input type="number" class="form-control" name="phone" placeholder="Vui Lòng Nhập Số Điện Thoại" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Vui Lòng Nhập Email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa Chỉ Giao Hàng <sup>*</sup></label>
                        <input type="text" class="form-control" name="address" placeholder="Vui Lòng Nhập Địa Chỉ" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ghi Chú (Tùy Chọn)</label>
                        <textarea name="content" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <small><sup>(*)</sup> không được bỏ trống</small>
                    </div>
                </div>

                <div class="col-md-7">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sản Phẩm</th>
                                    <th scope="col">Hình Ảnh</th>
                                    <th scope="col">Đơn Giá</th>    
                                    <th scope="col" style="width: 20%">Số Lượng</th>
                                    <th scope="col">Tổng Tiền</th>
                                    <th scope="col">&nbsp;</th>
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
                                                    style="width: 82%; border: 1px solid #dfd9d9;" name="cart[<?=$row['id']?>]"></td>
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

                        <div class="payment">
                            <h4>Hình Thức Thanh Toán</h4>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="pay1" value="1" checked>
                                <label class="form-check-label" for="pay1">
                                    Thanh Toán Bằng Tiền Mặt
                                </label>
                                <div class="content-pay content-pay-one">
                                    <p>Giao hàng tận nơi, thanh toán khi nhận hàng</p>
                                    <p>Miễn phí vận chuyển trên toàn quốc</p>
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="pay2" value="2">
                                <label class="form-check-label" for="pay2">
                                    Chuyển Khoản Ngân Hàng
                                </label>
                                <div class="content-pay content-pay-two d-none">
                                    <p>Miễn phí vận chuyển trên toàn quốc</p>
                                    <p>Thực hiện thanh toán vào tài khoản của ngân hàng chúng tôi. Vui lòng
                                        sử dụng Mã đơn hàng của bạn trong phần Nội Dung Thanh Toán. Đơn
                                        hàng sẽ được giao khi tiền đã chuyển
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="button-group mt-4">
                            <button type="submit" class="btn btn-success">Đặt Hàng Ngay</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>