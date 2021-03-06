function doDelete(id){

    Swal.fire({
        title: 'Nonaktifkan Sales?',
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
                url:  global_url + '/sales/'+id,
                method: 'DELETE',
                data: {
                    _token : token
                },
                dataType : 'json',
                success:function(resp){
                    window.location.href=global_url+'/sales?&del_suc=1';
                }
            });
        }
    });

    
}

$(document).ready(function(){
    $('.data-tables').DataTable();
})

function change_ktp(src){
    $('#ktpimg').attr('src', 'ktp/'+src);
}