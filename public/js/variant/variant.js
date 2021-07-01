function doDelete(id){

    Swal.fire({
        title: 'Yakin?',
        text: "Data yang terhapus tidak dapat di restore",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:  global_url + '/variant/'+id,
                method: 'DELETE',
                data: {
                    _token : token
                },
                dataType : 'json',
                success:function(resp){
                    window.location.href=global_url+'/variant?&del_suc=1';
                }
            });
        }
    });
    
}

$(document).ready(function(){
    $('.data-tables').DataTable();
})