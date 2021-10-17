<div class="card-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 10px">ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá Gốc</th>
                <th>Giá Giảm</th>
                <th>Hình Ảnh</th>
                <th>Danh Mục</th>
                <th>Trạng Thái</th>
                <th>Cập Nhật</th>
                <th style="width: 100px">Tùy Chỉnh</th>
            </tr>
        </thead>

        <tbody>
            <?php  if ($product->num_rows > 0) {
                        while ($row = $product->fetch_assoc()) { 
            ?>
                        <tr id="remove_<?=$row['id']?>">
                            <td><?=$row['id']?></td>
                            <td><?=$row['name']?></td>
                            <td><?=number_format($row['price'])?></td>
                            <td><?=number_format($row['price_sale'])?></td>
                            <td>
                                <a href="<?=$row['thumb']?>" target="_bank">
                                    <img src="<?=$row['thumb']?>" width="50px" height="50px">
                                </a>
                            </td>
                            <td><?=$row['nameMenu']?></td>
                            <td><?=Helper::statusActive($row['active'])?></td>
                            <td><?=$row['updated_at']?></td>
                            <td>
                                <a href="/admin/product/edit/<?=$row['id']?>"><i class="far fa-edit"></i></a> &nbsp;
                                <a href="#" onclick="deleteRow(<?=$row['id']?>, '/admin/product/delete')"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>


            <?php }} ?>
        </tbody>
    </table>

    <?=$page?>
</div>