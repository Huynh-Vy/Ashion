<form action="/admin/product/update/<?=$product['id']?>" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên Sản Phẩm *</label>
                    <input type="text" value="<?=decodeSafe($product['name'])?>" class="form-control" name="name" placeholder="Nhập tên sản phẩm" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Danh Mục</label>
                    <select name="menu_id" class="form-control">
                    
                    <?php if ($menu->num_rows > 0) {
                        while ($row = $menu->fetch_assoc()) { ?>

                        <option value="<?=$row['id']?>" 
                            <?=$product['menu_id'] == $row['id'] ? 'selected' :'' ?>>
                            <?=$row['name']?>
                        </option>

                    <?php  } } ?>

                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Giá Gốc</label>
                    <input type="number" class="form-control" name="price" value="<?=$product['price']?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Giá Giảm</label>
                    <input type="number" class="form-control" name="price_sale" value="<?=$product['price_sale']?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description"><?=decodeSafe($product['description'])?></textarea>
        </div>
        
        <div class="form-group">
            <label>Chi Tiết Sản Phẩm</label>
            <textarea class="form-control" name="content" id="content"><?=decodeSafe($product['content'])?></textarea>
        </div>

        <div class="form-group">
            <label>File Ảnh Đại Diện *</label>
            <input type="file" class="form-control" name="file" accept="image/*">
            <p>
                <a href="<?=$product['thumb']?>" target="_blank">
                    <img src="<?=$product['thumb']?>" width="50px" height="50px">
                </a>
            </p>
        </div>

        <div class="form-group">
            <label>Sắp Xếp</label>
            <input type="number" class="form-control" name="sort" value="<?=$product['sort']?>">
        </div>

        <div class="form-group">
            <label>Kích Hoạt</label>
            <div class="form-check">
                <input id="active_1" class="form-check-input" type="radio" name="active" 
                    value="1" <?=$product['active'] == 1 ? 'checked' : '' ?>>
                <label for="active_1" class="form-check-label">Có</label>
            </div>

            <div class="form-check">
                <input id="active_2" class="form-check-input" type="radio" name="active" 
                    value="0" <?=$product['active'] == 0 ? 'checked' : '' ?>>
                <label for="active_2" class="form-check-label">Không</label>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
    </div>
</form>

<script>CKEDITOR.replace('content');</script>