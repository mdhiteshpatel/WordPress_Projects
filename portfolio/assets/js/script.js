(function ($) {
    $(document).ready(function () {
        $(document).on('click', '.cat-list_item', function (e) {
            e.preventDefault();

            var category = $(this).data('slug');

            var data = {
                action: "portfolio_ajax_category_filter_search",
                taxonomy: category
            }

            $.ajax({
                url: ajax_url,
                data: data,
                type: 'GET',
                contentType: 'application/json',
                success: function (response) {
                    $('.portfolio-container').html(response);
                },
                error: function (response) {
                    console.warn(response);
                }


            });
        })
    });
})(jQuery);




