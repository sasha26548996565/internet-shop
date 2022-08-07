<script type="text/javascript">
    let paginate = 1;

    jQuery('#load-more').click(() =>  {
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
            beforeSend: () => {
                jQuery('#load-more').text('Loading...');
            }
        })
        .done((data) => {
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
        .fail((jqXHR, ajaxOptions, thrownError) => {
            alert('Something went wrong.');
        });
    }
</script>
