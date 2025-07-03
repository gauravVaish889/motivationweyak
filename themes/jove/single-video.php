<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<?php
use Jove\Inc\Utils;
use Jove\Inc\Jove_API;
global $jove_slug_data;
// Render the header block template part
echo do_blocks('<!-- wp:template-part {"slug":"innerpage-header","tagName":"header","className":"site-header"} /-->');
$block = parse_blocks('<!-- wp:search {"placeholder":"Explore research articles","buttonText":"Search","className":"single-video-mobile-search","style":{"color":{"background":"#213ced"},"border":{"color":"#213ced","radius":"0px"}},"fontFamily":"inter"} /-->');
echo render_block($block[0]);

// Get Video Slug
$current_url = home_url(add_query_arg([], $wp->request));

// Parse the URL to get the path
$path = parse_url($current_url, PHP_URL_PATH);

// Use explode to split the path by "/"
$segments = explode('/', trim($path, '/'));
$url_slug = '';
// Check if "video" exists in the segments
if (($key = array_search('video', $segments)) !== false && isset($segments[$key + 1])) {
    $url_slug = $segments[$key + 1];
}
$video_not_found = true;
// check if slug exists
if(isset($url_slug) && !empty($url_slug) && $url_slug != 'NA') {
    $article_data_api_url = JOVE_VIDEO_API_URL."pubmed-by-slug/$url_slug/";
    $article_video_api_url = JOVE_VIDEO_API_URL."videos/by-slug/$url_slug/";

    // $article_data_api_url = JOVE_VIDEO_API_URL."pubmed-by-slug/pubmed-article-37978806/";
    // $article_video_api_url = JOVE_VIDEO_API_URL."videos/by-slug/pubmed-article-37978806/";

    // $article_data_api_url = JOVE_VIDEO_API_URL_MOCK.'f57332d9-61c9-4ef4-a5b6-98348dd7493a';
    // $article_video_api_url = JOVE_VIDEO_API_URL_MOCK.'22a5947a-2ac6-4845-9039-520faee3c538';

    $article_data = $jove_slug_data;
    if(empty($article_data) && !isset($article_data)){
        $article_data = Jove_API::fetch_jove_api_data( $article_data_api_url );
    }
    
    $article_video_data = Jove_API::fetch_jove_api_data( $article_video_api_url );
    
    
    $data = [];
    if(isset($article_data['success']) && '1' == $article_data['success'] && isset($article_data['data']) && !empty($article_data['data'])) {
        $data = array_merge($data, $article_data['data']);        
    }
    if(isset($article_video_data['success']) && '1' == $article_video_data['success'] && isset($article_video_data['data']) && !empty($article_video_data['data'])) {
        //    print_r($article_video_data['data']);
        
        if ( isset( $article_video_data['data']['pubmedId'] ) ) {        
            $data = array_merge($data, $article_video_data['data']);
        }else if((!isset($article_video_data['data']['experiment_videos']) && empty($article_video_data['data']['experiment_videos']) ) || (!isset($article_video_data['data']['concept_videos']) && empty($article_video_data['data']['concept_videos']) ) ){
            if(isset($data['title']) && !empty($data['title'])) {
                $article_title = strtolower($data['title']);
                // 2. Remove special characters (keep letters, numbers, spaces, and hyphens)
                $article_title = preg_replace('/[^a-z0-9\s-]/', '', $article_title);
                // 3. Replace multiple spaces/hyphens with a single hyphen
                $article_title = preg_replace('/[\s-]+/', '-', $article_title);
                // 4. Trim hyphens from start/end
                $article_title = trim($article_title, '-');
                $article_video_api_url = APP_JOVE_LIVE_URL.'api/free/search/search_ai';
                $experiment = $concept = [];
                if(!isset($article_video_data['data']['experiment_videos']) && empty($article_video_data['data']['experiment_videos'])){
                    $post_body_exp = [
                        'query'            => $article_title,
                        'page'             => 1,
                        'per_page'         => 10,
                        'category_filter[0]' => 'journal',
                    ];
                
                    $article_video_data_exp = Jove_API::fetch_jove_api_data( $article_video_api_url, 'post' , $post_body_exp);
                    
                    if(isset($article_video_data_exp['data']['content']['result']) && !empty($article_video_data_exp['data']['content']['result']) && is_array($article_video_data_exp['data']['content']['result'])) {
                        foreach ($article_video_data_exp['data']['content']['result'] as $val) {                     
                            
                            if (isset($val['lengthMinutes']) && $val['lengthMinutes'] != "00:00") {                           
                                $video_data = [
                                    'joveTitle' => $val['title'],
                                    'seoTitle' => $val['seoTitle'],
                                    'excerpt' => $val['excerpt'],
                                    'publicationDate' => $val['published_at'],
                                    'thumbnail' => $val['header_image'],
                                    'video' => 'https://app.jove.com/v/' . $val['id'],
                                    'views' => $val['total_count_views'],
                                    'lengthMinutes' => $val['lengthMinutes'],
                                    'type' => $val['article_type'],
                                    'path' => $val['path']
                                ];
                            }   
                            $experiment[] = $video_data;
                            // $concept[] = $video_data;
                        }
                    }
                    $experiment = array_values(array_unique($experiment, SORT_REGULAR));
                    $article_video_data_new['data']['experiment_videos'] = $experiment;
                }
                if(!isset($article_video_data['data']['concept_videos']) && empty($article_video_data['data']['concept_videos'])){
                        $post_body_concept = [
                            'query'            => $article_title,
                            'page'             => 1,
                            'per_page'         => 10,
                            'category_filter[0]' => 'jove_core',
                        ];
                        $article_video_data_concept = Jove_API::fetch_jove_api_data( $article_video_api_url, 'post' , $post_body_concept);
                                        
                        if(isset($article_video_data_concept['data']['content']['result']) && !empty($article_video_data_concept['data']['content']['result']) && is_array($article_video_data_concept['data']['content']['result'])) {
                            foreach ($article_video_data_concept['data']['content']['result'] as $val) {
                                if (isset($val['lengthMinutes']) && $val['lengthMinutes'] != "00:00") {
                                    $video_data = [
                                        'joveTitle' => $val['title'],
                                        'seoTitle' => $val['seoTitle'],
                                        'excerpt' => $val['excerpt'],
                                        'publicationDate' => $val['published_at'],
                                        'thumbnail' => $val['header_image'],
                                        'video' => 'https://app.jove.com/v/' . $val['id'],
                                        'views' => $val['total_count_views'],
                                        'lengthMinutes' => $val['lengthMinutes'],
                                        'type' => $val['article_type'],
                                        'path' => $val['path']
                                    ];
                                }
                                $concept[] = $video_data;
                            }
                        }
                        $concept = array_values(array_unique($concept, SORT_REGULAR));
                        $concept = array_slice($concept, 0, 6);
                        $article_video_data_new['data']['concept_videos'] = $concept;
                }             
                
                $data = array_merge($data, $article_video_data_new['data']);
            }
           
        }
       
    }
    if(!empty($data)) {
        $video_not_found = false;
        ?>
        <main class="wp-block-group has-background is-layout-flow wp-block-group-is-layout-flow" style="background-color:#f5f5f5;margin-top:0" id="wp--skip-link--target">
            <div class="wp-block-group alignwide jove-main-content is-layout-flow wp-block-group-is-layout-flow"> 
                <div class="alignwide wp-block-acf-breadcrumbs" id="jove-block-id-3">
                    <div class="jove-breadcrumbs">
                        <nav role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs has-sep-mask-chevron" itemprop="breadcrumb">
                            <ul class="trail-items" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                                <meta name="numberOfItems" content="3">
                                <meta name="itemListOrder" content="Ascending">
                                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="trail-item trail-begin">
                                    <span itemprop="item">
                                        <span itemprop="name">
                                            <a href="<?php echo esc_url(home_url()); ?>" rel="home">Home</a>
                                        </span>
                                    </span>
                                    <meta itemprop="position" content="1">
                                </li>
                                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="trail-item trail-end">
                                    <span itemprop="name"><?php echo esc_attr( $data['title'] , 'jove' ); ?></span>
                                    <meta itemprop="position" content="3">
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="wp-block-columns is-layout-flex wp-container-core-columns-is-layout-2 wp-block-columns-is-layout-flex">
                    <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:62%">
                        <div class="alignwide wp-block-acf-abstract" id="jove-block-id-4">
                            <div class="alignwide wp-block-acf-abstract">
                                <div class="jove-abstract-block__entry-header">
                                    <h1 class="jove-abstract-block__heading"><?php echo html_entity_decode( $data['title']); ?></h1>
                                </div>
                                <div class="jove-abstract-block">
                                    <div class="jove-abstract-block__authors-affiliations">
                                        <?php if(isset($data['authors']) && !empty($data['authors'])):  ?>                                        
                                            <div class="jove-abstract-block__authors">
                                                <ul class="jove-abstract-block__authors">
                                                   
                                                        <li >
                                                            <?php foreach($data['authors'] as $key => $author): 
                                                            $author_url = $author['name'] ?>
                                                            <a href="<?php home_url();?>/?s=&author=<?php echo esc_attr(strtolower( str_replace( ' ', '-', $author['name'] ) )); ?>"><?php echo esc_attr( $author['name'], 'jova'); ?></a>
                                                            <?php if(isset($author['affiliations']) && !empty($author['affiliations'])):
                                                                $affiliations = implode("," , $author['affiliations']);?>
                                                                <sup><?php echo $affiliations; ?> </sup>
                                                                <?php if(count($data['authors']) != $key+1): ?>    <?php echo ', ';?> <?php endif; ?>
                                                            <?php endif; ?>
                                                            <!-- <?php if(count($data['authors']) > 4): ?>
                                                                <span style="cursor: pointer; color: rgb(33, 60, 237); margin-left: 5px;"> + <?php echo (count($data['authors']));?></span>
                                                            <?php endif; ?> -->
                                                            <?php endforeach; ?>    
                                                        </li>
                                                                                            
                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(isset($data['affiliations']) && !empty($data['affiliations'])):  ?>                                        
                                            <div class="jove-affiliations-accordion__content">
                                                <ul class="jove-abstract-block__affiliations">
                                                    <?php foreach($data['affiliations'] as $key => $val): 
                                                        $author_url = $author['name'] ?>
                                                        <li>
                                                            <sup><?php echo $key; ?></sup>
                                                            <?php echo esc_attr( $val, 'jova'); ?>
                                                            <!-- <?php if(count($data['affiliations']) > 2): ?>
                                                                <span style="cursor: pointer; color: rgb(33, 60, 237); margin-left: 5px;"> + <?php echo (count($data['affiliations']));?></span>
                                                            <?php endif; ?> -->
                                                        </li>
                                                    <?php endforeach; ?>                                            
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="artical-metapost-data">
                                        <div class="artical-meta-inner">
                                        <div class="jove-abstract-block__journal">
                                                <a href="javascript:void(0);" rel="tag"><span class="text-content" data-full-text="<?php echo esc_attr($data['journalTitle']); ?>"><?php echo esc_attr($data['journalTitle']); ?></span></a>
                                                <span class="read-toggle"> +</span>
                                            </div>
                                            <div class="jove-abstract-block__date">
                                                <p class="jove-abstract-block__date_lable">|</p>
                                                <?php $date_string = $data['publish_date']; // Example input
                                                        $timestamp = strtotime($date_string);
                                                        $formatted_date = date('F j, Y', $timestamp);
                                                        ?>
                                                <div class="jove-abstract-block__date_line"><?php echo ($formatted_date); ?></div>
                                            </div>
                                        </div> 	                                           
                                        <div class="jove-abstract-block__social-share">
                                            <ul>
                                                <li><a href="#popup-info" class="open-popup"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2">
                                                        <circle cx="18" cy="5" r="3"></circle>
                                                        <circle cx="6" cy="12" r="3"></circle>
                                                        <circle cx="18" cy="19" r="3"></circle>
                                                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                                    </svg></a>
                                                </li>
                                            </ul>                                          


                                        </div>
                                    </div>

                                    <?php if (isset($data['experiment_videos'] ) && !empty($data['experiment_videos'])):                                     
                                        $filtered_videos = array_filter($data['experiment_videos'], function($value) {
                                            return !empty($value);
                                        });
                                        if(count($filtered_videos) > 3) {
                                            $videos = array_slice($filtered_videos, 0, 3);
                                        } else {
                                            $videos = $filtered_videos;
                                        }?>
                                        <div class="wp-block-column related-video-sidebar  related-video-sidebar-mobile is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:38%"> 
                                                <div class="alignwide wp-block-acf-experiment" id="jove-block-id-6">
                                                    
                                                    <div class="jove-experiment-video-block test">
                                                        <h2 class="jove-experiment-video-block__heading"> 
                                                            <div class="title">Related Experiment Videos</div>
                                                            <div class="jove-info-wrapper"><button class="jove-info-toggle" aria-label="More Info ">
                                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM11 11V17H13V11H11ZM11 7V9H13V7H11Z" fill="#213CED"></path>
                                                                </svg>
                                                            </button><div class="jove-notice__text">
                                                                <p>These videos have been matched automatically. <a href="https://www.jove.com/about/contact">Contact us</a> if they are not relevant.</p>
                                                            </div></div>
                                                            
                                                        </h2>
                                                        <div class="jove-experiment-video-block__container">
                                                            <div class="jove-experiment-video-block__toggle-wrapper" style="display: none;"></div>
                                                            <div class="jove-experiment-video-block__lists">
                                                                <?php foreach ($videos as $key => $experiment_videos):?>
                                                                    <a class="jove-experiment-video-block__list" href="<?php echo esc_url($experiment_videos['video']);?>" rel="noopener" target="_blank">
                                                                        <figure class="jove-experiment-video-block__image">
                                                                        <img src="<?php echo esc_url( APP_JOVE_LIVE_URL . '/_next/image?url=' . urlencode( $experiment_videos['thumbnail'] ) . '&w=828&q=75' ); ?>" 
                                                                            alt="<?php echo esc_attr( $experiment_videos['joveTitle'] ); ?>">
                                                                            <!-- <img src="https://app.jove.com/_next/image?url=<?php echo esc_url($experiment_videos['thumbnail']);?>&amp;w=828&amp;q=75" alt="<?php echo $experiment_videos['joveTitle']; ?>"> -->
                                                                            <span class="jove-experiment-video-block__image__overlay"><?php echo $experiment_videos['lengthMinutes'];?></span>
                                                                        </figure>
                                                                        <div class="jove-experiment-video-block__content">
                                                                            <h3 class="jove-experiment-video-block__title jove-tooltip" data-tooltip="<?php echo $experiment_videos['joveTitle']; ?>">
                                                                                <label class="jove-truncate"><?php echo $experiment_videos['joveTitle']; ?></label>
                                                                            </h3>
                                                                                <p class="jove-experiment-video-block__date">Published on:<?php echo (new DateTime($experiment_videos['publicationDate']))->format('F j, Y'); ?>
                                                                            </p>
                                                                                <div class="jove-experiment-video-block__views">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                                        <circle cx="12" cy="12" r="3"></circle>
                                                                                    </svg>
                                                                                    <?php echo $experiment_videos['views']; ?>                
                                                                                </div>
                                                                        </div>
                                                                    </a>
                                                                    <?php endforeach;?>
                                                                                    
                                                            </div>
                                                            <?php //if(count($data['experiment_videos']) > 3) :
                                                                $encodedTitle = urlencode( $data['title'] );
                                                                $contentType = isset($data['experiment_videos'][0]['type']) ? esc_attr($data['experiment_videos'][0]['type']) : 'journal_content';?>
                                                            <div class="jove-experiment-video-block__button">
                                                            <a href="<?php echo esc_url( APP_JOVE_LIVE_URL . '/search?content_type=' . urlencode( $contentType ) . '_content&page=1&query=' . urlencode( $encodedTitle ) ); ?>" class="wp-block-button__link wp-element-button">
                                                                See all related videos
                                                            </a>
                                                                <!-- <a href="https://app.jove.com/search?content_type=<?php echo $contentType; ?>_content&page=1&query=<?php echo $encodedTitle; ?>" class="wp-block-button__link wp-element-button">See all related videos</a> -->
                                                                
                                                            </div>
                                                            <?php //endif;?>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="wp-block-column related-video-sidebar  related-video-sidebar-mobile is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:38%"> 
                                <div class="alignwide wp-block-acf-experiment" id="jove-block-id-6">
                                    <div class="jove-experiment-video-block test">
                                        <h2 class="jove-experiment-video-block__heading"> 
                                            <div class="title">Related Experiment Videos</div>
                                                <div class="jove-info-wrapper"><button class="jove-info-toggle" aria-label="More Info ">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM11 11V17H13V11H11ZM11 7V9H13V7H11Z" fill="#213CED"></path>
                                                    </svg>
                                                </button><div class="jove-notice__text">
                                                    <p>These videos have been matched automatically. <a href="https://www.jove.com/about/contact">Contact us</a> if they are not relevant.</p>
                                                </div>
                                            </div>  
                                        </h2>                                                    
                                        <div class="jove-experiment-video-block__container">
                                            <div class="jove-experiment-video-block__lists jove-experiment-video-block__lists_no_results">
                                                <div class="jove-experiment-video-block__content">
                                                    <!-- SVG Illustration -->
                                                    <img src="https://jovevisualidev.wpenginepowered.com/wp-content/uploads/2025/04/Group.png" class="no-result-img-icon">
                                                    <h3 class="jove-experiment-video-block__no_result_title">
                                                    We couldn't find related videos.
                                                    </h3>
                                                    <div class="jove-experiment-video-block__no_result_text">
                                                    <p>JoVE has <strong data-start="88" data-end="153" data-is-only-node="">over 25,000 videos of laboratory methods and science concepts</strong> across all areas of  <strong data-start="174" data-end="198">Science and Medicine</strong> to <br>facilitate
                                                    <strong data-start="202" data-end="239">your next breakthrough</strong>.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jove-experiment-video-block__button">
                                                <a href="<?php echo esc_url( APP_JOVE_LIVE_URL);?>" class="wp-block-button__link wp-element-button">
                                                Explore more content on JoVE
                                                </a>                                               
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>
                            </div>                                      
                                    <?php endif; ?>

                                    <?php if(!empty($data['abstract']) || !empty($data['KeywordList']) ): ?>
                                        <div class="jove-abstract-block__entry-content <?php echo (!isset($data['abstract']) || empty($data['abstract'])) ? 'no-abstract-content' : '';?>">
                                            <?php if(isset($data['abstract']) && !empty($data['abstract']) ): ?>
                                                <h2 class="jove-abstract-block__description__heading">
                                                    Abstract       
                                                </h2>
                                                <?php foreach($data['abstract'] as $key => $abstract): ?>
                                                    <div class="jove-abstract-block__description__text">
                                                        <h3 class="wp-block-heading"><?php echo $abstract['level']; ?></h3>
                                                        <p><?php echo $abstract['text'];?></p> 
                                                    </div>
                                                <?php  endforeach; ?>
                                            <?php else: ?>
                                                <h2 class="jove-abstract-block__description__noheading">
                                                    <i>No abstract available</i>
                                                </h2>
                                            <?php endif; ?>

                                            <?php if (isset($data['KeywordList']) && !empty($data['KeywordList'])): ?>
                                                <div class="jove-abstract-block__keywords">
                                                    <h2 class="jove-abstract-block__keywords__label">Keywords:</h2>
                                                    <?php
                                                        $keywords = $data['KeywordList'];
                                                        $links = array_map(function($keyword) {
                                                            $query = urlencode(strtolower($keyword));
                                                            $label = esc_html($keyword);
                                                            $url = esc_url(APP_JOVE_LIVE_URL."search?content_type=journal_content&originalQuery={$label}&page=1&query={$query}");
                                                            return '<a target="_blank" href="' . $url . '" rel="tag">' . $label . '</a>';
                                                        }, $keywords);

                                                        echo implode(' ', $links);
                                                    ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                </div>            
                            </div>            
                        </div>
                    </div>
                    
                    <?php if (isset($data['experiment_videos'] ) && !empty($data['experiment_videos'])): 
                        $filtered_videos = array_filter($data['experiment_videos'], function($value) {
                            return !empty($value);
                        });
                        if(count($filtered_videos) > 3) {
                            $videos = array_slice($filtered_videos, 0, 3);
                        } else {
                            $videos = $filtered_videos;
                        }?>
                        <div class="wp-block-column related-video-sidebar is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:38%; justify-content: start;"> 
                                <div class="alignwide wp-block-acf-experiment" id="jove-block-id-6">
                                    
                                    <div class="jove-experiment-video-block test">
                                        <h2 class="jove-experiment-video-block__heading"> 
                                        <div class="title">Related Experiment Videos</div>
                                            <div class="jove-info-wrapper"><button class="jove-info-toggle" aria-label="More Info ">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM11 11V17H13V11H11ZM11 7V9H13V7H11Z" fill="#213CED"></path>
                                                </svg>
                                            </button><div class="jove-notice__text">
                                                <p>These videos have been matched automatically. <a href="https://www.jove.com/about/contact">Contact us</a> if they are not relevant.</p>
                                            </div></div>
                                            
                                        </h2>
                                        <div class="jove-experiment-video-block__container">
                                            <div class="jove-experiment-video-block__toggle-wrapper" style="display: none;"></div>
                                            <div class="jove-experiment-video-block__lists">
                                                <?php foreach ($videos as $key => $experiment_videos):?>
                                                    <a class="jove-experiment-video-block__list" href="<?php echo esc_url($experiment_videos['video']);?>" rel="noopener" target="_blank">
                                                        <figure class="jove-experiment-video-block__image">
                                                        <img src="<?php echo esc_url( APP_JOVE_LIVE_URL . '/_next/image?url=' . urlencode( $experiment_videos['thumbnail'] ) . '&w=828&q=75' ); ?>" 
                                                            alt="<?php echo esc_attr( $experiment_videos['joveTitle'] ); ?>">
                                                            <!-- <img src="https://app.jove.com/_next/image?url=<?php echo esc_url($experiment_videos['thumbnail']);?>&amp;w=828&amp;q=75" alt="<?php echo $experiment_videos['joveTitle']; ?>"> -->
                                                            <span class="jove-experiment-video-block__image__overlay"><?php echo $experiment_videos['lengthMinutes'];?></span>
                                                        </figure>
                                                        <div class="jove-experiment-video-block__content">
                                                            <h3 class="jove-experiment-video-block__title jove-tooltip" data-tooltip="<?php echo $experiment_videos['joveTitle']; ?>">
                                                                <label class="jove-truncate"><?php echo $experiment_videos['joveTitle']; ?></label>
                                                            </h3>
                                                                <p class="jove-experiment-video-block__date">Published on:<?php echo (new DateTime($experiment_videos['publicationDate']))->format('F j, Y'); ?>
                                                            </p>
                                                                <div class="jove-experiment-video-block__views">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                        <circle cx="12" cy="12" r="3"></circle>
                                                                    </svg>
                                                                    <?php echo $experiment_videos['views']; ?>                
                                                                </div>
                                                        </div>
                                                    </a>
                                                    <?php endforeach;?>
                                                                    
                                            </div>
                                            <?php //if(count($data['experiment_videos']) > 3) :
                                                $encodedTitle = urlencode( $data['title'] );
                                                $contentType = isset($data['experiment_videos'][0]['type']) ? esc_attr($data['experiment_videos'][0]['type']) : 'journal_content';?>
                                            <div class="jove-experiment-video-block__button">
                                            <a href="<?php echo esc_url( APP_JOVE_LIVE_URL . '/search?content_type=' . urlencode( $contentType ) . '_content&page=1&query=' . urlencode( $encodedTitle ) ); ?>" class="wp-block-button__link wp-element-button">
                                                See all related videos
                                            </a>
                                                <!-- <a href="https://app.jove.com/search?content_type=<?php echo $contentType; ?>_content&page=1&query=<?php echo $encodedTitle; ?>" class="wp-block-button__link wp-element-button">See all related videos</a> -->
                                                
                                            </div>
                                            <?php //endif;?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <?php else: ?>
                            <div class="wp-block-column related-video-sidebar  related-video-sidebar-mobile is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:38%"> 
                                <div class="alignwide wp-block-acf-experiment" id="jove-block-id-6">
                                    <div class="jove-experiment-video-block test">
                                        <h2 class="jove-experiment-video-block__heading"> 
                                            <div class="title">Related Experiment Videos</div>
                                                <div class="jove-info-wrapper"><button class="jove-info-toggle" aria-label="More Info ">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM11 11V17H13V11H11ZM11 7V9H13V7H11Z" fill="#213CED"></path>
                                                    </svg>
                                                </button><div class="jove-notice__text">
                                                    <p>These videos have been matched automatically. <a href="https://www.jove.com/about/contact">Contact us</a> if they are not relevant.</p>
                                                </div>
                                            </div>  
                                        </h2>                                                    
                                        <div class="jove-experiment-video-block__container">
                                            <div class="jove-experiment-video-block__lists jove-experiment-video-block__lists_no_results">
                                                <div class="jove-experiment-video-block__content">
                                                    <!-- SVG Illustration -->
                                                    <img src="https://jovevisualidev.wpenginepowered.com/wp-content/uploads/2025/04/Group.png" class="no-result-img-icon">
                                                    <h3 class="jove-experiment-video-block__no_result_title">
                                                    We couldn't find related videos.
                                                    </h3>
                                                    <div class="jove-experiment-video-block__no_result_text">
                                                    <p>JoVE has <strong data-start="88" data-end="153" data-is-only-node="">over 25,000 videos of laboratory methods and science concepts</strong> across all areas of  <strong data-start="174" data-end="198">Science and Medicine</strong> to <br>facilitate
                                                    <strong data-start="202" data-end="239">your next breakthrough</strong>.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jove-experiment-video-block__button">
                                                <a href="<?php echo esc_url( APP_JOVE_LIVE_URL);?>" class="wp-block-button__link wp-element-button">
                                                Explore more content on JoVE
                                                </a>                                               
                                            </div>
                                        </div>                                                    
                                    </div>
                                </div>
                            </div> 
                            
                    <?php endif; ?>
                </div>  
                
                <?php if(isset($data['concept_videos']) && !empty($data['concept_videos'])) :
                
                        $concept_videos = $data['concept_videos'];?>
                <div class="alignwide wp-block-acf-concept" id="jove-block-id-7">
                    <div class="jove-concept-video-block">
                        <h2 class="jove-concept-video-block__heading">Related Concept Videos</h2>
                        <div class="jove-concept-video-block__container">

                            <div class="jove-concept-video-block__lists">
                            <?php foreach ($concept_videos as $key => $concept_video):?>
                                <a class="jove-concept-video-block__list" href="<?php echo esc_url($concept_video['video']);?>" rel="noopener" target="_blank">
                                    <figure class="jove-concept-video-block__image">
                                    <img src="<?php echo esc_url( APP_JOVE_LIVE_URL . '/_next/image?url=' . urlencode( $concept_video['thumbnail'] ) . '&w=828&q=75' ); ?>" alt="<?php echo esc_attr( $concept_video['joveTitle'] ); ?>">

                                        <!-- <img src="https://app.jove.com/_next/image?url=<?php echo esc_url($concept_video['thumbnail']);?>&amp;w=828&amp;q=75" alt="<?php echo $concept_video['joveTitle'];?>"> -->
                                        <span class="jove-concept-video-block__image__overlay"> <?php echo $concept_video['lengthMinutes'];?>  </span>
                                    </figure>
                                    <div class="jove-concept-video-block__content">
                                        <h3 class="jove-concept-video-block__title jove-tooltip" data-tooltip="<?php echo $concept_video['joveTitle'];?>">
                                            <label class="jove-truncate"><?php echo $concept_video['joveTitle'];?></label>
                                        </h3>
                                        <div class="jove-concept-video-block__views">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            <?php echo $concept_video['views'];?>            
                                        </div>
                                        <p class="jove-concept-video-block__date">
                                        <?php echo $concept_video['excerpt'];?></p>
                                    </div>
                                </a>
                            <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>

            </div>
            <div id="popup-info" class="mfp-hide" style="text-align:center; background:white; padding:20px; margin:auto;">
                <div class="popup-content">
                    <div class="jove-social-share-header">
                        <h3><?php esc_html_e( 'Share', 'jove' );?></h3>
                        <button class="mfp-close-custom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <!-- <ul class="jove-social-share-list">
                        <?php
                                    $socials = [
                                        'facebook' => [
                                            'name' => esc_html__('Facebook','jove'),
                                            'link' => 'https://www.facebook.com/sharer/sharer.php?u={url}',
                                            'icon' => '<svg
                                                width="20px"
                                                height="20px"
                                                viewBox="0 0 20 20"
                                                aria-hidden="true">
                                                    <path d="M20,10.1c0-5.5-4.5-10-10-10S0,4.5,0,10.1c0,5,3.7,9.1,8.4,9.9v-7H5.9v-2.9h2.5V7.9C8.4,5.4,9.9,4,12.2,4c1.1,0,2.2,0.2,2.2,0.2v2.5h-1.3c-1.2,0-1.6,0.8-1.6,1.6v1.9h2.8L13.9,13h-2.3v7C16.3,19.2,20,15.1,20,10.1z"/>
                                                </svg>'
                                        ],
                                        'twitter' => [
                                            'name' => esc_html__('X (Twitter)','jove'),
                                            'link' => 'https://twitter.com/intent/tweet?url={url}&text={text}',
                                            'icon' => '
                                                <svg
                                                width="20px"
                                                height="20px"
                                                viewBox="0 0 20 20"
                                                aria-hidden="true">
                                                    <path d="M2.9 0C1.3 0 0 1.3 0 2.9v14.3C0 18.7 1.3 20 2.9 20h14.3c1.6 0 2.9-1.3 2.9-2.9V2.9C20 1.3 18.7 0 17.1 0H2.9zm13.2 3.8L11.5 9l5.5 7.2h-4.3l-3.3-4.4-3.8 4.4H3.4l5-5.7-5.3-6.7h4.4l3 4 3.5-4h2.1zM14.4 15 6.8 5H5.6l7.7 10h1.1z"/>
                                                </svg>
                                            '
                                        ],
                                        'linkedin' => [
                                            'name' => esc_html__('LinkedIn','jove'),
                                            'link' => 'https://www.linkedin.com/shareArticle?url={url}&title={text}',
                                            'icon' => '
                                                <svg
                                                width="20px"
                                                height="20px"
                                                viewBox="0 0 20 20"
                                                aria-hidden="true">
                                                    <path d="M18.6,0H1.4C0.6,0,0,0.6,0,1.4v17.1C0,19.4,0.6,20,1.4,20h17.1c0.8,0,1.4-0.6,1.4-1.4V1.4C20,0.6,19.4,0,18.6,0z M6,17.1h-3V7.6h3L6,17.1L6,17.1zM4.6,6.3c-1,0-1.7-0.8-1.7-1.7s0.8-1.7,1.7-1.7c0.9,0,1.7,0.8,1.7,1.7C6.3,5.5,5.5,6.3,4.6,6.3z M17.2,17.1h-3v-4.6c0-1.1,0-2.5-1.5-2.5c-1.5,0-1.8,1.2-1.8,2.5v4.7h-3V7.6h2.8v1.3h0c0.4-0.8,1.4-1.5,2.8-1.5c3,0,3.6,2,3.6,4.5V17.1z"/>
                                                </svg>
                                            '
                                        ],
                                    ];
                                    foreach ( $socials as $key => $value ) {

                                        $url = str_replace(
                                            '{url}',
                                            Utils::urldecode( get_the_permalink() ),
                                            str_replace(
                                                '{text}',
                                                Utils::urldecode( get_the_title() ),
                                                $value['link']
                                            )
                                        );
                                        echo '<li><a href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer" title="' . esc_attr( $value['name'] ) . '">' . $value['icon'] . '</a></li>';
                                    }
                                    ?>
                    </ul> -->
                    <div class="jove-abstract-block__share__link">
                        <?php $slug = get_query_var('video_post_slug');
                        // Get the full current URL
                        $current_url = esc_url(home_url($_SERVER['REQUEST_URI']));
                        ?>
                        <textarea id="copytext" class="jove-abstract-block__share__link-url"><?php echo $current_url; ?></textarea>
                        <button id="copytextbtn" type="button" class="jove-abstract-block__share__link-copy"><?php esc_html_e( 'Copy link', 'jove' ); ?></button>
                    </div>
                </div>
            </div>
        </main>
    <?php
    } else{
        echo '<p>Failed to retrieve API data.</p>';
    }
}

if($video_not_found == true) {
    ?>
    <div class="wp-block-group alignwide jove-main-content is-layout-flow wp-block-group-is-layout-flow"> 
        <div class="wp-block-columns is-layout-flex wp-container-core-columns-is-layout-2 wp-block-columns-is-layout-flex">
            <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:62%"> 
                <div class="" id="jove-block-id-1">
                    <div class="jove-abstract-block__entry-header">
                        <h1 class="jove-abstract-block__heading">No Video Found</h1>
                    </div>
                </div>
            </div>        
        </div>
    </div>  
    <?php
}
?>
<?php
// Render the footer block template part
echo do_blocks('<!-- wp:template-part {"slug":"footer","theme":"jove","tagName":"footer","className":"site-footer"} /-->');
?>
    

<?php wp_footer(); ?>
</body>
</html>