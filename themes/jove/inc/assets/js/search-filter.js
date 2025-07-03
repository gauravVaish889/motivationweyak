jQuery(document).ready(function($) {
    jQuery(document).ready(function() {
        jQuery('.js-example-basic-single').select2({
            minimumResultsForSearch: -1,
              dropdownCssClass: 'custom-dropdown-class',     // adds class to dropdown menu
    containerCssClass: 'custom-container-class'
        });
        
    });
    if(jQuery(document).find('.jove-search-filter-block').length) {
        
        // Toggle Filter Box - close
        jQuery(document).on('click', '.jove-filters_heading_button', function() {
            jQuery(this).closest('.jove-search').addClass('jove-filter-collapsed');
        });
        // Toggle Filter Box - open
        jQuery(document).on('click', '.jove-filter-open-button', function() {
            jQuery(this).closest('.jove-search').removeClass('jove-filter-collapsed');
        });

        // open filter accordians on page load
        jQuery(document).find('.jove-accordion').each(function() {
            jQuery(this).attr('active', 'true');
            jQuery(this).find('.jove-accordion__content').css('height', 'auto');
        });
        // toggle filter accordians
        jQuery(document).on('click', '.jove-accordion__handle', function () {
            const $accordion = jQuery(this).closest('.jove-accordion');
            const $content = $accordion.find('.jove-accordion__content');
        
            if ($accordion.attr('active') === 'true') {
                $accordion.removeAttr('active');
                $content.css('height', '0px');
            } else {
                $accordion.attr('active', 'true');
                $content.css('height', 'auto');
            }
        });


        // set year slider values
        const $sliderElement = jQuery("jove-years-slider");

        initializeYearSlider( $sliderElement );

        // load search filtered post on load
        search_filter_posts();

        // jQuery("#jove-apply-all-filters__btn").prop("disabled", false);
        
        // search filter pagination
        jQuery(document).on('click', '.jove-pagination a', function() {
            if(!jQuery(this).is('[disabled]')) {
                let clickedPage = jQuery(this).attr('data-page');
                search_filter_posts(clickedPage);
            
            }
        });

        // Sort Posts by Date
        jQuery(document).on('change', '.jove-search-heading-filter select[name="sort"]', function() {            
            search_filter_posts();
        });
        
        // reset filters
        jQuery(document).on('click', '.jove-clear-all-filters__btn', function() {            
            const $sliderElement = jQuery("jove-years-slider");
            initializeYearSlider( $sliderElement );
            resetAllFilters();
            jQuery("#jove-apply-all-filters__btn").prop("disabled", false);
            jQuery(".jove-clear-all-filters__btn").prop("disabled", true);

        }); 

        jQuery(document).on('click', '#jove-apply-all-filters__btn', function() { 
            jQuery("#jove-apply-all-filters__btn").prop("disabled", true);
            jQuery('.inner-filter').removeClass('show');            
        });

        if (jQuery.fn.select2) {
            jQuery(document).find(".jove-multiple-select").each(function () {
                const $select = jQuery(this);
                const $selectedItemsContainer = $select.parents('jove-multi-select-dropdown').find(".jove-selected-options");
                const filterType = $select.attr('data-autocomplete');

                const urlParams = new URLSearchParams(window.location.search);
                let rawParamValue = urlParams.get(filterType);
                if (!rawParamValue && filterType === 'authors') {
                    rawParamValue = urlParams.get('author');
                }
                setTimeout(function() {
                                jQuery('.jove-search__filter-left-col').find('textarea').attr('placeholder','Search');
                            }, 200);
                const preselectedItems = (rawParamValue || '')
                    .split('|')
                    .filter(v => v.trim() !== '')
                    .map(v => ({ id: decodeURIComponent(v.trim()), text: decodeURIComponent(v.trim()) }));

                if (filterType) {
                    $select.select2({
                        placeholder: "Search",
                        allowClear: true,
                        minimumInputLength: 1,
                        ajax: {
                            url: function (params) {
                                const baseUrl = search_settings.video_list_api_url + filterType + "/autocomplete";
                                const queryString = $.param({
                                    q: params.term,
                                    limit: 10
                                });
                                return `${baseUrl}?${queryString}`;
                            },
                            type: "GET",
                            dataType: "json",
                            delay: 250,
                            processResults: function (response) {
                                if (filterType == 'authors') {
                                    return {
                                        results: response.results.map(item => ({
                                            id: item.full_name,
                                            text: item.full_name
                                        }))
                                    };
                                } else if (filterType == 'journals') {
                                    return {
                                        results: response.results.map(item => ({
                                            id: item.title,
                                            text: item.title
                                        }))
                                    };
                                }
                            },
                            cache: true
                        }
                    });

                    // Preselect values from URL
                    preselectedItems.forEach(item => {
                        const option = new Option(item.text, item.id, true, true);
                        $select.append(option).trigger('change');
                    });

                    updateSelectedAuthorsDiv(preselectedItems.map(a => a.text));

                    $select.on("select2:select select2:unselect", function () {
                        const selectedValues = $select.val() || [];

                        updateSelectedAuthorsDiv(selectedValues);
                        updateUrlParam(filterType, selectedValues);

                        if (typeof search_filter_posts === "function") {
                            search_filter_posts();
                            setTimeout(function() {
                                jQuery('.jove-search__filter-left-col').find('textarea').attr('placeholder','Search');
                            }, 200);
                            jQuery("#jove-apply-all-filters__btn").prop("disabled", false);
                            jQuery(".jove-clear-all-filters__btn").prop("disabled", false);
                        }
                    });
                }

                function capitalizeWords(str) {
                    return str.replace(/\b\w/g, c => c.toUpperCase());
                }

                function updateSelectedAuthorsDiv(authors) {
                    $selectedItemsContainer.empty();
                    authors.forEach(name => {
                        const $item = $(`
                            <span class="selected-item" data-value="${name}">
                                ${capitalizeWords(name)}
                                <button class="remove-item" data-value="${name}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </button>
                            </span>
                        `);

                        $item.find(".remove-item").on("click", function (event) {
                            event.preventDefault();
                            const valueToRemove = $(this).data('value');
                            const currentValues = $select.val() || [];

                            const updatedValues = currentValues.filter(v => v !== valueToRemove);
                            $select.val(updatedValues).trigger("change");

                            // Force Select2 to handle this unselection
                            $select.trigger({
                                type: 'select2:unselect',
                                params: {
                                    data: {
                                        id: valueToRemove,
                                        text: valueToRemove
                                    }
                                }
                            });

                            updateUrlParam(filterType, updatedValues);

                            if (typeof search_filter_posts === "function") {
                                search_filter_posts();
                                jQuery("#jove-apply-all-filters__btn").prop("disabled", false);
                                jQuery(".jove-clear-all-filters__btn").prop("disabled", false);
                            }
                        });

                        $selectedItemsContainer.append($item);
                    });
                }

                function updateUrlParam(key, values) {
                    const url = new URL(window.location);
                    const paramKey = key === 'authors' ? 'author' : key;

                    if (values.length > 0) {
                        url.searchParams.set(paramKey, values.join('|'));
                    } else {
                        url.searchParams.delete(paramKey);
                    }

                    window.history.replaceState({}, '', url.toString());
                }
            });
        }
      
    }
});

