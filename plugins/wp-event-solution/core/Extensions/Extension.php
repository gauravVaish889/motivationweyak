<?php
/**
 * Extentions class
 * 
 * @package Eventin
 */
namespace Eventin\Extensions;

/**
 * Class extention
 */
class Extension {

    /**
     * Get all modules
     *
     * @return  array
     */
    public static function modules() {
        $extentions = self::get();

        return array_filter( $extentions, function( $extension ) {
            return $extension['type'] === 'module';
        } );
    }

    /**
     * Get all addons
     *
     * @return  array
     */
    public static function addons() {
        $extensions = self::get(); // Fixed the typo

        return array_values( array_filter($extensions, function($extension) {
            return $extension['type'] === 'addon';
        } ) );
    }

    /**
     * Get all addons
     *
     * @return  array
     */
    public static function plugins() {
        $extensions = self::get(); // Fixed the typo

        return array_values( array_filter($extensions, function($extension) {
            return $extension['type'] === 'plugin';
        } ) );
    }

    /**
     * Get all extensions
     *
     * @return  array
     */
    public static function get() {
        $extensions = self::extensions();
        
        return array_map( function( $extension ) {
            $settings = get_option( 'etn_addons_options', [] );

            if ( isset( $settings[ $extension['name'] ] ) && $settings[ $extension['name']] === 'on' ) {
                $extension['status'] = 'on';

                if ( 'addon' === $extension['type'] ) {
                    if ( 
                            self::is_need_upgrade( $extension['name'] )
                            && ! PluginManager::is_installed( $extension['slug'] )
                        ) {
                        $extension['status'] = 'upgrade';
                    }

                    if ( PluginManager::is_installed( $extension['slug'] ) ) {
                        $extension['status'] = 'install';
                    }

                    if ( PluginManager::is_activated( $extension['slug'] ) ) {
                        $extension['status'] = 'activate';
                    }
                }

                if ( 'module' === $extension['type'] ) {
                    $dependencies = self::get_depencies( $extension['slug'] );
                    $dependency   = is_array( $dependencies ) ? $dependencies[0] : '';

                    if ( 
                        self::is_need_upgrade( $extension['name'] )
                        && ! PluginManager::is_installed( $dependency )
                    ) {
                        $extension['status'] = 'upgrade';
                    }

                    if ( PluginManager::is_installed( $dependency ) ) {
                        $extension['status'] = 'install';
                    }

                    if ( PluginManager::is_activated( $dependency ) ) {
                        $extension['status'] = 'activate';
                    }
                }
    
                if ( self::dependencies_resolved( $extension['name'] ) ) {
                    $extension['notice'] = false;
                }

            }

            if ( 'plugin' === $extension['type'] ) {
                if ( 
                        self::is_need_upgrade( $extension['name'] )
                        && ! PluginManager::is_installed( $extension['slug'] )
                    ) {
                    $extension['status'] = 'upgrade';
                }

                if ( PluginManager::is_installed( $extension['slug'] ) ) {
                    $extension['status'] = 'install';
                }

                if ( PluginManager::is_activated( $extension['slug'] ) ) {
                    $extension['status'] = 'activate';
                }
            }

            return $extension;
            
        }, $extensions );
    }

    /**
     * Find extension by name
     *
     * @return  array
     */
    public static function find( $name ) {
        $extensions = self::extensions();
        
        if ( array_key_exists( $name, $extensions ) ) {
            return $extensions[$name];  
        }

        return null;
    }

