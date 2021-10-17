<form action="/admin/menu/update/<?=$menu['id']?>" method="post">
    <div class="card-body">
        <div class="form-group">
            <label>Tên Danh Mục</label>
            <input type="text" class="form-control" value="<?=$menu['name']?>" name="name" placeholder="Nhập tên danh mục">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description"><?=$menu['description']?></textarea>
        </div>
        
        <div class="form-group">
            <label>Sắp Xếp</label>
            <input type="number" class="form-control" name="sort" value="<?=$menu['sort']?>">
        </div>

        <div class="form-group">
            <label>Kích Hoạt</label>
            <div class="form-check">
                <input id="active_1" class="form-check-input" type="radio" 
                        name="active" value="1" <?=$menu['active'] == 1 ? 'checked' : '' ?>>
                <label for="active_1" class="form-check-label">Có</label>
            </div>

            <div class="form-check">
                <input id="active_2" class="form-check-input" type="radio" 
                        name="active" value="0" <?=$menu['active'] == 0 ? 'checked' : '' ?>>
                <label for="active_2" class="form-check-label">Không</label>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập Nhật Danh Mục</button>
    </div>
</form>