function isMobileDevice() {
  return /Mobi|Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

function search_filter_posts( page = 1) {
   
    let searchResultWrapper = jQuery(document).find('jove-results');
    searchResultWrapper.html('<div class="loding" bis_skin_checked="1">Loading...</div>');
    let searchTerm = getQueryParam('s');
    // if(searchTerm) {
    if( isMobileDevice() ){
        var postSort = jQuery(document).find('.jove-search-heading-filter.mobile select[name="sort"]').val();
    }else{
        var postSort = jQuery(document).find('.jove-search-heading-filter select[name="sort"]').val();
    }
    let yearFrom = jQuery(document).find('.jove-years-slider-container input[name="year-range-from"]').val();
    yearFrom = yearFrom ? yearFrom : '2000';
    let yearTo = jQuery(document).find('.jove-years-slider-container input[name="year-range-to"]').val();
    yearTo = yearTo ? yearTo : new Date().getFullYear();
    let authors = jQuery(document).find('.jove-multiple-select[data-key="author"]').val();
    // let institutions = jQuery(document).find('.jove-multiple-select[data-key="institution"]').val();
    let journals = jQuery(document).find('.jove-multiple-select[data-key="journal"]').val();

    const urlParams = new URLSearchParams(window.location.search);
    const authorParam = urlParams.get('author');    
    const journalsParam = urlParams.get('journals');    

    const yearfromParam = urlParams.get('yearfrom');  
    const yeartoParam = urlParams.get('yearto');  

    var settings = {
        "url": search_settings.video_list_api_url + "articles/search",
        // "url": search_settings.video_list_api_url_mock + "41deaa5c-d97b-4fbd-b419-b01e0d43c256",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "x-api-key" : search_settings.api_key
        }
    };
    console.log(settings);
    var dataParams = {};
    var filters = {};
    if(page) {
        dataParams.pagination = { page: page, limit: 10 };
    }
    if(searchTerm) {
        dataParams.query = { text: searchTerm };
    } else {
        dataParams.query = { text: "" };
    }
    if(postSort) {
        dataParams.sort = { by: "publication_date", order: postSort };
    }
    /* if(authors.length > 0) {
        filters.authors = authors;
    } */
    //filters.authors = ['Theodora Petanidou']; 
    if (authorParam) {
        // Decode '+' to space and split by comma if multiple authors
        const authorsArray = authorParam.split('|').map(name => decodeURIComponent(name.replace(/\+/g, ' ')).trim());

        // Set the filters.authors if authorsArray has values
        if (authorsArray.length > 0) {
            filters.authors = authorsArray;
            console.log('hii4');
            jQuery("#jove-apply-all-filters__btn").prop("disabled", false);
            jQuery(".jove-clear-all-filters__btn").prop("disabled", false);
        }
    } else {
        filters.authors = [];
    }
   
    if (journalsParam) {
        // Decode '+' to space and split by comma if multiple authors
        const journalsArray = journalsParam.split('|').map(name => decodeURIComponent(name.replace(/\+/g, ' ')).trim());

        // Set the filters.journals if journalsArray has values
        if (journalsArray.length > 0) {
            filters.journals = journalsArray;
            console.log('hii4');
            jQuery("#jove-apply-all-filters__btn").prop("disabled", false);
            jQuery(".jove-clear-all-filters__btn").prop("disabled", false);
        }
    } else {
        filters.journals = [];
    }

    // if(institutions.length > 0) {
    //     filters.institutions = institutions;
    // }

    if(yearfromParam){
        yearFrom = yearfromParam;
    }

    if(yeartoParam){
        yearTo = yeartoParam;
    }

    if(yearFrom && yearTo) {
        filters.year_range = {from : parseInt(yearFrom), to : parseInt(yearTo)}
    }
    if(Object.keys(filters).length > 0) {
        dataParams.filters = filters;
    }
    if (Object.keys(dataParams).length > 0) {
        settings.data = JSON.stringify(dataParams);
    }
    
    // console.log(settings)
    jQuery.ajax(settings).done(function (response) {
        console.log(response)
        let metaData = response.meta;
        let currentpage = metaData.current_page;
        let postPerpage = metaData.results_per_page;
        let totalPages = metaData.total_pages;
        let prevPage = (currentpage > 1) ? currentpage - 1 : 1
        let nextPage = currentpage;
        nextPage++;
        let prevDisabled = (currentpage == '1') ? 'disabled=""' : '';
        let nextDisabled = (nextPage > totalPages) ? 'disabled=""' : '';
        let postStartCount = parseInt((currentpage - 1) * postPerpage) + 1;
        let postEndCount = (currentpage * postPerpage);
        let totalResults = metaData.total_results;
 
        postEndCount = (postEndCount < totalResults) ? postEndCount : totalResults;
        let results = response.results;
        let pagination = `<jove-pagination>
                        <nav class="jove-pagination">
                            <a href="javascript:void(0);" class="jove-first-page" data-page="1" ${prevDisabled}>
                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.2335 8L19.3335 1.86667L17.4668 0L9.46683 8L17.4668 16L19.3335 14.1333L13.2335 8ZM4.4335 8L10.5335 1.86667L8.66683 0L0.66683 8L8.66683 16L10.5335 14.1333L4.4335 8Z" fill="#1C1D1D"></path>
                                </svg>
                            </a>
                            <a href="javascript:void(0);" class="jove-prev-page" data-page="${prevPage}" ${prevDisabled}>
                                <svg width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5469 1.88L4.44021 8L10.5469 14.12L8.66688 16L0.666876 8L8.66688 8.21774e-08L10.5469 1.88Z" fill="#1C1D1D"></path>
                                </svg>
                            </a>
                            <span>Page</span>
                            <span class="current">`+currentpage+`</span>
                            <span>of `+totalPages+`</span>
                            <a href="javascript:void(0);" class="jove-next-page" data-page="${nextPage}" ${nextDisabled}>
                                <svg width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.453125 1.88L6.55979 8L0.453124 14.12L2.33312 16L10.3331 8L2.33312 8.21774e-08L0.453125 1.88Z" fill="#1C1D1D"></path>
                                </svg>
                            </a>
                            <a href="javascript:void(0);" class="jove-last-page" data-page="${totalPages}" ${nextDisabled}>
                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.76699 8L0.666992 1.86667L2.53366 0L10.5337 8L2.53366 16L0.666992 14.1333L6.76699 8ZM15.567 8L9.46699 1.86667L11.3337 0L19.3337 8L11.3337 16L9.46699 14.1333L15.567 8Z" fill="#1C1D1D"></path>
                                </svg>
                            </a>
                        </nav>
                    </jove-pagination>`;
        let searchHeading = `<jove-results-count class="jove-results-count">Showing results (${postStartCount}-${postEndCount} of ${totalResults}) with videos related to
                    <h1>${searchTerm}</h1></jove-results-count>`;
        let filterResults = ``;
        if(totalResults > 0) {
            jQuery.each(results, function(index, resultItem) {
                const authorString = resultItem.authors.length > 3 
                ? resultItem.authors.slice(0, 3).map(author => author.name).join(", ") + ", <em>et al.</em>"
                : resultItem.authors.map(author => author.name).join(", ");
                let postPublishDate = resultItem.publish_date;
                const dateObj = new Date(postPublishDate);
                // Get the full date format
                const postPublishDateFormat = dateObj.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });                
                const journalTitleSlug = resultItem.journalTitle.toLowerCase().replace(/\s+/g, '-');
                // const journalURL = "https://jovevisualistg.wpenginepowered.com/journal/"+journalTitleSlug+"/";
                // const articleURL = resultItem.slug;
                const journalURL = "javascript:";
                const articleURL = search_settings.home_url + '/video/' + resultItem.slug ;
                // const articleURL = search_settings.home_url + '/video/' + resultItem.slug + "/";
                filterResults += `<article class="jove-search-video" id="video-${resultItem.articleId}">
                            <h2 class="jove-search-video-title">
                                <a title="${resultItem.title}" href="${articleURL}">
                                    ${resultItem.title}
                                </a>
                            </h2>
                            <div class="jove-search-video-authors-affiliations">
                                <ul class="jove-abstract-block__authors">
                                    <li data-trimmed="true">${authorString}</li>
                                </ul>
                            </div>
                            <div class="jove-search-video-meta">
                                <div class="jove-search-video-date"><span>Published on:</span> ${postPublishDateFormat}</div><span class="jove-meta-separator">|</span>
                                <div class="jove-info-wrapper">
                                    <a rel="tag" class="jove-info-toggle" href="${journalURL}">${resultItem.journalTitle}</a>
                                    <div class="jove-notice__text">
                                        <p>${resultItem.journalTitle}</p>
                                    </div>
                                </div>
                            </div>
                        </article>`;
            });                 
        } else {
            filterResults += `<article class="jove-search-video">
                                <h2 class="jove-search-video-title">
                                    No match found
                                </h2>
                            </article>`;
        }
        jQuery(document).find('jove-pagination').html(pagination);
        jQuery(document).find('.jove-search-heading-text').html(searchHeading);
        searchResultWrapper.html(filterResults);
    });
   
    
}

