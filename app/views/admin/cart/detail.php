<div class="card-body">
    <div class="customer">
        <h3>Thông Tin Khách Hàng</h3>

        <ul>
            <li><strong>Khách Hàng: </strong><?=$customer['name']?></li>
            <li><strong>Điện Thoại: </strong><a href="tel:<?=$customer['phone']?>"><?=$customer['phone']?></a></li>
            <li><strong>Email: </strong><a href="mailto:<?=$customer['email']?>"><?=$customer['email']?></a></li>
            <li><strong>Địa Chỉ: </strong><?=$customer['address']?></li>
            <li><strong>Ghi Chú: </strong><?=decodeSafe($customer['content'])?></li>
            <li><strong>Thanh Toán: </strong><?=$customer['payment'] == 1 ? 'Thanh Toán Bằng Tiền Mặt' : 
                                                'Chuyển Khoản'; ?></li>
        </ul>

        <h3>Danh Sách Sản Phẩm</h3>

        <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sản Phẩm</th>
                        <th scope="col">Hình Ảnh</th>
                        <th scope="col">Đơn Giá</th>    
                        <th scope="col">Số Lượng</th>
                        <th scope="col">Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1 ;
                    $sumAll = 0;
                    while ($row = $products->fetch_assoc()) { 
                        $sum = $row['unit_price'] * $row['qty'];
                        $sumAll += $sum;
                    ?>
                        <tr>
                            <td><?=$i?></td>
                            <td class="box-info">
                                <h6><?=$row['product_name']?></h6>
                            </td>
                            <td>
                                <img src="<?=$row['thumb']?>" alt="" style="width: 60px; height: 70px">
                            </td>
                            <td>
                                <?=number_format($row['unit_price'])?><sup>đ</sup>
                            </td>
                            <td><?=$row['qty']?></td>
                            <td><?=number_format($sum)?><sup>đ</sup></td>
                        </tr>
                    <?php $i++;} ?>
                        <tr>
                            <td colspan="5" style="padding-left: 819px; font-weight: bold">Tổng Tiền</td>
                            <td colspan="2" style="font-weight: bold; color: red"><?=number_format($sumAll)?><sup>đ</sup></td>
                        </tr>
                </tbody>
            </table>
    </div>
</div>