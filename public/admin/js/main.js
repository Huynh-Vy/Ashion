function deleteRow(id = 0, link = '')
{
    if (confirm('Bạn có muốn xóa hay không?')) {
        $.ajax({
            type : 'POST',
            dataType : 'JSON',
            data : { id },
            url : link,
            success : function (results) {
                if (results.error === false) {
                    $('#remove_' + id).remove();
                }
                alert(results.messages);
            }

        });
    }
   
}