// Get URL parameters
    function getUrlParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

//jQuery(function () {
jQuery(document).ready(function(){
    
    

    // Default slider range values
    const minYear = 2000;
    const maxYear = new Date().getFullYear();

    // Get yearfrom and yearto from URL or fallback to default
    let yearFrom = parseInt(getUrlParam('yearfrom')) || minYear;
    let yearTo = parseInt(getUrlParam('yearto')) || maxYear;

    // Clamp values within allowed range
    yearFrom = Math.max(minYear, Math.min(yearFrom, maxYear));
    yearTo = Math.max(minYear, Math.min(yearTo, maxYear));

    if (yearFrom > yearTo) {
        [yearFrom, yearTo] = [yearTo, yearFrom]; // swap if out of order
    }

    // Initialize slider
    jQuery("#slider-range").slider({
        range: true,
        min: minYear,
        max: maxYear,
        values: [yearFrom, yearTo],
        slide: function (event, ui) {
        jQuery("#year-min").val(ui.values[0]);
        jQuery("#year-max").val(ui.values[1]);
        },
        change: function (event, ui) {
            updateUrlParams(ui.values[0], ui.values[1]);
            search_filter_posts();
            console.log('hii6');
            jQuery("#jove-apply-all-filters__btn").prop("disabled", false);
            jQuery(".jove-clear-all-filters__btn").prop("disabled", false);
        }
    });

    // Set initial input values
    jQuery("#year-min").val(yearFrom);
    jQuery("#year-max").val(yearTo);
});

