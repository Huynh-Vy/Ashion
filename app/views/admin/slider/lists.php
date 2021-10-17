<div class="card-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 10px">ID</th>
                <th>Tiêu Đề</th>
                <th>Đường Dẫn</th>
                <th>Hình Ảnh</th>
                <th>Trạng Thái</th>
                <th style="width: 100px">Tùy Chỉnh</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($slider->num_rows > 0) {
                while ($row = $slider->fetch_assoc()) { 
            ?>
                        <tr id="remove_<?=$row['id']?>">
                            <td><?=$row['id']?></td>
                            <td><?=$row['title']?></td>
                            <td>
                                <a href="<?=$row['thumb']?>" target="_bank">
                                    <img src="<?=$row['thumb']?>" width="100px" height="50px">
                                </a>
                            </td>
                            <td><?=$row['sort']?></td>
                            <td><?=Helper::statusActive($row['active'])?></td>
                            <td>
                                <a href="/admin/slider/edit/<?=$row['id']?>"><i class="far fa-edit"></i></a> &nbsp;
                                <a href="#" onclick="deleteRow(<?=$row['id']?>, '/admin/slider/delete')"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>


            <?php }} ?>
        </tbody>
    </table>
    
</div>