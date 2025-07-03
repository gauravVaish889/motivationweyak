<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class OCDI_Demo_Importer {

    public function __construct() {
        add_filter( 'pt-ocdi/import_files', [$this, 'import_files_config'] );
        add_filter( 'pt-ocdi/after_import', [$this, 'ocdi_after_import_setup'] );
        add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
        add_action( 'init', [$this, 'edcare_toolkit_rewrite_flush'] );
    }

    public function import_files_config() {

        // EN demo
        $en_home_prevs = [
          [
            'import_file_name'           => 'Online Academy',
            'import_page_name'           => 'home',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-1.jpg',
            'preview_url'                => 'https://wp.rrdevs.net/edcare/',
          ],
          [
            'import_file_name'           => 'Online Education',
            'import_page_name'           => 'online-education',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-2.jpg',
            'preview_url'                => 'https://wp.rrdevs.net/edcare/online-education/',
          ],
          [
            'import_file_name'           => 'Digital Education',
            'import_page_name'           => 'digital-education',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-3.jpg',
            'preview_url'                => 'https://wp.rrdevs.net/edcare/digital-education/',
          ],
          [
            'import_file_name'           => 'Online Course',
            'import_page_name'           => 'online-course',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-4.jpg',
            'preview_url'                => 'https://wp.rrdevs.net/edcare/online-course/',
          ],
          [
            'import_file_name'           => 'Education Platform',
            'import_page_name'           => 'education-platform',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-5.jpg',
            'preview_url'                => 'https://wp.rrdevs.net/edcare/education-platform/',
          ],
          [
            'import_file_name'           => 'Kindergarten',
            'import_page_name'           => 'kindergarten',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-6.jpg',
            'preview_url'                => 'https://wp.rrdevs.net/edcare/kindergarten/',
          ],
          [
            'import_file_name'           => 'Online Academy 02',
            'import_page_name'           => 'online-academy-02',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-7.jpg',
            'preview_url'                => 'https://wp.rrdevs.net/edcare/online-academy-02/',
          ],
          [
            'import_file_name'           => 'Online Course 02',
            'import_page_name'           => 'online-course-2',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/home-8.jpg',
            'preview_url'                => 'https://wp.rrdevs.net/edcare/online-course-2/',
          ],
        ];

        // Arabic demo
        $arb_home_prevs = [
          [
            'import_file_name'           => 'الأكاديمية الإلكترونية',
            'import_page_name'           => 'home',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/arb-home-1.jpg',
            'preview_url'                => 'https://wprtl.rrdevs.net/edcare/',
          ],
          [
            'import_file_name'           => 'التعليم عبر الإنترنت',
            'import_page_name'           => 'online-education',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/arb-home-2.jpg',
            'preview_url'                => 'https://wprtl.rrdevs.net/edcare/online-education/',
          ],
          [
            'import_file_name'           => 'التعليم الرقمي',
            'import_page_name'           => 'digital-education',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/arb-home-3.jpg',
            'preview_url'                => 'https://wprtl.rrdevs.net/edcare/digital-education/',
          ],
          [
            'import_file_name'           => 'دورة تدريبية عبر الإنترنت',
            'import_page_name'           => 'online-course',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/arb-home-4.jpg',
            'preview_url'                => 'https://wprtl.rrdevs.net/edcare/online-course/',
          ],
          [
            'import_file_name'           => 'منصة التعليم',
            'import_page_name'           => 'education-platform',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/arb-home-5.jpg',
            'preview_url'                => 'https://wprtl.rrdevs.net/edcare/education-platform/',
          ],
          [
            'import_file_name'           => 'روضة أطفال',
            'import_page_name'           => 'kindergarten',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/arb-home-6.jpg',
            'preview_url'                => 'https://wprtl.rrdevs.net/edcare/kindergarten/',
          ],
          [
            'import_file_name'           => 'الأكاديمية الإلكترونية 02',
            'import_page_name'           => 'online-academy-02',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/arb-home-7.jpg',
            'preview_url'                => 'https://wprtl.rrdevs.net/edcare/online-academy-02/',
          ],
          [
            'import_file_name'           => 'الأكاديمية الإلكترونية 02',
            'import_page_name'           => 'online-course-2',
            'import_preview_image_url' => plugin_dir_url(__FILE__) . '../../assets/img/demo/arb-home-8.jpg',
            'preview_url'                => 'https://wprtl.rrdevs.net/edcare/online-course-2/',
          ],
        ];

        $config = [];

        $import_path = trailingslashit( get_template_directory() ) . 'sample-data/';

        foreach ( $en_home_prevs as $key => $prev ) {

            $contents_demo = $import_path . '/english/contents-demo.xml';
            $widget_settings = $import_path . '/english/widget-settings.json';
            $customizer_data = $import_path . '/english/customizer-data.dat';

            $config[] = [
                'import_file_id'               => $key,
                'import_page_name'             => $prev['import_page_name'],
                'import_file_name'             => $prev['import_file_name'],
                'local_import_file'            => $contents_demo,
                'local_import_widget_file'     => $widget_settings,
                'local_import_customizer_file' => $customizer_data,
                'import_preview_image_url'     => $prev['import_preview_image_url'],
                'preview_url'                  => $prev['preview_url'],
            ];
        }

        // Arabic demo
        foreach ( $arb_home_prevs as $key => $prev ) {

            $contents_demo = $import_path . '/arabic/contents-demo.xml';
            $widget_settings = $import_path . '/arabic/widget-settings.json';
            $customizer_data = $import_path . '/arabic/customizer-data.dat';

            $config[] = [
                'import_file_id'               => $key,
                'import_page_name'             => $prev['import_page_name'],
                'import_file_name'             => $prev['import_file_name'],
                'local_import_file'            => $contents_demo,
                'local_import_widget_file'     => $widget_settings,
                'local_import_customizer_file' => $customizer_data,
                'import_preview_image_url'     => $prev['import_preview_image_url'],
                'preview_url'                  => $prev['preview_url'],
            ];
        }

        return $config;
    }

    public function ocdi_after_import_setup( $selected_file ) {

        $this->assign_menu_to_location();
        $this->assign_frontpage_id( $selected_file );
        $this->update_permalinks();
        update_option( 'basa_ocdi_importer_flash', true );
    }

    private function assign_menu_to_location() {

        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

        set_theme_mod( 'nav_menu_locations', [
            'main-menu' => $main_menu->term_id,
        ] );
    }

    private function assign_frontpage_id( $selected_import ) {

    if( "Online Academy" == $selected_import['import_file_name'] ){
      // Assign front page and posts page (blog page).
      $front_page_id = get_page_by_title( 'Online Academy' );
      $blog_page_id  = get_page_by_title( 'Blog' );
    }else if( "Online Education" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Online Education' );
        $blog_page_id  = get_page_by_title( 'Blog' );
    }
    else if( "Digital Education" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Digital Education' );
        $blog_page_id  = get_page_by_title( 'Blog' );
    }
    if( "Online Course" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Online Course' );
        $blog_page_id  = get_page_by_title( 'Blog' );
    }else if( "Education Platform" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Education Platform' );
        $blog_page_id  = get_page_by_title( 'Blog' );
    }
    else if( "Kindergarten" == $selected_import['import_file_name'] ){
      // Assign front page and posts page (blog page).
      $front_page_id = get_page_by_title( 'Kindergarten' );
      $blog_page_id  = get_page_by_title( 'Blog' );
    }
    else if( "Online Course 02" == $selected_import['import_file_name'] ){
      // Assign front page and posts page (blog page).
      $front_page_id = get_page_by_title( 'Online Course 02' );
      $blog_page_id  = get_page_by_title( 'Blog' );
    }
    else if( "Online Academy 02" == $selected_import['import_file_name'] ){
      // Assign front page and posts page (blog page).
      $front_page_id = get_page_by_title( 'Online Academy 02' );
      $blog_page_id  = get_page_by_title( 'Blog' );
    }
    else if( "الأكاديمية الإلكترونية" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'الأكاديمية الإلكترونية' );
        $blog_page_id  = get_page_by_title( 'مدونة' );
    }
    else if( "التعليم عبر الإنترنت" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'التعليم عبر الإنترنت' );
        $blog_page_id  = get_page_by_title( 'مدونة' );
    }
    else if( "التعليم الرقمي" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'التعليم الرقمي' );
        $blog_page_id  = get_page_by_title( 'مدونة' );
    }
    else if( "دورة تدريبية عبر الإنترنت" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'دورة تدريبية عبر الإنترنت' );
        $blog_page_id  = get_page_by_title( 'مدونة' );
    }
    else if( "منصة التعليم" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'منصة التعليم' );
        $blog_page_id  = get_page_by_title( 'مدونة' );
    }
    else if( "روضة أطفال" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'روضة أطفال' );
        $blog_page_id  = get_page_by_title( 'مدونة' );
    }
    else if( "روضة أطفال" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'روضة أطفال' );
        $blog_page_id  = get_page_by_title( 'مدونة' );
    }
    else if( "الأكاديمية الإلكترونية 02" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'الأكاديمية الإلكترونية 02' );
        $blog_page_id  = get_page_by_title( 'مدونة' );
    }
    else if( "الدورات التدريبية عبر الإنترنت 02" == $selected_import['import_file_name'] ){
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'الدورات التدريبية عبر الإنترنت 02' );
        $blog_page_id  = get_page_by_title( 'مدونة' );
    }

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front',  $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
	}

    private function update_permalinks() {
        update_option( 'permalink_structure', '/%postname%/' );
    }

    public function edcare_toolkit_rewrite_flush() {

        if ( get_option( 'basa_ocdi_importer_flash' ) == true ) {
            flush_rewrite_rules();
            delete_option( 'basa_ocdi_importer_flash' );
        }
    }
}

new OCDI_Demo_Importer;