function updateUrlParams(from, to) {
  const url = new URL(window.location.href);
  url.searchParams.set("yearfrom", from);
  url.searchParams.set("yearto", to);
  window.history.replaceState({}, '', url);
}

function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
  }

  function initializeYearSlider($element) {

    $element.html(`
        <div class="slider-range-wrap">
            <input type="text" class="slider_track_before" name="year-range-from" id="year-min" readonly>
            <div id="slider-range"></div>
            <input type="text" class="slider_track_before" name="year-range-to" id="year-max" readonly>
        </div>    
    `); 

}

function capitalizeWords(str) {
    return str.replace(/-/g, " ")
        .split(" ")
        .map(function(word) {
            return word.charAt(0).toUpperCase() + word.slice(1);
        })
        .join(" ");
}

function resetAllFilters() {
    // Loop through each filter with the class .jove-multiple-select
    jQuery(".jove-multiple-select").each(function () {
        const $select = jQuery(this);
        const filterType = $select.attr('data-autocomplete');
        const paramKey = filterType === 'authors' ? 'author' : filterType;

        // Clear all values
        $select.val(null).trigger("change");

        // Manually trigger the unselect event for each item
        $select.find("option:selected").each(function () {
            $select.trigger({
                type: 'select2:unselect',
                params: {
                    data: {
                        id: $(this).val(),
                        text: $(this).text()
                    }
                }
            });
        });

        // Clear the selected items container
        const $selectedItemsContainer = $select
            .parents('jove-multi-select-dropdown')
            .find(".jove-selected-options");

        $selectedItemsContainer.empty();

        // Remove the corresponding URL parameter
        const url = new URL(window.location);
        url.searchParams.delete(paramKey);
        window.history.replaceState({}, '', url.toString());
    });

    // Default slider range values
    const minYear = 2000;
    const maxYear = new Date().getFullYear();

    // Get yearfrom and yearto from URL or fallback to default
    let yearFrom = minYear;
    let yearTo = maxYear;

    // Clamp values within allowed range
    yearFrom = Math.max(minYear, Math.min(yearFrom, maxYear));
    yearTo = Math.max(minYear, Math.min(yearTo, maxYear));

    if (yearFrom > yearTo) {
        [yearFrom, yearTo] = [yearTo, yearFrom]; // swap if out of order
    }

    // Initialize slider
    jQuery("#slider-range").slider({
        range: true,
        min: minYear,
        max: maxYear,
        values: [yearFrom, yearTo],
        slide: function (event, ui) {
            jQuery("#year-min").val(ui.values[0]);
            jQuery("#year-max").val(ui.values[1]);
        },
        change: function (event, ui) {
            updateUrlParams(ui.values[0], ui.values[1]);
            search_filter_posts();
            console.log('hii7');
            jQuery("#jove-apply-all-filters__btn").prop("disabled", false);
            jQuery(".jove-clear-all-filters__btn").prop("disabled", false);
        }
    });

    // Set initial input values
    jQuery("#year-min").val(yearFrom);
    jQuery("#year-max").val(yearTo);

    const url = new URL(window.location);
    url.searchParams.delete("yearfrom");
    url.searchParams.delete("yearto");
    window.history.replaceState({}, '', url.toString());

    // Call your filter function
    if (typeof search_filter_posts === "function") {
        search_filter_posts();
    }
}
jQuery(document).ready(function($) {
    $('.jove-filters_icon_button').on('click', function() {
      $('body').css('overflow', 'hidden'); 
    });

    $('.filter-close-icon, .jove-apply-all-filters__btn').on('click', function() {
      $('body').css('overflow', '');
    });
  });


function updateUrlParamYear(key, values) {
    const url = new URL(window.location);
    const paramKey = key === 'authors' ? 'author' : key;

    if (values.length > 0) {
        url.searchParams.set(paramKey, values.join(','));
    } else {
        url.searchParams.delete(paramKey);
    }

    window.history.replaceState({}, '', url.toString());
}