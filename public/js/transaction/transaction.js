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
                url:  global_url + '/transaction/'+id,
                method: 'DELETE',
                data: {
                    _token : token
                },
                dataType : 'json',
                success:function(resp){
                    window.location.href=global_url+'/transaction?&del_suc=1';
                }
            });
        }
    });

    
}

function rp(angka){
    var minus = false;
    if (angka < 0) {
        angka *= -1;
        minus = true;
    }
    var number_string = angka.toString(),
    split           = number_string.split(','),
    sisa            = split[0].length % 3,
    rupiah          = split[0].substr(0, sisa),
    ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return 'Rp. ' + (minus?'- ':'') + rupiah;
}

function get_stock(no){
    var product_id = $('select[name=variant_id'+no+']').val();
    var product_stock_id = $('select[name=product_stock_id'+no+']').val();

    if (product_id != 0) {
        $.ajax({
            type: "GET", 
            url: "/transaction/json_stock/"+product_id+"/"+product_stock_id,
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(response){
                $('select[name=stock_id'+no+']').empty();
                $('select[name=stock_id'+no+']').append("<option value='0'>-Pilih Stok-</option>");
                $.each(response, function(i, stock){
                    var html = "<option value='"+stock['id']+"'>"+stock['stock']+" "+stock['nama_stock']+"</option>";
                    $('select[name=stock_id'+no+']').append(html);
                });

                set_price(no);
            },
            error: function (xhr, ajaxOptions, thrownError) { 
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
            }
        });
    }
}
function get_product_stock(no){
    var product_id = $('select[name=variant_id'+no+']').val();

    if (product_id != 0) {
        $.ajax({
            type: "GET", 
            url: "/transaction/json_product_stock/"+product_id,
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(response){
                $('select[name=product_stock_id'+no+']').empty();
                $('select[name=product_stock_id'+no+']').append("<option value='0'>-Pilih Satuan-</option>");
                $.each(response, function(i, product_stock){
                    var html = "<option value='"+product_stock['id']+"'>"+product_stock['nama_stock']+"</option>";
                    $('select[name=product_stock_id'+no+']').append(html);
                });
            },
            error: function (xhr, ajaxOptions, thrownError) { 
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
            }
        });
    }
}


function set_price(no){
    var stock_id = $('select[name=stock_id'+no+']').val();
    var qty = $('input[name=quantity'+no+']').val();

    if (stock_id != 0) {
        $.ajax({
            type: "GET", 
            url: "/transaction/json_price/"+stock_id,
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(response){
                $('input[name=quantity'+no+']').attr('max', response['stock']);

                $('#price'+no).val(response['price']);

                total = qty * response['price'];

                $('input[name=total'+no+']').val(rp(total));
                $('input[name=hidden_total'+no+']').val(total);

                var grandtotal = 0;
                var count = $('#count').val();
                
                for (var i = 1; i < count; i++) {
                    if ($('input[name=hidden_total'+i+']').length) {
                        grandtotal += parseInt($('input[name=hidden_total'+i+']').val());
                    }
                }

                $('#grandtotal').text(rp(grandtotal));
                $('#total').val(grandtotal);
            },
            error: function (xhr, ajaxOptions, thrownError) { 
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
            }
        });
    }else{
        $('input[name=total'+no+']').val(rp(0));
        $('input[name=hidden_total'+no+']').val(0);

        var grandtotal = 0;
        $('#grandtotal').text(rp(grandtotal));
        $('#total').val(grandtotal);
    }
}

function add_product(){
    var no = $('#count').val();
    
    $.ajax({
        type: "GET", 
        url: "/transaction/json_product/all",
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
            var html = '<tr id="tr'+no+'">'
                        +'<td>'
                            +'<select name="product_id'+no+'" class="form-control" onchange="get_stock('+no+')">'
                                +'<option value="0">-Pilih Produk-</option>';
            $.each(response, function(i, product){
                html += "<option value='"+product['id']+"'>"+product['variant_name']+"</option>";
            });
            html += '</select>'
                        +'</td>'
                        +'<td>'
                            +'<select name="stock_id'+no+'" class="form-control" onchange="set_price('+no+')">'
                                
                            +'</select>'
                        +'</td>'
                        +'<td>'
                            +'<input type="number" class="form-control" disabled id="price'+no+'" value="0">'
                        +'</td>'
                        +'<td>'
                            +'<input type="number" min="0" value="0" name="quantity'+no+'" class="form-control" onchange="set_price('+no+')">'
                        +'</td>'
                        +'<td>'
                            +'<input type="hidden" name="hidden_total'+no+'" value="0">'
                            +'<input type="text" class="form-control" disabled name="total'+no+'" value="0">'
                        +'</td>'
                        +'<td>'
                            +'<a class="btn btn-danger" onclick="remove_product('+no+')"><i class="fa fa-remove"></i></a>'
                        +'</td>'
                    +'</tr>';
            $('#tbody').append(html);

            var next = parseInt(no) + 1;
            $('#count').val(next);
        },
        error: function (xhr, ajaxOptions, thrownError) { 
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
        }
    });
}

function remove_product(no){
    $('#tr'+no).remove();
    var grandtotal = 0;
    var count = $('#count').val();
    
    for (var i = 1; i < count; i++) {
        if ($('input[name=hidden_total'+i+']').length) {
            grandtotal += parseInt($('input[name=hidden_total'+i+']').val());
        }
    }

    $('#grandtotal').text(rp(grandtotal));
    $('#total').val(grandtotal);
}

$(document).ready(function(){
    $('.data-tables').DataTable();
})