$(document).ready(function() {
    //para que las cantidades solo permitan nros 
    $(".input_cant").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    
    
    $(document).on("click","#addtocart",function(e){
    //$('#addtocart').on("click",function(e){
        e.preventDefault();
         var prods = new Array();
        //para el add to cart que tome todos los valores
        $('.input_cant').each(function(){
            if($(this).val() !== "" && $(this).val() > 0 ) {
                    var cantidad = $(this).val();
                    var id = $(this).closest('tr').find('#id').val();
                    prods.push({id : id ,cant:cantidad })
                }
            });
            limpiarCantidades();
            $.ajax({
                type: "POST",
                cache: false,
                url: '/products/add',
                data:{carro : prods},
                dataType: "json",
                success: function(data) {
                    //var parsed_data = JSON.parse(data);
                    console.log(data);
                    $("#navbarsExampleDefault .form-inline").remove();
                    if(data.cart != null) {
                        $("#navbarsExampleDefault").append('<form class="form-inline my-2 my-lg-0"><a href="/cart" class="btn btn-secondary btn-sm my-2 my-sm-0" "=""><i class="fa fa-cart-plus"></i> &nbsp; Shopping Cart (<span id="quantitybutton">'+data.cart.Order.quantity+'</span>)</a></form>');
                    }
                    $.each(data.products, function( index, value ){
                        $(".cantidad_del_producto_"+index).text("(" + value +")");
                        
                    });
                },
                error: function(data){
                    console.log(data);
                }
            }); 
            
        });
    function limpiarCantidades(){
        $('.input_cant').each(function(){
            $(this).val('');
        });
    }
    
 $('.input_cant').keydown(function (e) {
    if (e.which === 13) {
         var index = $('.input_cant').index(this) + 1;
         $(this).closest("#addtocart").click();
         $('.input_cant').eq(index).focus();
     }
 });
});