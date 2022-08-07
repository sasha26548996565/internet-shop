<script>

jQuery(document).ready(function () {
    jQuery("{{ $cartName }}").click(function (event) {
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
        incrementTotalQuantity()
    }

    function incrementTotalQuantity()
    {
        let totalQuantity = parseInt(jQuery('#totalQuantity').text());
        totalQuantity += 1;

        jQuery('#totalQuantity').text(totalQuantity);
    }
});

</script>
