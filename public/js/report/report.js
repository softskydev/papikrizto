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

function set_laba_kotor(id){
    var penjualan = parseInt($('#penjualan'+id).val());
    var pendapatanlain = parseInt($('#pendapatanlain'+id).val());

    var labakotor = penjualan + pendapatanlain;
    $('#labakotor'+id).text(rp(labakotor));
    $('#labakotor_input'+id).val(labakotor);

    set_laba_sebelum_tax(id);
}
function set_laba_sebelum_tax(id){
    var biaya = parseInt($('#biaya'+id).val());
    var labakotor = parseInt($('#labakotor_input'+id).val());

    var labasebelumtax = labakotor - biaya;
    $('#labasebelumtax'+id).text(rp(labasebelumtax));
    $('#labasebelumtax_input'+id).val(labasebelumtax);

    set_laba_bersih(id);
}
function set_laba_bersih(id){
    var labasebelumtax = parseInt($('#labasebelumtax_input'+id).val());
    var interest = parseInt($('#interest'+id).val());
    var tax = parseInt($('#tax'+id).val());

    var lababersih = labasebelumtax - (interest + tax);
    $('#lababersih'+id).text(rp(lababersih));
    $('#lababersih_input'+id).val(lababersih);   
}

$(document).ready(function(){
    if ($("#date-range").length)
        $('#date-range').datepicker({
            toggleActive: true
        });    
})