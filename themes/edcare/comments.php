<?php
// Check if comments are allowed
if (comments_open()) :
?>
    <div id="comments" class="comments-area postbox__comment latest-comments tp-postbox-comment-from tp-postbox-comment blog-contact-form">
        <?php
        // Display the comments list
        if (have_comments()) :
        ?>
            <h3 class="tp-postbox-comment-title">
                <?php
                $comment_count = get_comments_number();
                echo esc_html($comment_count) . ' ' . _n('Comment', 'Comments', $comment_count, 'edcare');
                ?>
            </h3>

            <ul class="postbox__comment edcare-comment-list mt-20">
                <?php
                wp_list_comments(array(
                    'style'       => 'ul',
                    'callback'    => 'edcare_comment_list',
                    'short_ping'  => true,
                ));
                ?>
            </ul>

        <?php
            // Display comment pagination if needed
            the_comments_pagination(array(
                'prev_text' => esc_html__('Previous', 'edcare'),
                'next_text' => esc_html__('Next', 'edcare'),
            ));
        endif;

        if (is_user_logged_in()) {
            $cl = 'loginformuser';
        } else {
            $cl = '';
        }

        $defaults = [
            'comment_field'      => '
                <div class="col-xxl-12 ' . $cl . '">
                    <div class="tp-postbox-details-input-box tp-contact-input-form">
                        <div class="tp-postbox-details-input">
                            <label>Your comment</label>
                            <textarea class="msg-box" id="comment" name="comment" placeholder="' . esc_attr__('Your Comment Here...', 'edcare') . '" required></textarea>
                        </div>
                    </div>
                </div>
            ',
            'submit_button' => '
            <div class="col-xxl-12">
                <div class="tp-postbox-details-input-box tp-contact-btn mt-20">
                    <button type="submit" class="ed-primary-btn">' . esc_html__('Post Comment', 'edcare') . '</button>
                </div>
            </div>',

            'cookies' => '<div class="col-xxl-12">
                <div class="tp-postbox-details-suggetions mb-20">
                    <div class="tp-postbox-details-remeber">' .
                '<input type="checkbox" id="post_aggre" name="wp-comment-agree" value="1" checked>' .
                '<label class="e-check-label" for="post_aggre">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'edcare') . '</label>
                    </div>
                </div>
            </div>'
        ];


        // Display the comment form
        comment_form($defaults);
        ?>
    </div><!-- .comments-area -->
<?php endif; ?>