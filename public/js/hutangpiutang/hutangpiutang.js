function doDelete(id){

    Swal.fire({
        title: 'Hapus Hutang/Piutang?',
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
                url:  global_url + '/hutangpiutang/'+id,
                method: 'DELETE',
                data: {
                    _token : token
                },
                dataType : 'json',
                success:function(resp){
                    window.location.href=global_url+'/hutangpiutang?&del_suc=1';
                }
            });
        }
    });

    
}

function setType(){
    var type = $('#type').val();
    if (type == "Hutang") {
        $('#category').slideDown(250);
    }else{
        $('#category').slideUp(250);
    }
}

$(document).ready(function(){
    $('.data-tables').DataTable();
    setType();
})