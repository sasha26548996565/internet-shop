<script type="text/javascript">
    let paginate = 1;

    jQuery('#load-more').click(function()  {
        let page = jQuery(this).data('paginate');
        loadMoreData(page);
        jQuery(this).data('paginate', page+1);
    });

    function loadMoreData(paginate)
    {
        jQuery.ajax({
            url: '?page=' + paginate,
            type: 'GET',
            datatype: 'HTML',
            beforeSend: function() {
                jQuery('#load-more').text('Loading...');
            }
        })
        .done(function(data) {
            if(data == "")
            {
                jQuery('.invisible').removeClass('invisible');
                jQuery('#load-more').hide();

                return;
            } else
            {
                jQuery('#load-more').text('Load more...');
                jQuery('#products').append(data);
            }
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            alert('Something went wrong.');
        });
    }
</script>
