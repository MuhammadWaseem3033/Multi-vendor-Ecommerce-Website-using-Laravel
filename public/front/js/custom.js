// $(document).ready(function () {
//     $('#getPrice').change(function () {
//         var size = $(this).val();
//         var product_id = $(this).data('product_id');
//         // alert(product_id);
//         $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             type: "post",
//             url: "/get-product-price",
//             data: { size: size, product_id: product_id },
//             success: function (res) {
//                 // alert(res['product_price']);
//                 if (res.discount > 0) 
//                 {

//                     $('.getDiscountAttributePrice').html('');

//                 } 
//                 else 
//                 {
//                     // alert('test');
//                     $('.getDiscountAttributePrice').html("<div class='price-template'><div class='item-new-price'>" + res['final_price'] + "</div><div class='item-old-price'>" + res['discount'] + "</div></div>");

//                 }
//             }, error: function () {
//                 alert('Error');
//             }
//         });
//     });

// });

// write filter code for get value 

$(document).ready(function() {
    $('#getPrice').change(function() {
        var size = $(this).val();
        var product_id = $(this).attr('product-id'); // Use 'data' instead of 'attr' for data attributes
        // alert(product_id);  
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/get-product-price",
            data: { size: size, product_id: product_id },
            success: function(res) {
                if (res && res.discount > 0) {
                    $('.getDiscountAttributePrice').html(`
                    <div class='price-template'>
                        <div class='item-new-price'>${res.final_price}</div>
                        <div class='item-old-price'>${res.discount}</div>
                    </div>
                `);
                } else {
                        $('.getDiscountAttributePrice').html(`<div class='price-template'><div class="item-new-price">${res.product_price}</div></div>`);

                }
            },
            error: function() {
                alert('Error occurred while fetching the product price.');
            }
        });
    });
});




function get_filter(class_name) {
    var filter = [];
    $('.' + class_name + ':checked').each(function () {
        filter.push($(this).val());
    });
    return filter;
}