    /**
     * Update extension status
     *
     * @param   string  $name
     *
     * @return  bool | WP_Error
     */
    public static function update( $name, $status ) {
        $extension = self::find( $name );

        if ( ! $extension ) {
            return false;
        }

        $settings = self::get_settings();
        $updated_status = 'off' !== $status ? 'on' : 'off';
        $settings[$name] = $updated_status;

        $slug = ! empty( $extension['slug'] ) ? $extension['slug'] : '';

        $result = true;

        if ( 'addon' === $extension['type'] && 'on' === $updated_status ) {
            if ( ! $slug ) {
                return false;
            }

            if ( 'install' === $status && ! PluginManager::is_installed( $slug ) ) {
                $result = PluginManager::install_plugin( $slug );
            }

            if ( 'activate' === $status && ! PluginManager::is_activated( $slug ) ) {
                $result = PluginManager::activate_plugin( $slug );
            }

            if ( 'deactivate' === $status && PluginManager::is_activated( $slug ) ) {
                $result = PluginManager::deactivate_plugin( $slug );
            }
        }

        if ( 'plugin' === $extension['type'] ) {
            if ( ! $slug ) {
                return false;
            }

            if ( 'install' === $status && ! PluginManager::is_installed( $slug ) ) {
                $result = PluginManager::install_plugin( $slug );
            }

            if ( 'activate' === $status && ! PluginManager::is_activated( $slug ) ) {
                $result = PluginManager::activate_plugin( $slug );
            }

            if ( 'deactivate' === $status && PluginManager::is_activated( $slug ) ) {
                $result = PluginManager::deactivate_plugin( $slug );
            }
        }

        if ( 'addon' === $extension['type'] && 'off' === $status ) {

            if ( ! $slug ) {
                return false;
            }

            if ( PluginManager::is_activated( $slug ) ) {
                $result = PluginManager::deactivate_plugin( $slug );
            }
        }

        if ( 'module' === $extension['type']  && ! empty( $extension['deps'] ) ) {
            $dependency = $extension['deps'][0];
            if ( 'install' === $status && ! PluginManager::is_installed( $dependency ) ) {
                $result = PluginManager::install_plugin( $dependency );
            }

            if ( 'activate' === $status && ! PluginManager::is_activated( $dependency ) ) {
                $result = PluginManager::activate_plugin( $dependency );
            }

            if ( 'deactivate' === $status && PluginManager::is_activated( $dependency ) ) {
                $result = PluginManager::deactivate_plugin( $dependency );
            }
        }

        update_option( 'etn_addons_options', $settings );

        return $result;
    }

    /**
     * Get settings
     *
     * @return  array
     */
    public static function get_settings() {
        $settings = get_option( 'etn_addons_options', [] );

        return $settings;
    }

