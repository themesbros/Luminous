<?php
/**
 * Custom control for WordPress customizer. Ads support for code section.
 *
 * @package     Luminous
 * @subpackage  Customize
 * @since       1.0.0
 */
class TB_Code extends WP_Customize_Control {

    /**
     * Render the content on the theme customizer page.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function render_content() {
        ?>
            <label>

                <?php if ( ! empty( $this->label ) ) : ?>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <?php endif; ?>

                <?php if ( ! empty( $this->description ) ) : ?>
                    <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <?php endif; ?>

            </label>

            <textarea class="widefat contact-textarea" onclick="this.focus();this.select()" readonly="readonly">
                <div class="row">
                    <?php /* Reviewers: No need for localization. */ ?>
                    <div class="col-1-3">[text* your-name placeholder "Your Name"]</div>
                    <div class="col-1-3">[email* your-email placeholder "Your Email"]</div>
                    <div class="col-1-3">[text your-subject placeholder "Subject"]</div>
                </div>
                <div class="row">
                    <div class="col-1-1">
                        [textarea your-message placeholder "Your Message"]
                    </div>
                    <div class="col-1-1 text-center">
                        <label>[submit "Send Message"]</label>
                    </div>
                </div>
            </textarea>

        <?php
    }
}