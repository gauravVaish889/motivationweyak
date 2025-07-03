<?php
/**
 * Title: Footer
 * Slug: jove/footer
 * Description:
 * Categories: footer
 * Keywords:
 * Viewport Width: 1440
 * Block Types: core/template-part/footer
 * Post Types: wp_template
 * Inserter: true
 */
?>

<!-- wp:group {"tagName":"footer","align":"full","className":"jove-footer","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}},"spacing":{"padding":{"top":"64px","bottom":"48px"},"blockGap":"48px"}},"backgroundColor":"secondary","textColor":"base","layout":{"inherit":true,"type":"constrained"}} -->
<footer
    class="wp-block-group alignfull jove-footer has-base-color has-secondary-background-color has-text-color has-background has-link-color"
    style="padding-top:64px;padding-bottom:48px">
    <!-- wp:group {"className":"jove-top-footer","style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"fontSize":"small","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group jove-top-footer has-small-font-size">
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group">
            <!-- wp:image {"lightbox":{"enabled":false},"id":39719121,"width":"79px","height":"auto","sizeSlug":"full","linkDestination":"custom"} -->
            <figure class="wp-block-image size-full is-resized"><a href="https://www.jove.com"><img
                        src="<?php echo esc_url( JOVE_BUILD_URI ); ?>/media/images/JoVE-Logo-GreyBlue.webp" alt=""
                        class="wp-image-39719121" style="width:79px;height:auto" /></a></figure>
            <!-- /wp:image -->

            <!-- wp:acf/divider {"name":"acf/divider","data":{"height":"40","_height":"field_676cdd011fe20","width":"1","_width":"field_676cdd271fe21"},"mode":"preview","style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->

            <!-- wp:image {"lightbox":{"enabled":false},"id":39719137,"width":"135px","sizeSlug":"full","linkDestination":"custom"} -->
            <figure class="wp-block-image size-full is-resized"><a href="https://visualize.jove.com/"><img
                        src="<?php echo esc_url( JOVE_BUILD_URI ); ?>/media/images/footer-visualize.webp" alt=""
                        class="wp-image-39719137" style="width:135px" /></a></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:group -->

        <!-- wp:social-links {"iconColor":"base","iconColorValue":"#fff","size":"has-normal-icon-size","className":"is-style-outline-border","style":{"layout":{"selfStretch":"fit","flexSize":null}},"layout":{"type":"flex","justifyContent":"center"}} -->
        <ul class="wp-block-social-links has-normal-icon-size has-icon-color is-style-outline-border">
            <!-- wp:social-link {"url":"https://x.com/JoVEjournal","service":"twitter"} /-->

            <!-- wp:social-link {"url":"https://www.facebook.com/JoVEjournal","service":"facebook"} /-->

            <!-- wp:social-link {"url":"https://www.linkedin.com/company/jove/","service":"linkedin"} /-->

            <!-- wp:social-link {"url":"https://www.youtube.com/@JoVEJournal","service":"youtube"} /-->
        </ul>
        <!-- /wp:social-links -->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"jove-footer-widgets","layout":{"type":"constrained"}} -->
    <div class="wp-block-group jove-footer-widgets">
        <!-- wp:columns {"isStackedOnMobile":false,"align":"wide"} -->
        <div class="wp-block-columns alignwide is-not-stacked-on-mobile">
            <!-- wp:column {"width":"60%","layout":{"type":"default"}} -->
            <div class="wp-block-column" style="flex-basis:60%">
                <!-- wp:columns -->
                <div class="wp-block-columns">
                    <!-- wp:column {"layout":{"type":"constrained"}} -->
                    <div class="wp-block-column">
                        <!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"constrained"}} -->
                        <div class="wp-block-group">
                            <!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"base"} -->
                            <h2 class="wp-block-heading has-base-font-size" style="font-style:normal;font-weight:700">
                                <?php esc_html_e('ABOUT JoVE','jove'); ?></h2>
                            <!-- /wp:heading -->

                            <!-- wp:list {"className":"is-style-list-none"} -->
                            <ul class="wp-block-list is-style-list-none">
                                <!-- wp:list-item -->
                                <li><a href="https://www.jove.com/about"><?php esc_html_e('Overview','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/about/leadership/"><?php esc_html_e('Leadership','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a href="https://blog.jove.com/"><?php esc_html_e('Blog','jove'); ?></a></li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="http://myjove.zendesk.com/"><?php esc_html_e('JoVE Help Center','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->
                            </ul>
                            <!-- /wp:list -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"layout":{"type":"constrained"}} -->
                    <div class="wp-block-column">
                        <!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"constrained"}} -->
                        <div class="wp-block-group">
                            <!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"base"} -->
                            <h2 class="wp-block-heading has-base-font-size" style="font-style:normal;font-weight:700">
                                <?php esc_html_e('AUTHORS','jove'); ?></h2>
                            <!-- /wp:heading -->

                            <!-- wp:list {"className":"is-style-list-none"} -->
                            <ul class="wp-block-list is-style-list-none">
                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/authors/publication"><?php esc_html_e('Publishing Process','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/authors/editorial-board"><?php esc_html_e('Editorial Board','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/authors/editorial-policies"><?php esc_html_e('Scope &amp; Policies','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/authors/peer-review"><?php esc_html_e('Peer Review','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a href="https://www.jove.com/authors/faq"><?php esc_html_e('FAQ','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/authors/submit"><?php esc_html_e('Submit','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->
                            </ul>
                            <!-- /wp:list -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"layout":{"type":"constrained"}} -->
                    <div class="wp-block-column">
                        <!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"constrained"}} -->
                        <div class="wp-block-group">
                            <!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"base"} -->
                            <h2 class="wp-block-heading has-base-font-size" style="font-style:normal;font-weight:700">
                                <?php esc_html_e('LIBRARIANS','jove'); ?></h2>
                            <!-- /wp:heading -->

                            <!-- wp:list {"className":"is-style-list-none"} -->
                            <ul class="wp-block-list is-style-list-none">
                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/librarians/testimonials"><?php esc_html_e('','jove'); ?><?php esc_html_e('Testimonials','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/librarians/subscriptions"><?php esc_html_e('Subscriptions','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a href="https://www.jove.com/access"><?php esc_html_e('Access','jove'); ?></a></li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/librarians/resources"><?php esc_html_e('Resources','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/librarians/advisory-board"><?php esc_html_e('Library Advisory Board','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a href="https://www.jove.com/librarians/faq"><?php esc_html_e('FAQ','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->
                            </ul>
                            <!-- /wp:list -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column {"width":"40%","layout":{"type":"default"}} -->
            <div class="wp-block-column" style="flex-basis:40%">
                <!-- wp:columns -->
                <div class="wp-block-columns">
                    <!-- wp:column {"layout":{"type":"constrained"}} -->
                    <div class="wp-block-column">
                        <!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"constrained"}} -->
                        <div class="wp-block-group">
                            <!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"base"} -->
                            <h2 class="wp-block-heading has-base-font-size" style="font-style:normal;font-weight:700">
                                <?php esc_html_e('RESEARCH','jove'); ?></h2>
                            <!-- /wp:heading -->

                            <!-- wp:list {"className":"is-style-list-none"} -->
                            <ul class="wp-block-list is-style-list-none">
                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/journal"><?php esc_html_e('JoVE Journal','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/methods-collections"><?php esc_html_e('Methods Collections','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/encyclopedia-of-experiments"><?php esc_html_e('JoVE Encyclopedia of Experiments','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a href="https://www.jove.com/archive"><?php esc_html_e('Archive','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->
                            </ul>
                            <!-- /wp:list -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column {"layout":{"type":"constrained"}} -->
                    <div class="wp-block-column">
                        <!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"constrained"}} -->

                        <div class="wp-block-group">
                            <!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontSize":"base"} -->
                            <h2 class="wp-block-heading has-base-font-size" style="font-style:normal;font-weight:700">
                                <?php esc_html_e('EDUCATION','jove'); ?></h2>
                            <!-- /wp:heading -->

                            <!-- wp:list {"className":"is-style-list-none"} -->
                            <ul class="wp-block-list is-style-list-none">
                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/education/core"><?php esc_html_e('JoVE Core','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/business"><?php esc_html_e('JoVE Business','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/science-education-library"><?php esc_html_e('JoVE Science Education','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/education/lab-manual"><?php esc_html_e('JoVE Lab Manual','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://app.jove.com/facultyresources"><?php esc_html_e('Faculty Resource Center','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->

                                <!-- wp:list-item -->
                                <li><a
                                        href="https://www.jove.com/course-solutions"><?php esc_html_e('Faculty Site','jove'); ?></a>
                                </li>
                                <!-- /wp:list-item -->
                            </ul>
                            <!-- /wp:list -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"jove-footer-menu","style":{"spacing":{"blockGap":"12px"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
    <div class="wp-block-group jove-footer-menu">
        <!-- wp:list {"className":"is-style-list-inline-sept"} -->
        <ul class="wp-block-list is-style-list-inline-sept">
            <!-- wp:list-item -->
            <li><a
                    href="https://app.jove.com/about/policies#step-2"><?php esc_html_e('Terms &amp; Conditions of Use','jove'); ?></a>
            </li>
            <!-- /wp:list-item -->

            <!-- wp:list-item -->
            <li><a href="https://app.jove.com/about/policies"><?php esc_html_e('Privacy Policy','jove'); ?></a></li>
            <!-- /wp:list-item -->

            <!-- wp:list-item -->
            <li><a href="https://app.jove.com/about/policies"><?php esc_html_e('Policies','jove'); ?></a></li>
            <!-- /wp:list-item -->
        </ul>
        <!-- /wp:list -->
    </div>
    <!-- /wp:group
 -->
</footer>

<!-- /wp:group -->