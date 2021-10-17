<div class="card-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 10px">ID</th>
                <th>KH</th>
                <th>SDT</th>
                <th>Email</th>
                <th>Địa Chỉ</th>
                <th>Ghi Chú</th>
                <th>Thanh Toán</th>
                <th>Thời Gian</th>
                <th>Status</th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            <?php  if ($customers->num_rows > 0) {
                        while ($row = $customers->fetch_assoc()) { 
            ?>
                        <tr id="remove_<?=$row['id']?>">
                            <td><?=$row['id']?></td>
                            <td><?=$row['name']?></td>
                            <td><a href="tel:<?=$row['phone']?>"><?=$row['phone']?></a></td>
                            <td><a href="mailto:<?=$row['email']?>"><?=$row['email']?></a></td>
                            <td><address><?=$row['address']?></address></td>
                            <td><?=decodeSafe($row['content'])?></td>
                            <td><?=$row['payment'] == 1 ? 'Thanh Toán Khi Nhận Hàng' : 'Chuyển Khoản'; ?></td>
                            <td><?=date("d-m-Y H:i:s", $row['created_int'])?></td>
                            <td><?=$row['is_view'] == 0 ? '<span class="badge bg-success">Mới</span>' : 
                                                            '<span class="badge bg-danger">Đã Xem</span>'?></td>
        
                            <td style="width: 7%">
                                <a href="/admin/cart/view/<?=$row['id']?>"><i class="far fa-eye"></i></a> &nbsp;
                                <a href="#" onclick="deleteRow(<?=$row['id']?>, '/admin/cart/delete')"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>


            <?php }} ?>
        </tbody>
    </table>

    <?=$page?>
</div>