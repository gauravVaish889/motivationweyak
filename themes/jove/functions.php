<?php
/**
 * Theme Functions.
 *
 * @package Jove
 */


if ( ! defined( 'JOVE_VERSION' ) ) {
	define( 'JOVE_VERSION', '1.0.1' );
}

if ( ! defined( 'JOVE_DIR_PATH' ) ) {
	define( 'JOVE_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if ( ! defined( 'JOVE_DIR_URI' ) ) {
	define( 'JOVE_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

if ( ! defined( 'JOVE_BUILD_URI' ) ) {
	define( 'JOVE_BUILD_URI', untrailingslashit( get_template_directory_uri() ) . '/build' );
}

if ( ! defined( 'JOVE_BUILD_PATH' ) ) {
	define( 'JOVE_BUILD_PATH', untrailingslashit( get_template_directory() ) . '/build' );
}

if ( ! defined( 'JOVE_VIDEO_API_URL_MOCK' ) ) {
	define( 'JOVE_VIDEO_API_URL_MOCK', 'https://run.mocky.io/v3/' );
}

if ( ! defined( 'APP_JOVE_LIVE_URL' ) ) {
	define( 'APP_JOVE_LIVE_URL', 'https://app.jove.com/' );
}

if ( ! defined( 'JOVE_VIDEO_API_URL_OLD' ) ) {
	define( 'JOVE_VIDEO_API_URL_OLD', 'https://visualize-search-api.preview-nyrs0.test.jove.com/' );
}
if ( ! defined( 'JOVE_VIDEO_API_URL' ) ) {
	define( 'JOVE_VIDEO_API_URL', 'https://visualize-search-api.jove.com/' );
}
if ( ! defined( 'JOVE_VIDEO_API_KEY' ) ) {
	define( 'JOVE_VIDEO_API_KEY', 'jove-api-key-production' );
}
// jove-api-key-preview-nyrs0
require_once JOVE_DIR_PATH . '/inc/helpers/custom-functions.php';
require_once JOVE_DIR_PATH . '/inc/helpers/autoloader.php';
require_once JOVE_DIR_PATH . '/inc/classes/class-video-rest-api.php';
require_once JOVE_DIR_PATH . '/inc/classes/class-breadcrumb-trail.php';
require_once JOVE_DIR_PATH . '/inc/classes/class-api.php';


// add_action('wp_head', function () {

//     global $post;

//     $author_id = $post->post_author;
//     $author_url = get_author_posts_url($author_id);

//     echo '<link rel="author" href="' . esc_url($author_url) . '" />';
// });

// add_action('wp_head', function () {
//     // Replace this with your publisher's homepage or about page URL

//     echo '<link rel="publisher" href="https://yourdomain.com/about/" />';
// });

/**
 * Returns an instance of the Jove class.
 *
 * This function returns an instance of the Jove class. The Jove class is
 * responsible for setting up the theme, adding support for various features,
 * and registering the necessary hooks.
 *
 * @since 1.0.0
 *
 * @return Jove The instance of the Jove class.
 */
function jove_get_instance() {
	/**
	 * Get the instance of the Jove class.
	 *
	 * The Jove class is a singleton class, so it can only have one instance.
	 * This function returns the instance of the Jove class.
	 *
	 * @since 1.0.0
	 *
	 * @return Jove The instance of the Jove class.
	 */
	return \Jove\Inc\Jove::get_instance();
}

jove_get_instance();

/**
 * Setup the post select API endpoint.
 *
 * This function initializes the REST API routes for the video controller by
 * creating an instance of the Jove_Video_REST_Controller class and registering
 * its routes.
 *
 * @return void
 */
function jove_register_api_endpoints() {
    // Create an instance of the video REST controller
    $video = new Jove_Video_REST_Controller();

    // Register the routes defined in the video REST controller
    $video->register_routes();
}

// Hook the function into the 'rest_api_init' action to ensure it's called when the REST API is initialized
add_action( 'rest_api_init', 'jove_register_api_endpoints' );


add_action('wp_footer', 'jove_combined_frontend_scripts');
function jove_combined_frontend_scripts() {
    ?>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        /* ----------- Trim Author Names Logic ----------- */
        function limitAuthorNames(authorLi) {
          // console.log(authorLi);
          const text = authorLi.textContent.trim();
          if (!text) return;
          const authors = text.split(",").map(name => name.trim());
          const firstFour = authors.slice(0, 4);
          authorLi.innerHTML = authors.length > 4
            ? firstFour.join(", ") + ' <em>et al.</em>'
            : firstFour.join(", ");
        }

        function processAllAuthors() {
          document.body.classList.replace('search-no-results', 'search-results');
          const allAuthorItems = document.querySelectorAll(".search-results .jove-abstract-block__authors li");
          allAuthorItems.forEach(authorLi => {
            if (!authorLi.dataset.trimmed) {
              limitAuthorNames(authorLi);
              authorLi.dataset.trimmed = "true";
            }
          });
        }

        processAllAuthors();

        const authorObserver = new MutationObserver(() => {
          processAllAuthors();
        });
        authorObserver.observe(document.body, { childList: true, subtree: true });
		  
// 		  count authore
       /* ----------- Trim Author Names Logic ----------- */
 function limitAuthorNodes(authorLi) {
  
      const aTags = Array.from(authorLi.querySelectorAll("a"));
      const subTags = Array.from(authorLi.querySelectorAll("sup"));
      const total = aTags.length;
      
      const maxVisible = 3;

      if (total <= maxVisible) return;

      const fullContent = authorLi.innerHTML;

      function renderCollapsed() {
        authorLi.innerHTML = "";
        for (let i = 0; i < maxVisible; i++) {
          authorLi.appendChild(aTags[i].cloneNode(true));
          authorLi.appendChild(subTags[i].cloneNode(true));
          if (i < maxVisible - 1) {
            authorLi.appendChild(document.createTextNode(", "));
          }
        }

        const more = document.createElement("span");
        more.textContent = ` +${total - maxVisible} `;
        more.style.cursor = "pointer";
        more.style.color = "#213ced";
        more.style.marginLeft = "5px";
        more.addEventListener("click", renderExpanded);
        authorLi.appendChild(more);
      }

      function renderExpanded() {
        authorLi.innerHTML = fullContent;

        const collapse = document.createElement("span");
        collapse.textContent = " - ";
        collapse.style.cursor = "pointer";
        collapse.style.color = "#213ced";
        collapse.style.marginLeft = "5px";
        collapse.addEventListener("click", renderCollapsed);
        authorLi.appendChild(collapse);
      }

      renderCollapsed();
    }

    // Affiliation Limiting Logic
function limitAffiliations(affList) {
  const items = Array.from(affList.querySelectorAll("li"));
  const total = items.length;
  const maxVisible = 1;

  if (total <= maxVisible) return;

  const fullList = affList.innerHTML;

  function renderCollapsed() {
    affList.classList.remove("affiliation-expanded"); // ❌ Remove class when collapsed
    affList.innerHTML = "";
    affList.appendChild(items[0].cloneNode(true));

    const toggleLi = document.createElement("li");
    toggleLi.textContent = `+${total - maxVisible}`;
    toggleLi.style.cursor = "pointer";
    toggleLi.style.color = "#213ced";
    toggleLi.classList.add("affiliation-toggle");
    toggleLi.addEventListener("click", renderExpanded);
    affList.appendChild(toggleLi);
  }

  function renderExpanded() {
    affList.classList.add("affiliation-expanded"); // ✅ Add class when expanded
    affList.innerHTML = fullList;

    const collapseLi = document.createElement("li");
    collapseLi.textContent = "−";
    collapseLi.style.cursor = "pointer";
    collapseLi.style.color = "#213ced";
    collapseLi.addEventListener("click", renderCollapsed);
    affList.appendChild(collapseLi);
  }

  renderCollapsed();
}

    // Processing functions
    // function processAllAuthorLists() {
    //   const authorLists = document.querySelectorAll(".jove-abstract-block__authors li");
    //   console.log(authorLists);
    //   authorLists.forEach(li => {
    //     if (!li.dataset.trimmed) {
    //       limitAuthorNodes(li);
    //       li.dataset.trimmed = "true";
    //     }
    //   });
    // }

    function processAllAuthorLists() {
      const authorLists = document.querySelectorAll(".jove-abstract-block__authors li");
      // console.log(authorLists);
      authorLists.forEach(ul => {
        if (!ul.dataset.trimmed) {
          limitAuthorNodes(ul);
          ul.dataset.trimmed = "true";
        }
      });
    }

    function processAllAffiliations() {
      const affLists = document.querySelectorAll(".jove-abstract-block__affiliations");
      affLists.forEach(ul => {
        if (!ul.dataset.trimmed) {
          limitAffiliations(ul);
          ul.dataset.trimmed = "true";
        }
      });
    }

    function processAllJournals(){
      const journals = document.querySelectorAll(".jove-abstract-block__journal");      

      journals.forEach(journal => {
        const textEl = journal.querySelector(".text-content");
        const toggleEl = journal.querySelector(".read-toggle");
        const fullText = textEl.dataset.fullText;

        let truncated = fullText; // Define outside so it's accessible in toggle

        textEl.textContent = fullText;

        // Measure if it overflows
        if (textEl.scrollWidth > textEl.clientWidth) {
          // Truncate at word boundary
          let words = fullText.split(" ");
          truncated = "";
          textEl.textContent = "";

          for (let i = 0; i < words.length; i++) {
            let test = truncated + (truncated ? " " : "") + words[i];
            textEl.textContent = test;

            if (textEl.scrollWidth > textEl.clientWidth) break;
            truncated = test;
          }

          textEl.textContent = truncated;
          toggleEl.style.display = "inline"; // show +
        }

        toggleEl.addEventListener("click", function (e) {
          e.stopPropagation();
          const isExpanded = journal.classList.toggle("expanded");
          textEl.textContent = isExpanded ? fullText : truncated;
          toggleEl.textContent = isExpanded ? " −" : " +";
        });
      });

      // const journals = document.querySelectorAll(".jove-abstract-block__journal");

      // journals.forEach(journal => {
      //   const textEl = journal.querySelector(".text-content");
      //   const toggleEl = journal.querySelector(".read-toggle");

      //   // Check if the text overflows its container
      //   const isOverflowing = textEl.scrollWidth > textEl.clientWidth;

      //   if (isOverflowing) {
      //     toggleEl.style.display = "inline"; // Show the +
      //   }

      //   toggleEl.addEventListener("click", function(e) {
      //     e.stopPropagation();
      //     journal.classList.toggle("expanded");
      //     this.textContent = journal.classList.contains("expanded") ? " −" : " +";
      //   });
      // });
      
      // const elements = document.querySelectorAll(".jove-abstract-block__journal");

      // elements.forEach(container => {
      //   const link = container.querySelector("a");
      //   if (!link) return;

      //   const fullText = link.textContent.trim();
      //   const maxLength = 65;

      //   if (fullText.length > maxLength) {
      //     const shortText = fullText.slice(0, maxLength);

      //     // Avoid duplicate toggle
      //     if (container.querySelector(".read-toggle")) return;

      //     // Create span to hold the text (to prevent HTML corruption)
      //     const textSpan = document.createElement("span");
      //     textSpan.className = "text-content";
      //     // textSpan.textContent = shortText;

      //     // Replace link text with span inside link
      //     // link.textContent = ""; // Clear original
      //     link.appendChild(textSpan);

      //     const toggle = document.createElement("span");
      //     toggle.className = "read-toggle";
      //     toggle.textContent = " +";
      //     container.appendChild(toggle);

      //     let isExpanded = false;

      //     toggle.addEventListener("click", () => {
      //       isExpanded = !isExpanded;
      //       // textSpan.textContent = isExpanded ? fullText : shortText;
      //       toggle.textContent = isExpanded ? " -" : " +";
      //     });
      //   }
      // });
    }
    
    // Initial run
    processAllAuthorLists();
    processAllAffiliations();
    processAllJournals();

    // One shared observer to prevent conflict
    const observer = new MutationObserver(() => {
      processAllAuthorLists();
      processAllAffiliations();
      // processAllJournals();
    });

    observer.observe(document.body, { childList: true, subtree: true });
		  
        /* ----------- Filter 2023 Articles Button Logic ----------- */


        /* ----------- Footer Toggle Logic ----------- */
         /*document.querySelectorAll(".site-footer .wp-block-heading").forEach((heading) => {
          const next = heading.nextElementSibling;
          if (next?.classList.contains("wp-block-list")) {
            next.classList.add("footer-collapsed");
            heading.style.cursor = "pointer";
            heading.addEventListener("click", () => {
              next.classList.toggle("footer-collapsed");
              next.classList.toggle("footer-expanded");
            });
          }
        });*/
        document.querySelectorAll(".site-footer .wp-block-heading").forEach((heading) => {
          const next = heading.nextElementSibling;
          if (next?.classList.contains("wp-block-list")) {
            next.classList.add("footer-collapsed");
            heading.style.cursor = "pointer";

            heading.addEventListener("click", () => {
              next.classList.toggle("footer-collapsed");
              next.classList.toggle("footer-expanded");
              heading.classList.toggle("submenu-open"); // Toggle the class here
            });
          }
        });

        /* ----------- Range Field Edit Logic ----------- */
        const minSpan = document.getElementById('min-value');
        const maxSpan = document.getElementById('max-value');
        const minSlider = document.getElementById('min');
        const maxSlider = document.getElementById('max');

        function makeEditable(span, slider, minLimit, maxLimit) {
          const input = document.createElement('input');
          input.type = 'text';
          input.min = minLimit;
          input.max = maxLimit;
          input.value = span.textContent.trim();
          input.style.width = (span.offsetWidth || 40) + 'px';
          input.style.border = '1px solid #ccc';
          input.style.fontSize = '11px';
          input.style.fontWeight = '500';
          input.style.textAlign = 'center';
          input.style.margin = '0';
          input.style.padding = '8px';
          input.style.background = 'transparent';

          span.replaceWith(input);

          slider.addEventListener('input', () => {
            input.value = slider.value;
          });

          input.addEventListener('blur', () => {
            updateSliderFromInput(input, slider, minLimit, maxLimit);
          });

          input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') input.blur();
          });
        }

        function updateSliderFromInput(input, slider, minLimit, maxLimit) {
          let val = parseInt(input.value);
          if (isNaN(val)) val = minLimit;
          val = Math.max(minLimit, Math.min(maxLimit, val));
          input.value = val;
          slider.value = val;
          slider.dispatchEvent(new Event('change'));
        }

        if (minSpan && maxSpan && minSlider && maxSlider) {
          makeEditable(minSpan, minSlider, 2000, parseInt(maxSlider.value));
          makeEditable(maxSpan, maxSlider, parseInt(minSlider.value), 2025);
        }

        /* ----------- Filter Toggle on Mobile View ----------- */
        /*const filterButton = document.querySelector('.jove-filters_icon_button');
        const filters = document.querySelector('.inner-filter');
        if (filterButton && filters) {
          filterButton.addEventListener('click', () => {
            filters.classList.toggle('show');
          });
        }*/
        const filterButton = document.querySelector('.jove-filters_icon_button');
        const filters = document.querySelector('.inner-filter');
        const closeIcon = document.querySelector('.filter-close-icon'); // Add this line

        if (filterButton && filters) {
          filterButton.addEventListener('click', () => {
            filters.classList.toggle('show');
          });
        }

        if (closeIcon && filters) {
          closeIcon.addEventListener('click', () => {
            filters.classList.remove('show');
          });
        }
      });
	
