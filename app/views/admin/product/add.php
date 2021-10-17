<form action="/admin/product/store" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên Sản Phẩm *</label>
                    <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="name" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Danh Mục</label>
                    <select name="menu_id" class="form-control">

                    <?php if ($menu->num_rows > 0) {
                        while ($row = $menu->fetch_assoc()) { ?>

                        <option value="<?=$row['id']?>"><?=$row['name']?></option>
                    <?php } }?>
                    </select>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Giá Gốc</label>
                    <input type="number" class="form-control" name="price" value="0">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Giá Giảm</label>
                    <input type="number" class="form-control" name="price_sale" value="0">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description"></textarea>
        </div>

        <div class="form-group">
            <label>Chi Tiết Sản Phẩm</label>
            <textarea class="form-control" name="content" id="content"></textarea>
        </div>

        <div class="form-group">
            <label>File Ảnh Đại Diện *</label>
            <input type="file" class="form-control" name="file" accept="image/*" required>
        </div>

        <div class="form-group">
            <label>Sắp xếp</label>
            <input type="number" class="form-control" name="sort" value="1">
        </div>

        <div class="form-group">
            <label>Kích Hoạt</label>
            <div class="form-check">
                <input id="active_1" class="form-check-input" type="radio" name="active" value="1" checked>
                <label for="active_1" class="form-check-label">Có</label>
            </div>
            <div class="form-check">
                <input id="active_2" class="form-check-input" type="radio" name="active" value="0">
                <label for="active_2" class="form-check-label">Không</label>
            </div>
        </div>
    
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
    </div>
</form>

<script>CKEDITOR.replace( 'content' );</script>