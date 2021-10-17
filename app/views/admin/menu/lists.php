<div class="card-body p-0">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Tên Danh Mục</th>
                <th>Mô tả</th>
                <th>Sắp xếp</th>
                <th>Trạng Thái</th>
                <th>Cập Nhật</th>
                <th style="width: 110px">Tùy Chỉnh</th>
            </tr>
        </thead>

        <tbody>

            <?php 
                if ($menu->num_rows > 0) {
                    while ($row = $menu->fetch_assoc()) {
            ?>
                    <tr id="remove_<?=$row['id']?>">
                        <td><?=$row['id']?></td>
                        <td><?=$row['name']?></td>
                        <td><?=$row['description']?></td>
                        <td><?=$row['sort']?></td>
                        <td><?=Helper::statusActive($row['active'])?></td>
                        <td><?=$row['updated_at']?></td>
                        <td>
                            <a href="/admin/menu/edit/<?=$row['id']?>"><i class="far fa-edit"></i></a> &nbsp;
                            <a href="#" onclick="deleteRow(<?=$row['id']?>, '/admin/menu/delete')"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
            <?php }}?>

        </tbody>
    </table>

    <?=$page?>
</div>