// Video notification Popup
	document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.jove-info-toggle').forEach(function(toggleBtn) {
    toggleBtn.addEventListener('click', function () {
      const wrapper = toggleBtn.closest('.jove-experiment-video-block')
        .querySelector('.jove-experiment-video-block__toggle-wrapper');
        
      if (wrapper) {
        wrapper.style.display = (wrapper.style.display === 'none' || wrapper.style.display === '') ? 'block' : 'none';
      }
    });
  });
});
	
    </script>
    <?php
}



add_action('init', 'jova_add_video_rewrite_rule');
function jova_add_video_rewrite_rule() {
    add_rewrite_rule(
        '^video/([^/]+)$',
        'index.php?video_post_slug=$matches[1]',
        'top'
    );
      // Sitemap URL pattern (e.g., page-sitemap.xml)
      add_rewrite_rule('^page-sitemap([0-9]+)\.xml$', 'index.php?page_sitemap=1&pg=$matches[1]', 'top');

      //  add_rewrite_rule('^sitemap_index\.xml$', 'index.php?sitemap_index=1', 'top');
      add_rewrite_rule('^sitemap_index\.xml$', 'index.php?sitemap_index=1', 'top');
}

add_filter('query_vars', 'jova_add_query_vars');
function jova_add_query_vars($vars) {
    // $vars[] = 'video_post_slug';
    $vars[] = 'video_post_slug';
    $vars[] = 'page_sitemap';
    $vars[] = 'pg';
    $vars[] = 'sitemap_index';
    return $vars;
}

