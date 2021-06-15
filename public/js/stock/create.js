
$(document).ready(function () {
    
    $("#satuan_id").selectpicker();
    prevList();
});



function prevList(){
    if ($("#chxbox").is(":checked")) {
        $("#more_stock").fadeIn(500);
    } else {
        $("#more_stock").fadeOut(100);
    }
}
