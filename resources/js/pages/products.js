$(function () {
    const $container = $('#product-container');
    const $loadMore = $('#load-more');
    const $sort = $('#sort-select');

    function getContext() {
        return {
            page: parseInt($container.attr('data-page')),
            category_id: $container.attr('data-category'),
            search: $container.attr('data-search'),
            sort: $container.attr('data-sort')
        };
    }

    function fetchProducts({ page, category_id, search, sort }, append = true) {
        $('#sh-loader').removeClass('d-none');
        axios.get('/products/load-more', {
            params: {
                page: page,
                category_id: category_id,
                search: search,
                sort: sort
            }
        }).then(response => {
            if (append) {
                $container.append(response.data.html);
            } else {
                $container.html(response.data.html);
            }

            if (!response.data.hasMore) {
                $('#load-more').hide();
            } else {
                $container.attr('data-page', page + 1);
            }

        }).catch(error => {
            console.error('Fetch error:', error);
        }).finally(() => {
             $('#sh-loader').addClass('d-none');
        });
    }

    $loadMore.on('click', function () {
        const ctx = getContext();
        fetchProducts(ctx, true);
    });

    $sort.on('change', function () {
        const sort = $(this).val();
        $container.attr('data-page', 2);
        $container.attr('data-sort', sort);
        fetchProducts({ ...getContext(), page: 1, sort: sort }, false);
    });
});