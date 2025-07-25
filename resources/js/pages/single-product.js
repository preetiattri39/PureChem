$(function () {
    const units = Object.keys(window.productVariants);
    console.log(productVariants)
    if(units.length){
        const $unitSelect = $('#unitSelect');
        const $quantitySelect = $('#quantitySelect');

        $unitSelect.empty();
        $.each(units, function (i, unit) {
            $unitSelect.append($('<option>', {
                value: unit,
                text: unit
            }));
        });

        function updateQuantities(unit) {
            $quantitySelect.empty();
            const variants = window.productVariants[unit] || [];
            $.each(variants, function (i, v) {
                $quantitySelect.append($('<option>', {
                    value: v.id,
                    text: v.quantity
                }));
            });
            if(variants.length) variantInputValue(variants[0].id)
        }

        function variantInputValue(value){
            $('#variantInput').val(value ?? null);
        }

        if (units.length > 0) {
            updateQuantities(units[0]);
        }

        $unitSelect.on('change', function () {
            updateQuantities($(this).val());
        });

        $quantitySelect.on('change', function () {
            variantInputValue($(this).val())
        });
    }else{
        $('#unit-quantity-selector').html(`<p>Quantity not existed! You can still add the product to RFQ.</p>`);
    }
    
    $('#addToCartForm').on('submit', function(e){
        e.preventDefault();
        $('#sh-loader').removeClass('d-none');
        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                if(response.status === 'success'){
                    $('#global-success-message').removeClass('d-none').text(response.message);
                    $('#cart-count-display').text(response.cart_counter);
                }
                else 
                $('#global-error-message').removeClass('d-none').text(response.message);
            },
            error: function(err){
                console.log(err.responseJSON);
                $('#global-error-message').removeClass('d-none').text('Something went wrong while adding to cart.');
            },
            complete: function(){
                $('#sh-loader').addClass('d-none');

                setTimeout(function() {
                    $('.request-response-block').addClass('d-none');
                }, 5000);
            }
        });
    });
});