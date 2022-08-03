<script>

jQuery(document).ready(function () {
    let totalQuantity = parseInt(jQuery('#totalQuantity').text());

    jQuery(document).click("{{ $cartName }}", function (event) {
        event.preventDefault();

        let id = jQuery(event.target).data('id');
        addCart(id);
    });

    function addCart(id)
    {
        jQuery.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            }
        });

        incrementTotalQuantity();
    }

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

    function incrementTotalQuantity()
    {
        totalQuantity += 1;

        jQuery('#totalQuantity').text(totalQuantity);
    }

    function decrementTotalQuantity()
    {
        totalQuantity -= 1;

        jQuery('#totalQuantity').text(totalQuantity);
    }
});

</script>