add_action('template_redirect', function () {
  if (get_query_var('page_sitemap')) {
    $paged = max(1, (int) get_query_var('pg'));
    echo generate_html_page_sitemap($paged);
    exit;
}

if (get_query_var('sitemap_index')) {
    echo generate_html_sitemap_index();
    exit;
}
});
function generate_html_page_sitemap($paged = 1) {
  $per_page = 50;
  $offset = ($paged - 1) * $per_page;

  $all_pages = get_posts([
      'post_type' => 'page',
      'post_status' => 'publish',
      'numberposts' => -1,
      'orderby' => 'modified',
      'order' => 'DESC',
  ]);

  $total = count($all_pages);
  $total_pages = ceil($total / $per_page);
  $sliced_pages = array_slice($all_pages, $offset, $per_page);
  $base = home_url('/');

  ob_start();
  include get_template_directory() . '/page-sitemap-index.php';

  return ob_get_clean();
}


function generate_html_sitemap_index() {
  $per_page = 50;

  $all_pages = get_posts([
      'post_type' => 'page',
      'post_status' => 'publish',
      'numberposts' => -1,
  ]);

  $total = count($all_pages);
  $total_sitemaps = ceil($total / $per_page);
  $base = home_url('/');

  ob_start();
  include get_template_directory() . '/page-sitemap-template.php';
  ?>
  
  <?php
  return ob_get_clean();
}
add_action('init', function() {
    flush_rewrite_rules();
});