    /**
     * Check if an extension's dependencies are resolved.
     *
     * @param string $extension_name Name of the extension.
     * @return bool True if all dependencies are resolved, false otherwise.
     */
    public static function dependencies_resolved( $extension_name ) {
        $depencies = self::get_depencies( $extension_name );

        if ( ! $depencies ) {
            return true;
        }

        foreach ( $depencies as $dependency ) {
            if ( ! PluginManager::is_activated( $dependency ) ) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get dependencies
     *
     * @param   string  $extension_name  [$extension_name description]
     *
     * @return array
     */
    public static function get_depencies( $extension_name ) {
        $extension = self::find( $extension_name );

        if ( ! $extension ) {
            return null;
        }

        if ( empty( $extension['deps'] ) ) {
            return null;
        }

        return $extension['deps'];
    }

    /**
     * Get dependencies
     *
     * @param   string  $extension_name  [$extension_name description]
     *
     * @return array
     */
    public static function get_depency_names( $extension_name ) {
        $depencies = self::get_depencies( $extension_name );
        
        $names = [];

        if ( is_array( $depencies ) ) {
            foreach( $depencies as $dependency ) {
                $names[] = PluginManager::get_plugin_name_by_slug( $dependency );
            }
        }

        return $names;
    }

    /**
     * Get dependencies
     *
     * @param   string  $extension_name  [$extension_name description]
     *
     * @return string
     */
    public static function get_depency_string( $extension_name ) {
        $depencies = self::get_depency_names( $extension_name );
        
        return implode( ',', $depencies );
    }

    /**
     * Check a module or addon need to upgrade
     *
     * @param   string  $extension_name  [$extension_name description]
     *
     * @return  bool
     */
    public static function is_need_upgrade( $extension_name ) {
        $extension = self::find( $extension_name );

        if ( ! $extension ) {
            return false;
        }

        if ( isset( $extension['upgrade'] ) && $extension['upgrade'] ) {
            return true;
        }

        return false;
    }
    
    /**
     * List of all extensions
     *
     * @return  array
     */
    private static function extensions() {
        return [
            'dokan' => [
                'name'          => 'dokan',
                'slug'          => 'dokan',
                'type'          => 'module',
                'status'        => 'off',
                'is_pro'        => true,
                'deps'          => ['dokan-lite'],
                'title'         => __( 'Dokan', 'eventin' ),
                'description'   => __( 'It allows you to create a Multivendor Event marketplace and make commission for each sale.', 'eventin' ),
                'icon'          => ExtensionIcon::get( 'dokan' ),
                'notice'        => __( 'NB: Need to active Dokan plugin', 'eventin' ),
                'demo_link'     => 'https://product.themewinter.com/eventin/',
                'settings_link' => '',
                'doc_link'      => 'https://support.themewinter.com/docs/plugins/plugin-docs/integration/multivendor-event-marketplace/',
            ],
            'buddyboss' => [
                'name'          => 'buddyboss',
                'slug'          => 'buddyboss',
                'type'          => 'module',
                'upgrade'       => true,
                'upgrade_link'  => 'https://www.buddyboss.com/pricing',
                'status'        => 'off',
                'is_pro'        => true,
                'deps'          => ['buddyboss'],
                'title'         => __( 'BuddyBoss', 'eventin' ),
                'description'   => __( 'It allows you to create and manage events and sell tickets inside the BuddyBoss theme.', 'eventin' ),
                'icon'          => ExtensionIcon::get( 'buddyboss' ),
                'notice'        => __( 'NB: Need to active BuddyBoss plugin', 'eventin' ),
                'demo_link'     => 'https://product.themewinter.com/eventin/',
                'settings_link' => '',
                'doc_link'      => 'https://support.themewinter.com/docs/plugins/plugin-docs/integration/buddyboss-integration/',
            ],
            'certificate_builder' => [
                'name'          => 'certificate_builder',
                'slug'          => 'certificate_builder',
                'type'          => 'module',
                'status'        => 'off',
                'is_pro'        => true,
                'title'         => __( 'Certificate Builder', 'eventin' ),
                'description'   => __( 'You can design and send a PDF certificate for the event attendee.', 'eventin' ),
                'icon'          => ExtensionIcon::get( 'certificate_builder' ),
                'notice'        => '',
                'demo_link'     => 'https://product.themewinter.com/eventin/',
                'settings_link' => admin_url( 'admin.php?page=eventin#/settings/event-settings/attendees' ),
                'doc_link'      => 'https://support.themewinter.com/docs/plugins/plugin-docs/event/certificate-builder-for-attendee/',
            ],
            'rsvp' => [
                'name'          => 'rsvp',
                'slug'          => 'rsvp',
                'type'          => 'module',
                'status'        => 'off',
                'is_pro'        => true,
                'title'         => __( 'RSVP Module', 'eventin' ),
                'description'   => __( 'It allows you to add RSVP at your upcoming events and grab user\'s attention easily.', 'eventin' ),
                'icon'          => ExtensionIcon::get( 'rsvp' ),
                'notice'        => '',
                'demo_link'     => 'https://product.themewinter.com/eventin/',
                'settings_link' => admin_url( 'admin.php?page=eventin#/settings/email/purchase-email' ),
                'doc_link'      => 'https://support.themewinter.com/docs/plugins/plugin-docs/rsvp-settings/what-is-rsvp-event/',
            ],
            'google_meet' => [
                'name'          => 'google_meet',
                'slug'          => 'google_meet',
                'type'          => 'module',
                'status'        => 'off',
                'is_pro'        => true,
                'title'         => __( 'Google Meet', 'eventin' ),
                'description'   => __( 'Use Google Meet to host your meetings and manage virtual events from your dashboard.', 'eventin' ),
                'icon'          => ExtensionIcon::get( 'google_meet' ),
                'notice'        => '',
                'demo_link'     => 'https://product.themewinter.com/eventin/',
                'settings_link' => admin_url( 'admin.php?page=eventin#/settings/integrations/google-meet' ),
                'doc_link'      => 'https://support.themewinter.com/docs/plugins/plugin-docs/integration/google-meet/',
            ],
            'seat_map' => [
                'name'          => 'seat_map',
                'slug'          => 'seat_map',
                'type'          => 'module',
                'upgrade'       => true,
                'upgrade_link'  => 'https://arraytics.com/timetics/#pricing',
                'status'        => 'off',
                'is_pro'        => false,
                'deps'          => ['timetics-pro'],
                'title'         => __( 'Seat Map', 'eventin' ),
                'description'   => __( 'With the features, you can now add a visual seat plan with different ticket pricing for events.', 'eventin' ),
                'icon'          => ExtensionIcon::get( 'seat_map' ),
                'notice'        => __( 'NB: Need to active Timetics Pro plugin', 'eventin' ),
                'demo_link'     => 'https://product.themewinter.com/eventin/',
                'settings_link' => '',
                'doc_link'      => 'https://support.themewinter.com/docs/plugins/plugin-docs/visual-seat-map/visual-seat-plan/',
            ],
            'eventin-divi-addon' => [
                'name'          => 'eventin-divi-addon',
                'slug'          => 'eventin-divi-addon',
                'type'          => 'addon',
                'status'        => 'off',
                'title'         => __( 'Eventin Divi Addon', 'eventin' ),
                'description'   => __( 'It enable the Eventin featured and module inside DIVI editing panel.', 'eventin' ),
                'icon'          => ExtensionIcon::get( 'eventin-divi-addon' ),
                'notice'        => '',
                'demo_link'     => 'https://product.themewinter.com/eventin/',
                'settings_link' => '',
                'doc_link'      => 'https://support.themewinter.com/docs/plugins/plugin-docs/integration/divi-builder-integration/',
            ],
            'eventin-bricks-addon' => [
                'name'          => 'eventin-bricks-addon',
                'slug'          => 'eventin-bricks-addon',
                'type'          => 'addon',
                'upgrade'       => true,
                'upgrade_link'  => 'https://themewinter.com/purchase-history',
                'status'        => 'off',
                'is_pro'        => true,
                'title'         => __( 'Eventin Bricks Addon', 'eventin' ),
                'description'   => __( 'It\'s enable the Eventin featured and module inside Bricks editing panel.', 'eventin' ),
                'icon'          => ExtensionIcon::get( 'eventin-bricks-addon' ),
                'notice'        => '',
                'demo_link'     => 'https://support.themewinter.com/docs/plugins/plugin-docs/integration/bricks-builder-integration/',
                'settings_link' => '',
                'doc_link'      => 'https://support.themewinter.com/docs/plugins/plugin-docs/integration/bricks-builder-integration/',
            ],
            'eventin-oxygen-addon' => [
                'name'          => 'eventin-oxygen-addon',
                'slug'          => 'eventin-oxygen-addon',
                'type'          => 'addon',
                'upgrade'       => true,
                'upgrade_link'  => 'https://themewinter.com/purchase-history',
                'status'        => 'off',
                'is_pro'        => true,
                'title'         => __( 'Eventin Oxygen Addon', 'eventin' ),
                'description'   => __( 'It\'s enable the Eventin featured and module inside Oxygen editing panel.', 'eventin' ),
                'icon'          => ExtensionIcon::get( 'eventin-oxygen-addon' ),
                'notice'        => '',
                'demo_link'     => 'https://support.themewinter.com/docs/plugins/plugin-docs/integration/oxygen-builder-integration-pro',
                'settings_link' => '',
                'doc_link'      => 'https://support.themewinter.com/docs/plugins/plugin-docs/integration/oxygen-builder-integration-pro',
            ],
            'wpcafe' => [
                'name'          => 'wpcafe',
                'slug'          => 'wpcafe',
                'type'          => 'plugin',
                'upgrade'       => false,
                'upgrade_link'  => 'https://themewinter.com/purchase-history',
                'status'        => 'on',
                'is_pro'        => false,
                'title'         => __( 'WPCafe', 'eventin' ),
                'description'   => __( 'Online Food Ordering, Restaurant Menu, Delivery, and Reservations for WooCommerce.', 'eventin' ),
                'icon'          => ExtensionIcon::get( 'wpcafe' ),
                'notice'        => '',
                'demo_link'     => 'https://product.themewinter.com/wpcafe',
                'settings_link' => '',
                'doc_link'      => 'https://support.themewinter.com/docs/plugins/docs/wpcafe',
            ],
            'timetics' => [
                'name'          => 'timetics',
                'slug'          => 'timetics',
                'type'          => 'plugin',
                'upgrade'       => false,
                'upgrade_link'  => 'https://themewinter.com/purchase-history',
                'status'        => 'on',
                'is_pro'        => false,
                'title'         => __( 'Timetics', 'eventin' ),
                'description'   => __( 'AI-powered Booking System for Daily Meetings, & Appointments – WP Timetics.', 'eventin' ),
                'icon'          => ExtensionIcon::get( 'timetics' ),
                'notice'        => '',
                'demo_link'     => 'https://arraytics.com/timetics',
                'settings_link' => '',
                'doc_link'      => 'https://support.themewinter.com/docs/plugins/docs/timetics',
            ]
        ];
    }
}
