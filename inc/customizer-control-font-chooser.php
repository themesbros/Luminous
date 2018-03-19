<?php
/**
 * Custom control for WordPress customizer. Ads support for font icon picker.
 *
 * @package     Luminous
 * @subpackage  Customize
 * @since       1.0.0
 */
class TB_Font_Picker extends WP_Customize_Control {

    /**
     * Enqueue scripts/styles.
     *
     * @since  1.0.0
     * @access public
     * @return void
     */
    public function enqueue() {

        /* Load fip js file. */
        wp_enqueue_script( 'fip-js' );

        /* Font icon picker string localization. */
        wp_localize_script( 'fip-js', 'fip', array(
            'placeholder'     => __( 'Search icon', 'luminous' ),
            'allCategoryText' => __( 'From all categories', 'luminous' )
        ) );

        /* Load fip init file. */
        wp_enqueue_script( 'fip-init' );

        /* Load Font Awesome. */
        wp_enqueue_style( 'font-awesome' );

        /* Load fip base style. */
        wp_enqueue_style( 'fip' );

        /* Load fip theme (bootstrap). */
        wp_enqueue_style( 'fip-theme' );
    }

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

                <select name="<?php echo $this->id; ?>" class="tb-font-picker" <?php $this->link(); ?>>

                <?php foreach ( $this->choices as $icon ) : ?>

                    <option value="<?php echo $icon; ?>" <?php selected( $this->value(), $icon, true ); ?>>
                        <?php echo $icon; ?>
                    </option>

                <?php endforeach; ?>

                </select>

            </label>
        <?php
    }
}