add_filter('template_include', function ($template) {
    if ($slug = get_query_var('video_post_slug') ) {
       global $jove_slug_data;
         // You can change this path if needed
         $article_data_api_url = JOVE_VIDEO_API_URL."pubmed-by-slug/$slug/";
         $jove_slug_data = \Jove\Inc\Jove_API::fetch_jove_api_data( $article_data_api_url );
        if ( isset($jove_slug_data['data']) && isset( $jove_slug_data['data']['pubmedId'] ) ) {     
            $new_template = locate_template('single-video.php');
            if ($new_template) {
              return $new_template; // Return the custom template if found
            }
        }
        return get_404_template();
        
    }
    return $template;
});

add_action('parse_request', 'custom_fake_video_post');
function custom_fake_video_post($wp) {
    if (
        isset($wp->query_vars['post_type']) &&
        $wp->query_vars['post_type'] === 'video' &&
        isset($wp->query_vars['name'])
    ) {
        $slug = $wp->query_vars['name'];

        // Optionally: define some allowed slugs or handle them dynamically
        if (is_valid_custom_slug($slug)) {
            add_filter('the_posts', function($posts) use ($slug) {
                // Create a fake post object
                $post = new stdClass();
                $post->ID = -1;
                $post->post_title = ucwords(str_replace('-', ' ', $slug));
                $post->post_name = $slug;
                $post->post_type = 'video';
                $post->post_status = 'publish';

                return [$post];
            });
        }
    }
}

