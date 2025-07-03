<?php
echo '<pre>';
print_r('Dev');
echo '</pre>';die();
ob_start();
?>
<jove-select-dropdown>
    <label><?php esc_html_e("Sort By Publication Date:");?></label>
    <select name="sort" data-key="sort">
        <option value="desc"><?php esc_html_e("Latest");?></option>
        <option value="asc"><?php esc_html_e("Oldest");?></option>
    </select>
</jove-select-dropdown>
<?php
$sortby_dropdown = ob_get_clean();
?>
<main class="wp-block-group has-background is-layout-flow wp-block-group-is-layout-flow" style="background-color:#f5f5f5;margin-top:0;margin-bottom:0" id="wp--skip-link--target">
<div class="alignwide wp-block-acf-search-filter" id="jove-block-id-3">

    <div class="jove-search-filter-block">
        <jove-search class="jove-search">
            <div class="jove-pagination-wrapper">
                <button class="jove-filters_heading_text jove-filter-open-button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 18H14V16H10V18ZM3 6V8H21V6H3ZM6 13H18V11H6V13Z" fill="#323232"></path>
                    </svg>
                    <label><?php esc_html_e("Filters");?></label>
                </button>
                <jove-pagination></jove-pagination>
            </div>
            <div class="jove-search-heading">
                <div class="jove-search-heading-text"></div>
                <div class="jove-search-heading-filter">
                    <?php echo $sortby_dropdown;?>
                </div>
            </div>

            <div class="jove-search__filter-wrapper">
                <div class="jove-search__filter-left-col">

                    <jove-filters_heading class="jove-filters_heading">
                        <div class="jove-filters_heading_text">
                            <button class="jove-filters_icon_button">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 18H14V16H10V18ZM3 6V8H21V6H3ZM6 13H18V11H6V13Z" fill="#323232"></path>
                                </svg>
                            </button>
                            <label><?php esc_html_e("Filters");?></label>
                        </div>
                        <div class="jove-search-heading-filter mobile">
                            <?php echo $sortby_dropdown;?>
                        </div>
                        <button class="jove-filters_heading_button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.7">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7504 22.5C18.5515 22.5 18.3607 22.421 18.22 22.2803C18.0794 22.1397 18.0004 21.9489 18.0004 21.75V2.25C18.0004 2.05109 18.0794 1.86032 18.22 1.71967C18.3607 1.57902 18.5515 1.5 18.7504 1.5C18.9493 1.5 19.14 1.57902 19.2807 1.71967C19.4213 1.86032 19.5004 2.05109 19.5004 2.25V21.75C19.5004 21.9489 19.4213 22.1397 19.2807 22.2803C19.14 22.421 18.9493 22.5 18.7504 22.5ZM15.0004 12C15.0004 12.1989 14.9213 12.3897 14.7807 12.5303C14.64 12.671 14.4493 12.75 14.2504 12.75H5.56086L8.78136 15.969C8.8511 16.0387 8.90641 16.1215 8.94415 16.2126C8.98189 16.3037 9.00131 16.4014 9.00131 16.5C9.00131 16.5986 8.98189 16.6963 8.94415 16.7874C8.90641 16.8785 8.8511 16.9613 8.78136 17.031C8.71163 17.1007 8.62885 17.156 8.53774 17.1938C8.44663 17.2315 8.34898 17.2509 8.25036 17.2509C8.15175 17.2509 8.0541 17.2315 7.96299 17.1938C7.87188 17.156 7.7891 17.1007 7.71936 17.031L3.21936 12.531C3.14952 12.4613 3.09411 12.3786 3.0563 12.2874C3.01849 12.1963 2.99902 12.0987 2.99902 12C2.99902 11.9013 3.01849 11.8037 3.0563 11.7125C3.09411 11.6214 3.14952 11.5387 3.21936 11.469L7.71936 6.969C7.86019 6.82817 8.0512 6.74905 8.25036 6.74905C8.44953 6.74905 8.64053 6.82817 8.78136 6.969C8.92219 7.10983 9.00131 7.30084 9.00131 7.5C9.00131 7.69916 8.92219 7.89017 8.78136 8.031L5.56086 11.25H14.2504C14.4493 11.25 14.64 11.329 14.7807 11.4697C14.9213 11.6103 15.0004 11.8011 15.0004 12Z"
                                    fill="#323232"></path>
                                </g>
                            </svg>
                        </button>
                    </jove-filters_heading>
                    <jove-filters class="inner-filter">
                        <div class="filter-mobile-popup">
                            <div class="filter-text">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 18H14V16H10V18ZM3 6V8H21V6H3ZM6 13H18V11H6V13Z" fill="#565656"></path>
                                </svg> <?php esc_html_e("Filters");?>
                            </div>
                            <div class="filter-close-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_3627_3259)">
                                        <path d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z" fill="#565656"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_3627_3259">
                                            <rect width="24" height="24" fill="white"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <jove-clear-all-filters class="clear-all-filters clear-all-filters--top">
                            <button class="jove-clear-all-filters__btn"><?php esc_html_e("Reset all filters");?></button>
                        </jove-clear-all-filters>
                        <jove-accordion class="jove-accordion" key="date" label="Date" active="true">
                            <div class="jove-accordion__handle" role="button">
                                <div class="jove-accordion__handle-text">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.83333 9.1665H7.5V10.8332H5.83333V9.1665ZM17.5 4.99984V16.6665C17.5 17.5832 16.75 18.3332 15.8333 18.3332H4.16667C3.72464 18.3332 3.30072 18.1576 2.98816 17.845C2.67559 17.5325 2.5 17.1085 2.5 16.6665L2.50833 4.99984C2.50833 4.08317 3.24167 3.33317 4.16667 3.33317H5V1.6665H6.66667V3.33317H13.3333V1.6665H15V3.33317H15.8333C16.75 3.33317 17.5 4.08317 17.5 4.99984ZM4.16667 6.6665H15.8333V4.99984H4.16667V6.6665ZM15.8333 16.6665V8.33317H4.16667V16.6665H15.8333ZM12.5 10.8332H14.1667V9.1665H12.5V10.8332ZM9.16667 10.8332H10.8333V9.1665H9.16667V10.8332Z"
                                        fill="#323232"></path>
                                    </svg>

                                    <label><?php esc_html_e("Results by Years");?></label>
                                </div>
                                <span class="jove-accordion__handle-icon"></span>
                            </div>
                            <jove-checkbox-accordion-content class="jove-accordion__content">
                                <jove-years-slider min="2000" max="2025" step="1"></jove-years-slider>
                                <jove-date-presets></jove-date-presets>
                            </jove-checkbox-accordion-content>
                        </jove-accordion>

                        <jove-accordion class="jove-accordion" key="author" label="Author" active="true">
                            <div class="jove-accordion__handle" role="button">
                                <div class="jove-accordion__handle-text">
                                    <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.4084 4.86263L10.0969 0.966264C9.93586 0.888849 9.73814 0.888849 9.57706 0.966264L1.26564 4.86263C1.09348 4.94288 0.991213 5.09701 1.00059 5.26106C1.01082 5.42655 1.13355 5.57285 1.31763 5.63748L1.52048 5.71135V8.39098H1.51962C1.11309 8.58629 0.914518 8.98615 1.03552 9.36471C1.1574 9.74325 1.56904 10.006 2.03951 10.006C2.50997 10.006 2.92162 9.74325 3.04264 9.36471C3.16452 8.98616 2.96594 8.58631 2.55854 8.39098V6.07916L4.63637 6.82349V8.20418L3.55142 11.1311C3.32471 11.7447 3.30682 12.3989 3.50028 13.0204C3.69375 13.6418 4.0909 14.2064 4.64744 14.6503C3.64516 15.6553 3.0946 16.9194 3.08864 18.2263V18.6596V18.6589C3.08864 18.7739 3.14318 18.884 3.2412 18.965C3.33835 19.0466 3.47046 19.0921 3.60853 19.0921H16.0757C16.2137 19.0921 16.3458 19.0466 16.443 18.965C16.541 18.884 16.5955 18.7739 16.5955 18.6589V18.2263C16.5938 16.9181 16.0424 15.6511 15.0367 14.6461C15.589 14.2008 15.9811 13.6362 16.1711 13.0155C16.3612 12.3947 16.3407 11.7427 16.1123 11.1313L15.0367 8.20436V6.82367L18.3564 5.6376C18.5396 5.57297 18.6632 5.42665 18.6734 5.26118C18.6828 5.09712 18.5805 4.94288 18.4084 4.86263ZM13.9978 6.97063V7.83639H5.6864V6.97063H13.9978ZM11.8833 13.7846L9.84213 15.4863L7.80093 13.7853V13.7846C7.97053 13.7306 8.14439 13.6845 8.31996 13.6461C9.30946 13.9814 10.4166 13.9814 11.4061 13.6461C11.551 13.6852 11.7171 13.7328 11.8833 13.7846ZM9.84213 13.0318C8.12054 13.0318 6.7254 11.8684 6.7254 10.4345V8.70228H12.9589V10.4345C12.9589 11.8685 11.5637 13.0318 9.84213 13.0318ZM4.53835 11.3912L5.57726 8.70299L5.68635 8.70228V10.4345C5.68721 11.4494 6.22243 12.4132 7.1514 13.0709C7.00055 13.1227 6.85566 13.1831 6.70993 13.2442V13.2435C6.21987 13.4558 5.76392 13.7193 5.35398 14.0276C4.50682 13.3472 4.19148 12.3272 4.53835 11.3912ZM6.819 14.1881L9.3222 16.2741V18.2264H4.12751C4.12836 16.5837 5.14598 15.0566 6.819 14.1874V14.1881ZM10.3618 18.2264V16.2741L12.8607 14.1917H12.8598C13.2374 14.3785 13.586 14.6022 13.8987 14.8586C14.9701 15.7514 15.5666 16.9644 15.5564 18.2264H10.3618ZM14.3249 14.0319C13.9295 13.7379 13.4931 13.4836 13.0261 13.2741L12.9587 13.2393C12.8181 13.1832 12.6834 13.1221 12.5377 13.0702V13.071C13.465 12.4126 13.9985 11.4488 13.9976 10.4346V8.70236H14.1323L15.1456 11.3905V11.3912C15.4934 12.3295 15.1763 13.3515 14.3249 14.0319ZM14.4135 6.10499H5.27042L2.70417 5.18737L9.84198 1.84083L16.9798 5.18737L14.4135 6.10499Z"
                                        fill="#565656"></path>
                                        <path d="M14.3258 14.0319H14.3249M14.3249 14.0319C13.9295 13.7379 13.4931 13.4836 13.0261 13.2741L12.9587 13.2393C12.8181 13.1832 12.6834 13.1221 12.5377 13.0702V13.071C13.465 12.4126 13.9985 11.4488 13.9976 10.4346V8.70236H14.1323L15.1456 11.3905V11.3912C15.4934 12.3295 15.1763 13.3515 14.3249 14.0319ZM18.4084 4.86263L10.0969 0.966264C9.93586 0.888849 9.73814 0.888849 9.57706 0.966264L1.26564 4.86263C1.09348 4.94288 0.991213 5.09701 1.00059 5.26106C1.01082 5.42655 1.13355 5.57285 1.31763 5.63748L1.52048 5.71135V8.39098H1.51962C1.11309 8.58629 0.914518 8.98614 1.03552 9.36471C1.1574 9.74325 1.56904 10.006 2.03951 10.006C2.50997 10.006 2.92162 9.74325 3.04264 9.36471C3.16452 8.98616 2.96594 8.58631 2.55854 8.39098V6.07916L4.63637 6.82349V8.20418L3.55142 11.1311C3.32471 11.7447 3.30682 12.3989 3.50028 13.0204C3.69375 13.6418 4.0909 14.2064 4.64744 14.6503C3.64516 15.6553 3.0946 16.9194 3.08864 18.2263V18.6596V18.6589C3.08864 18.7739 3.14318 18.884 3.2412 18.965C3.33835 19.0466 3.47046 19.0921 3.60853 19.0921H16.0757C16.2137 19.0921 16.3458 19.0466 16.443 18.965C16.541 18.884 16.5955 18.7739 16.5955 18.6589V18.2263C16.5938 16.9181 16.0424 15.6511 15.0367 14.6461C15.589 14.2008 15.9811 13.6362 16.1711 13.0155C16.3612 12.3947 16.3407 11.7427 16.1123 11.1313L15.0367 8.20436V6.82367L18.3564 5.6376C18.5396 5.57297 18.6632 5.42665 18.6734 5.26118C18.6828 5.09712 18.5805 4.94288 18.4084 4.86263ZM13.9978 6.97063V7.83639H5.6864V6.97063H13.9978ZM11.8833 13.7846L9.84213 15.4863L7.80093 13.7853V13.7846C7.97053 13.7306 8.14439 13.6845 8.31996 13.6461C9.30946 13.9814 10.4166 13.9814 11.4061 13.6461C11.551 13.6852 11.7171 13.7328 11.8833 13.7846ZM9.84213 13.0318C8.12054 13.0318 6.7254 11.8684 6.7254 10.4345V8.70228H12.9589V10.4345C12.9589 11.8685 11.5637 13.0318 9.84213 13.0318ZM4.53835 11.3912L5.57726 8.70299L5.68635 8.70228V10.4345C5.68721 11.4494 6.22243 12.4132 7.1514 13.0709C7.00055 13.1227 6.85566 13.1831 6.70993 13.2442V13.2435C6.21987 13.4558 5.76392 13.7193 5.35398 14.0276C4.50682 13.3472 4.19148 12.3272 4.53835 11.3912ZM6.819 14.1881L9.3222 16.2741V18.2264H4.12751C4.12836 16.5837 5.14598 15.0566 6.819 14.1874V14.1881ZM10.3618 18.2264V16.2741L12.8607 14.1917H12.8598C13.2374 14.3785 13.586 14.6022 13.8987 14.8586C14.9701 15.7514 15.5666 16.9644 15.5564 18.2264H10.3618ZM14.4135 6.10499H5.27042L2.70417 5.18737L9.84198 1.84083L16.9798 5.18737L14.4135 6.10499Z"
                                        stroke="#565656" stroke-width="0.5"></path>
                                    </svg>
                                    <label><?php esc_html_e("Author");?></label>
                                </div>
                                <span class="jove-accordion__handle-icon"></span>
                            </div>

                            <jove-checkbox-accordion-content class="jove-accordion__content">
                                <jove-multi-select-dropdown>
                                    <select class="jove-multiple-select select2-hidden-accessible" multiple="" data-key="author" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-7-8i91">
                                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-8-dsyk" style="width: 50.4px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-6369-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-6369-container" placeholder="Search" style="width: 100%;"></textarea></span></span>
                                    </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    <!-- Custom div to display selected options -->
                                    <div class="jove-selected-options"></div>
                                </jove-multi-select-dropdown>
                            </jove-checkbox-accordion-content>
                        </jove-accordion>
                        <?php /*?>
                        <jove-accordion class="jove-accordion" key="institution" label="Institution" active="true">
                            <div class="jove-accordion__handle" role="button">
                                <div class="jove-accordion__handle-text">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.8333 1.6665H7.5C6.58083 1.6665 5.83333 2.414 5.83333 3.33317V8.33317H4.16667C3.2475 8.33317 2.5 9.08067 2.5 9.99984V17.4998C2.5 17.7208 2.5878 17.9328 2.74408 18.0891C2.90036 18.2454 3.11232 18.3332 3.33333 18.3332H16.6667C16.8877 18.3332 17.0996 18.2454 17.2559 18.0891C17.4122 17.9328 17.5 17.7208 17.5 17.4998V3.33317C17.5 2.414 16.7525 1.6665 15.8333 1.6665ZM4.16667 9.99984H9.16667V16.6665H4.16667V9.99984ZM15.8333 16.6665H10.8333V9.99984C10.8333 9.08067 10.0858 8.33317 9.16667 8.33317H7.5V3.33317H15.8333V16.6665Z"
                                        fill="#323232"></path>
                                        <path d="M9.16634 5H10.833V6.66667H9.16634V5ZM12.4997 5H14.1663V6.66667H12.4997V5ZM12.4997 8.35917H14.1663V10H12.4997V8.35917ZM12.4997 11.6667H14.1663V13.3333H12.4997V11.6667ZM5.83301 11.6675H7.49967V13.3342H5.83301V11.6675Z" fill="#323232"></path>
                                    </svg>
                                    <label><?php esc_html_e("Institution");?></label>
                                </div>
                                <span class="jove-accordion__handle-icon"></span>
                            </div>

                            <jove-checkbox-accordion-content class="jove-accordion__content">
                                <jove-multi-select-dropdown>
                                    <select class="jove-multiple-select select2-hidden-accessible" multiple="" data-key="institution" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-9-la1b">
                                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-10-nc3y" style="width: 50.4px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-usb2-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-usb2-container" placeholder="Search" style="width: 100%;"></textarea></span></span>
                                    </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    <!-- Custom div to display selected options -->
                                    <div class="jove-selected-options"></div>
                                </jove-multi-select-dropdown>
                            </jove-checkbox-accordion-content>
                        </jove-accordion>
                        <?php */?>
                        <jove-accordion class="jove-accordion" key="journal" label="Journal" active="true">
                            <div class="jove-accordion__handle" role="button">
                                <div class="jove-accordion__handle-text">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.9997 1.6665H4.99967C4.08301 1.6665 3.33301 2.4165 3.33301 3.33317V16.6665C3.33301 17.5832 4.08301 18.3332 4.99967 18.3332H14.9997C15.9163 18.3332 16.6663 17.5832 16.6663 16.6665V3.33317C16.6663 2.4165 15.9163 1.6665 14.9997 1.6665ZM7.49967 3.33317H9.16634V7.49984L8.33301 6.87484L7.49967 7.49984V3.33317ZM14.9997 16.6665H4.99967V3.33317H5.83301V10.8332L8.33301 8.95817L10.833 10.8332V3.33317H14.9997V16.6665Z"
                                        fill="#323232"></path>
                                    </svg>
                                    <label><?php esc_html_e("Journal");?></label>
                                </div>
                                <span class="jove-accordion__handle-icon"></span>
                            </div>

                            <jove-checkbox-accordion-content class="jove-accordion__content">
                                <jove-multi-select-dropdown>
                                    <select class="jove-multiple-select select2-hidden-accessible" multiple="" data-key="journal" tabindex="-1" aria-hidden="true" data-select2-id="select2-data-11-fbee">
                                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-12-l19t" style="width: 50.4px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered" id="select2-0jjk-container"></ul><span class="select2-search select2-search--inline"><textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search" aria-describedby="select2-0jjk-container" placeholder="Search" style="width: 100%;"></textarea></span></span>
                                    </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    <!-- Custom div to display selected options -->
                                    <div class="jove-selected-options"></div>
                                </jove-multi-select-dropdown>
                            </jove-checkbox-accordion-content>
                        </jove-accordion>
                        <jove-clear-all-filters class="clear-all-filters clear-all-filters--bottom">
                            <button class="jove-clear-all-filters__btn"><?php esc_html_e("Reset all");?></button>
                        </jove-clear-all-filters>
                    </jove-filters>
                </div>
                <div class="jove-pagination-wrapper mobile">
                    <button class="jove-filters_heading_text jove-filter-open-button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 18H14V16H10V18ZM3 6V8H21V6H3ZM6 13H18V11H6V13Z" fill="#323232"></path>
                        </svg>
                        <label><?php esc_html_e("Filters");?></label>
                    </button>
                    <jove-pagination></jove-pagination>
                </div>
                <div class="jove-search__filter-right-col">
                    <jove-results class="jove-search__filter-results">
                        
                    </jove-results>
                    <jove-pagination></jove-pagination>
                </div>
            </div>
        </jove-search>
    </div>

</div>


</main>