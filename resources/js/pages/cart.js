$(function () {
    $('.delete-cart-item').on('click', function(e){
        e.preventDefault();
        const cartItemId = $(this).attr('data-id');
        const $row = $(this).closest('tr');
        $('#sh-loader').removeClass('d-none');
        $.ajax({
            url: '/cart/delete/' + cartItemId,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                if(response.status === 'success'){
                    $('#global-success-message').removeClass('d-none').text(response.message);
                    $row.fadeOut(500, function () {
                        $(this).remove(); 
                        if(!response.cart_counter) location.reload();
                    });
                    $('#cart-count-display').text(response.cart_counter);
                }
                else 
                $('#global-error-message').removeClass('d-none').text(response.message);
            },
            error: function(err){
                console.log(err.responseJSON);
                $('#global-error-message').removeClass('d-none').text('Something went wrong while deleting item from cart.');
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