function is_valid_custom_slug($slug) {
    // Optionally validate allowed slugs, patterns, etc.
    return preg_match('/^[a-z0-9\-]+$/', $slug);
}


add_filter('body_class', function ($classes) {
  if (get_query_var('video_post_slug')) {
      $classes[] = 'single-video';
  }
  return $classes;
});


// change other SEO settings
add_action('wp_head', 'inject_jove_seo_tags', 6);
function inject_jove_seo_tags() {
  if (get_query_var('video_post_slug')) {    
    global $jove_seo_data;
      if ( empty($jove_seo_data) ) {
        return;
      }

      $author_names = [];
      if (!empty($jove_seo_data['structured_data']['author']) && is_array($jove_seo_data['structured_data']['author'])) {
          foreach ($jove_seo_data['structured_data']['author'] as $author) {
              if (!empty($author['name'])) {
                  $author_names[] = $author['name'];
              }
          }
      }
      $all_authors = implode(', ', $author_names);
      $meta_title = esc_attr($jove_seo_data['meta_title'] ?? '');
      $description = esc_attr($jove_seo_data['meta_description'] ?? '');
      $keywords = esc_attr(implode(', ', $jove_seo_data['keywords'] ?? []));
      $canonical = esc_url($jove_seo_data['canonical_url'] ?? '');
      $structured_data = $jove_seo_data['structured_data'] ?? null;
      echo "<link rel=\"canonical\" href=\"{$canonical}\" />\n";
      echo "<meta property=\"og:title\" content=\"{$meta_title}\" />\n";      
      echo "<meta name=\"description\" content=\"{$description}\" />\n";
      echo "<meta name=\"keywords\" content=\"{$keywords}\" />\n";
      echo "<meta name=\"author\" content=\"" . esc_attr($all_authors) . "\" />\n";
      echo "<meta name=\"publisher\" content=\"" . esc_attr($jove_seo_data['structured_data']['isPartOf']['name']) . "\" />\n";

       if ($structured_data) {
            echo "<script type=\"application/ld+json\">\n" . json_encode($structured_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n</script>\n";
        }
    }
}
// Set title dynamically using the filter
add_filter('pre_get_document_title', 'custom_wp_title',999);
function custom_wp_title($title) {
      
    if (get_query_var('video_post_slug')) {
      global $jove_seo_data;
      if ( empty($jove_seo_data) ) {
        return;
      }
        // Fetch the title dynamically (from API or elsewhere)
      //  $data =  get_seo_data();
        if ($jove_seo_data && isset($jove_seo_data['meta_title'])) {
            return esc_html($jove_seo_data['meta_title']); // Set custom title
        }
    }
    return $title; // Default title if no video post slug
}


// ROBOT CHAGE SEO
add_filter('wp_robots', function ($robots) {
  if (get_query_var('video_post_slug')) {
      global $jove_seo_data;

      if (empty($jove_seo_data)) {
          return $robots;
      }

      // Case: robots_meta explicitly says "noindex,nofollow"
      if (
          isset($jove_seo_data['robots_meta']) &&
          strtolower(trim($jove_seo_data['robots_meta'])) === 'noindex,nofollow'
      ) {
          $robots['noindex'] = true;
          $robots['nofollow'] = true;
          unset($robots['index'], $robots['follow']);
      }
      // Case: index_flag is false or missing
      elseif (empty($jove_seo_data['index_flag'])) {
          $robots['noindex'] = true;
          $robots['follow'] = true;
          unset($robots['index'], $robots['nofollow']);
      }
      // Case: index_flag is true
      else {
          $robots['index'] = true;
          $robots['follow'] = true;
          unset($robots['noindex'], $robots['nofollow']);
      }
  }

  return $robots;
});



// add_filter('wp_robots', function ($robots) {
//   // Optional: restrict to specific pages
//   if (get_query_var('video_post_slug')) {
//     global $jove_seo_data;
//     if (empty($jove_seo_data)) {
//         return $robots; // Always return something
//     }
      
//       // $data = get_seo_data();
//       if ($jove_seo_data && isset($jove_seo_data['robots_meta'])) {
//           $robots['index'] = true;
//           $robots['follow'] = true;
//           $robots['max-image-preview'] = 'none'; // optional
//       }
//   }

//   return $robots; // ✅ always return
// });

// SEO API CALLED HERE
add_action('template_redirect', 'get_seo_data');
function get_seo_data(){
  global $jove_seo_data;
  if ( ! get_query_var('video_post_slug') ) {
    return;
  }
  if ( get_query_var('video_post_slug') ) {

    // Set a global flag we can check in filters

    $GLOBALS['disable_rankmath_meta'] = true;

    remove_all_filters('wp_robots');

}
  $video_slug = jove_get_video_slug_from_url();
  $seo_data = \Jove\Inc\Jove_API::fetch_jove_api_data(JOVE_VIDEO_API_URL . "seo/by-slug/$video_slug");
  if(isset($seo_data['success']) && '1' == $seo_data['success'] && isset($seo_data['data']) && !empty($seo_data['data']) && is_array($seo_data['data'])) {
    $jove_seo_data = $seo_data['data'];
  }
}

/*
 * Get Video Slug
 */
if(!function_exists('jove_get_video_slug_from_url')) {
  function jove_get_video_slug_from_url() {

    // Parse the URL to get the path
    $protocol = is_ssl() ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $request_uri = $_SERVER['REQUEST_URI'];
    
    $current_url = $protocol . $host . $request_uri;
    
    $path = parse_url($current_url, PHP_URL_PATH);
    // Use explode to split the path by "/"
    $segments = explode('/', trim($path, '/'));
    $url_slug = '';
    // Check if "video" exists in the segments
    if (($key = array_search('video', $segments)) !== false && isset($segments[$key + 1])) {
        $url_slug = $segments[$key + 1];
    }
    return $url_slug;
  }
}

add_filter('redirect_canonical', function ($redirect_url, $requested_url) {
    if (get_query_var('video_post_slug')) {
        return false;
    }
    return $redirect_url;
}, 10, 2);

// Remove SEO Data for video Articles
// Remove Canonical URL
// add_filter( 'rank_math/frontend/canonical', function( $canonical ) {  
//   if ( get_query_var('video_post_slug') ) {    
//     // Return false to completely disable Rank Math's canonical tag
//     return false;
//   }
//   return $canonical;
// }, 99);
// // Disable meta description conditionally
// add_filter( 'rank_math/frontend/description', function( $description ) {
// 	if ( get_query_var( 'video_post_slug' ) ) {
// 		return false;
// 	}
// 	return $description;
// }, 99);
// // Remove SEO schema
// add_filter( 'rank_math/json_ld', function( $data ) {
// 	if ( ! empty( $GLOBALS['disable_rankmath_meta'] ) ) {    
// 		return [];
// 	}
// 	return $data;
// }, 99);

// // Disable Open Graph title and description conditionally
// add_filter( 'rank_math/opengraph/facebook', function( $title ) {
//   if ( ! empty( $GLOBALS['disable_rankmath_meta'] ) ) {
//       return false;
//   }
// 	return $title;
// }, 99999);
// // remove og:description
// add_filter( 'rank_math/opengraph/facebook/description', function( $description ) {
// 	if ( get_query_var( 'video_post_slug' ) ) {
// 		return false;
// 	}
// 	return $description;
// }, 99);

// // Optional: Twitter OG equivalents
// add_filter( 'rank_math/opengraph/twitter/title', function( $title ) {
// 	if ( get_query_var( 'video_post_slug' ) ) {
// 		return false;
// 	}
// 	return $title;
// }, 99);
// // remove twitter description
// add_filter( 'rank_math/opengraph/twitter/description', function( $description ) {
// 	if ( get_query_var( 'video_post_slug' ) ) {
// 		return false;
// 	}
// 	return $description;
// }, 99);
// // disable opengraph tags
// add_filter( 'rank_math/opengraph/enabled', function( $enabled ) {
//   if ( ! empty( $GLOBALS['disable_rankmath_meta'] ) ) {
//       return false;
//   }
//   return $enabled;
// }, 99999);
// // disable twitter tags
// add_filter( 'rank_math/twitter/enabled', function( $enabled ) {
//   if ( ! empty( $GLOBALS['disable_rankmath_meta'] ) ) {
//       return false;
//   }
//   return $enabled;
// }, 99999 );
// // disable facebook title
// add_filter( "rank_math/opengraph/facebook/og_title", function( $content ) {
//   if ( get_query_var( 'video_post_slug' ) ) {
//     $content = "";
//   }
//   return $content;
// });
//   // disable twitter title
// add_filter( "rank_math/opengraph/twitter/twitter_title", function( $content ) {
//   if ( get_query_var( 'video_post_slug' ) ) {
//     $content = "";
//   }
//   return $content;
// });

add_action('wp_head', function () {
    if (!is_singular('video')) {
        return;
    }

    global $post;

    // Get custom author and publisher (ACF fields or meta fields)
    $author_name = get_field('author_affiliation', $post->ID);
    $publisher_name = get_bloginfo('name');

    // Logo URL (customize or fetch from theme settings)
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo_url = $custom_logo_id ? wp_get_attachment_image_url($custom_logo_id, 'full') : 'https://yourdomain.com/logo.png';

    // Fallback if empty
    if (!$author_name) {
        $author_name = get_the_author_meta('display_name', $post->post_author);
    }

    // Optional: Video URL or embed
    $video_url = get_field('video_url', $post->ID); // Change field name if needed
    if (!$video_url) {
        $video_url = get_permalink($post); // fallback
    }

    $schema = [
        "@context" => "https://schema.org",
        "@type" => "VideoObject",
        "name" => get_the_title($post),
        "description" => get_the_excerpt($post),
        "uploadDate" => get_the_date(DATE_W3C, $post),
        "contentUrl" => $video_url,
        "author" => [
            "@type" => "Person",
            "name" => $author_name,
        ],
        "publisher" => [
            "@type" => "Organization",
            "name" => $publisher_name,
            "logo" => [
                "@type" => "ImageObject",
                "url" => $logo_url,
            ]
        ]
    ];
print_r($schema);die;
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
});
