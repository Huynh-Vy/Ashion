<form action="/admin/slider/store" method="post" enctype="multipart/form-data">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tiêu Đề Slider *</label>
                    <input type="text" class="form-control" placeholder="Nhập TIêu Đề Slider" name="title" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Link *</label>
                    <input type="text" class="form-control" placeholder="Đường Dẫn Đích" name="link" required>
                </div>
            </div>
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
        <button type="submit" class="btn btn-primary">Thêm Slider</button>
    </div>
</form>
