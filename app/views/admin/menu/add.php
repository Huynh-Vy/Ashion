<form action="/admin/menu/store" method="post">
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Tên Danh Mục</label>
            <input type="text" class="form-control" placeholder="Nhập tên danh mục" name="name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <textarea class="form-control" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Sắp xếp</label>
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
        <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
    </div>
</form>
