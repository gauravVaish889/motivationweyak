<?php
/**
 * Customize
 *
 * @package Jove
 */

namespace Jove\Inc;

use Jove\Inc\Traits\Singleton;

/**
 * Class Customize
 *
 * @package Jove
 */
class Customize {

  use Singleton;

  /**
   * Protected class constructor to prevent direct object creation
   *
   * This is meant to be overridden in the classes which implement
   * this trait. This is ideal for doing stuff that you only want to
   * do once, such as hooking into actions and filters, etc.
   */
  protected function __construct() {

    /**
     * Set up hooks.
     *
     * This method sets up all the hooks related to the blocks,
     * such as registering block styles and block pattern categories.
     */
    $this->setup_hooks();
  }

  /**
   * Sets up hooks.
   *
   * This method sets up all the hooks related to the blocks,
   * such as registering block styles and block pattern categories.
   *
   * @since 1.0.0
   */
  protected function setup_hooks() {

    /**
     * Actions.
     *
     * @since 1.0.0
     */
    add_action( 'customize_register', [ $this, 'register_customizer_settings' ] );
    add_action( 'wp_head', [ $this, 'inject_script' ] );
  }

  /**
   * Registers the customizer settings for the theme.
   *
   * @since 1.0.0
   *
   * @param WP_Customize_Manager $wp_customize The Customizer object.
   */
  public function register_customizer_settings( $wp_customize ) {
    // Add a new section.
    $wp_customize->add_section(
      'jove_google_section',
      array(
        'title'       => __( 'Google Analytics', 'jove' ),
        'priority'    => 160, // Adjust the order of sections.
        'description' => __( 'Enter your Google AdSense Analytics Tracking ID.', 'jove' ),
      )
    );

    // Add a setting for the custom option.
    $wp_customize->add_setting(
      'jove_google_analytics',
      array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
      )
    );

    // Add a control for the custom text.
    $wp_customize->add_control(
      'jove_google_analytics',
      array(
        'label'       => __( 'Tag ID', 'jove' ),
        'description' => sprintf(__('Enter your Google AdSense Analytics Tag ID (e.g %s).', 'jove'), 'G-1234567890123456'),
        'section'     => 'jove_google_section',
        'settings'    => 'jove_google_analytics',
        'type'        => 'text',
      )
    );
  }

  /**
   * Injects Google Analytics script into the head section.
   *
   * Retrieves the Google Analytics Tracking ID from the theme settings and
   * inserts the corresponding script tags into the head section if the ID is set.
   *
   * @since 1.0.0
   */
    public function inject_script() {
        // Get the Google Analytics Tracking ID from the customizer setting
        $publisher_id = get_theme_mod( 'jove_google_analytics' );

        // Check if the Tracking ID is set and not empty
        if (isset($publisher_id) && !empty($publisher_id)) {
            // Retrieve the plugin version
            $plugin_version = JOVE_VERSION;
            
            // Prepare the output script with the Tracking ID
            $output = <<<EOT
                <!-- auto ad code generated with Jove Google Adsense v{$plugin_version} -->
                <script async src="https://www.googletagmanager.com/gtag/js?id={$publisher_id}"></script>
                <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', '{$publisher_id}');
                </script>
                <!-- / Jove Google Adsense -->
                <!-- Google Tag Manager -->
                <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-NK39RH6L');</script>
                <!-- End Google Tag Manager -->
                EOT;

            // Echo the script to be injected
            echo $output;
        }

        if ( is_front_page() && ! get_query_var('video_post_slug')) {
            // Canonical tag
            echo '<link rel="canonical" href="'.home_url().'" />' . "\n";
            ?>
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Organization",
                "name": "JoVE Visualize",
                "url": "https://visualize.jove.com",
                "logo": "",
                "sameAs": [
                    "https://www.linkedin.com/company/jove/",
                    "https://x.com/JoVEjournal",
                    "https://www.facebook.com/JoVEjournal",
                    "https://www.youtube.com/@JoVEJournal"
                ]
            }
            </script>
            <script type="application/ld+json">
            {
                "@context": "https://schema.org/",
                "@type": "WebSite",
                "name": "JoVE Visualize",
                "url": "https://visualize.jove.com",
                "potentialAction": {
                    "@type": "SearchAction",
                    "target": "https://visualize.jove.com/?s={search_term_string}",
                    "query-input": "required name=search_term_string"
                }
            }
            </script>
            <?php
        }
        

    }
}