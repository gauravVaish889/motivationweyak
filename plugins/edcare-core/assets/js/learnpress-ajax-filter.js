;(function($){
    "use strict";
    var formDataFilter = {};
    var paged = 1;
    var tax_val = wp_vars.course_tax_page;
    var term_id = wp_vars.current_term_id;
    
    $(document).on('change', '.tp-filter-dropdown-wrapper input[type="checkbox"], .tp-filter-dropdown-wrapper input[type="radio"], .tp-filter-dropdown-offcanvas input[type="checkbox"], .tp-filter-dropdown-offcanvas input[type="radio"]', function(){
        
        var formData = {};
        paged = 1;
        formData['paged'] = paged;
        if(1 == paged){
            $('.ac-lp-archive-load-more-2').css('display', 'inline-block');
        }

        // blank array create and push data to the array also push the array in formData object
        var sortBy = $('input[name="sort_by"]:checked').val() || '';

        if (sortBy !== '') {
            formData['sort_by'] = sortBy;
        }

        // blank array create and push data to the array also push the array in formData object
        let categories = [];
        $('input[name="categories"]:checked').each(function(){
            categories.push($(this).val());
        });
        if(categories.length > 0){
            formData['categories'] = categories;
        }

        // blank array create and push data to the array also push the array in formData object
        let instructors = [];
        $('input[name="instructors"]:checked').each(function(){
            instructors.push($(this).val());
        });
        if(instructors.length > 0){
            formData['instructors'] = instructors;
        }

        // blank array create and push data to the array also push the array in formData object
        let sort_by_price = [];
        $('input[name="sort_by_price"]:checked').each(function(){
            sort_by_price.push($(this).val());
        });
        if(sort_by_price.length > 0){
            formData['sort_by_price'] = sort_by_price;
        }

        // blank array create and push data to the array also push the array in formData object
        let skills = [];
        $('input[name="skills"]:checked').each(function(){
            skills.push($(this).val());
        });
        if(skills.length > 0){
            formData['skills'] = skills;
        }

        // Generate a nonce and add it to formData
        let nonce = wp_vars_filter.nonce;
        formData['nonce'] = nonce;

        let urlParams = buildUrlParams(formData);
        let newUrl = window.location.origin + window.location.pathname + '?' + urlParams;
        window.history.pushState(null, null, newUrl);

        ajax_filter_post_fetch(formData, '[data-ac-course-filter-content]', '[data-ac-course-filter-content-list]');
    })

    function buildUrlParams(data) {
        let params = [];
    
        for (let key in data) {
            if (Array.isArray(data[key]) && data[key].length > 0) {
                // Join array values by commas if it's non-empty
                params.push(`${key}=${data[key].join(',')}`);
            } else if (data[key] !== null && data[key] !== '') {
                // Add single values (like rating) only if they are not null or empty
                params.push(`${key}=${data[key]}`);
            }
        }
    
        return params.join('&');
    }

    // filter bar
    window.ajax_filter_post_fetch = (params, result, result_list) => {
        $.ajax({
            url: wp_vars_filter.ajaxurl,
            type: 'POST',
            data: {
                ...params,
                action: 'ac_learnpress_filter_ajax_course'
            },
            beforeSend:function(){
                block($(result));
                block($(result_list));
                block($('[data-ac-course-filter-open-content]'));
                block($('[data-ac-course-filter-open-content-list]'));
            },
            success:function(res){
                $(result).html(res?.data?.results);
                $('[data-total-courses]').html(res?.data?.totals);
                $(result_list).html(res?.data?.results_list);
                $('[data-ac-course-filter-open-content]').html(res?.data?.results_2);
                $('[data-ac-course-filter-open-content-list]').html(res?.data?.results_list_2);
            },
            complete: function(){
                unblock($(result));
                unblock($(result_list));
                block($('[data-ac-course-filter-open-content]'));
                block($('[data-ac-course-filter-open-content-list]'));
            },
            error:function(err){
                console.log(err);
            }
        })
    }

    // ajax search
    $(document).on('keyup', '.tp-course-filter-top-right-search.style-2 .course_search', function(e) {
        $('.ac-lp-archive-load-more-2').css('display', 'inline-block');
        // Get the value from the input field
        let searchValue = $(this).val().trim();
        // Get the current base URL (without query parameters)
        let baseUrl = window.location.origin + window.location.pathname;

        if (searchValue != '' && searchValue.length > 0) {
            // Update the URL with the new query parameter
            let newUrl = baseUrl + '?search_for=' + encodeURIComponent(searchValue) + '&paged=1';
            
            // Update the browser URL without reloading the page
            window.history.pushState(null, null, newUrl);

            if (e.keyCode == 13) { // Trigger form submission on Enter key
                $('.ac-archive-filter-search-form').submit();
            }

            search_filter_ajax_fetch_post(searchValue, '[data-ac-course-filter-content]', '[data-ac-course-filter-content-list]')

            // Perform the AJAX search
            // search_ajax_fetch_post(searchValue, '[data-ac-course-content]', '[data-ac-course-content-list]');
        } else {
            // If the input is cleared (e.g., Ctrl + A + Backspace), reset the URL to the base URL
            window.history.pushState(null, null, baseUrl);

            search_filter_ajax_fetch_post('', '[data-ac-course-filter-content]', '[data-ac-course-filter-content-list]')
            
            // Optionally, trigger the default search or reset action
            // search_ajax_fetch_post('', '[data-ac-course-content]', '[data-ac-course-content-list]');
        }
        formData['search_for'] = searchValue;
        paged = 1;
        formData['paged'] = paged;
    });

    window.search_filter_ajax_fetch_post = (sarch_val, result, results_list) => {
        $.ajax({
            url: wp_vars.ajaxurl,
            type: 'POST',
            data: {
                action: 'ac_learnpress_filter_ajax_course',
                search_for: sarch_val
            },
            beforeSend: function(){
                block($(result));
                block($(results_list));
            },
            success: function(res){
                $(result).html(res?.data?.results);
                $(results_list).html(res?.data?.results_list);
                $('[data-total-courses]').html(res?.data?.totals);
            },
            complete: function(){
                unblock($(result));
                unblock($(results_list));
            },
            error:function(err){
                console.log(err);
            }
        });
    }

    $(document).on('click', '.ac-lp-archive-load-more-2', function(e){
        e.preventDefault();
        paged++;
        var url = new URL(window.location.href);
        var params = new URLSearchParams(url.search);

        if( params.get('search_for') != null ){
            formDataFilter['search_for'] = params.get('search_for');
        }

        if( params.get('sort_by') != null ){
            formDataFilter['sort_by'] = params.get('sort_by');
        }

        if( params.get('categories') != null ){
            formDataFilter['categories'] = params.get('categories').split(',');
        }

        if( params.get('instructors') != null ){
            formDataFilter['instructors'] = params.get('instructors').split(',');
        }

        if( params.get('sort_by_price') != null ){
            formDataFilter['sort_by_price'] = params.get('sort_by_price').split(',');
        }

        if( params.get('skills') != null ){
            formDataFilter['skills'] = params.get('skills').split(',');
        }
        formDataFilter['paged'] = paged;
        ajax_filter_post_fetch_load(formDataFilter, '[data-ac-course-filter-content]', '[data-ac-course-filter-content-list]');
    });

    window.ajax_filter_post_fetch_load = (params, result, result_list) => {
        $.ajax({
            url: wp_vars_filter.ajaxurl,
            type: 'POST',
            data: {
                ...params,
                action: 'ac_learnpress_filter_ajax_course',
                tax_val : tax_val,
                term_id : term_id
            },
            beforeSend:function(){
                block($(result));
                block($(result_list));
            },
            success:function(res){
                $(result).append(res?.data?.results);
                $(result_list).append(res?.data?.results_list);
                res?.data?.total_posts > 0 && $('[data-total-courses]').html(res?.data?.totals);
                if(0 == res.data.total_pagi){
                    $('.ac-lp-archive-load-more-2').css('display', 'none');
                }
            },
            complete: function(){
                unblock($(result));
                unblock($(result_list));
            },
            error:function(err){
                console.log(err);
            }
        })
    }
})(jQuery);