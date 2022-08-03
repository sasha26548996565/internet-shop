<script>

jQuery(document).ready(function () {
    jQuery(document).click("{{ $cartName }}", function (event) {
        event.preventDefault();

        let id = jQuery(event.target).data('id');
        removeCart(id);
    });

    function removeCart(id)
    {
        jQuery.ajax({
            url: "{{ route('cart.remove') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            }
        });

        decrementTotalQuantity();
    }

    function decrementTotalQuantity()
    {
        let totalQuantity = parseInt(jQuery('#totalQuantity').text());
        totalQuantity -= 1;

        jQuery('#totalQuantity').text(totalQuantity);
    }
});

</script>
