<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_One_Page_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-one-page' ),
				'family'      => esc_html__( 'Font Family', 'vw-one-page' ),
				'size'        => esc_html__( 'Font Size',   'vw-one-page' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-one-page' ),
				'style'       => esc_html__( 'Font Style',  'vw-one-page' ),
				'line_height' => esc_html__( 'Line Height', 'vw-one-page' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-one-page' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-one-page-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-one-page-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-one-page' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-one-page' ),
        'Acme' => __( 'Acme', 'vw-one-page' ),
        'Anton' => __( 'Anton', 'vw-one-page' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-one-page' ),
        'Arimo' => __( 'Arimo', 'vw-one-page' ),
        'Arsenal' => __( 'Arsenal', 'vw-one-page' ),
        'Arvo' => __( 'Arvo', 'vw-one-page' ),
        'Alegreya' => __( 'Alegreya', 'vw-one-page' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-one-page' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-one-page' ),
        'Bangers' => __( 'Bangers', 'vw-one-page' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-one-page' ),
        'Bad Script' => __( 'Bad Script', 'vw-one-page' ),
        'Bitter' => __( 'Bitter', 'vw-one-page' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-one-page' ),
        'BenchNine' => __( 'BenchNine', 'vw-one-page' ),
        'Cabin' => __( 'Cabin', 'vw-one-page' ),
        'Cardo' => __( 'Cardo', 'vw-one-page' ),
        'Courgette' => __( 'Courgette', 'vw-one-page' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-one-page' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-one-page' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-one-page' ),
        'Cuprum' => __( 'Cuprum', 'vw-one-page' ),
        'Cookie' => __( 'Cookie', 'vw-one-page' ),
        'Chewy' => __( 'Chewy', 'vw-one-page' ),
        'Days One' => __( 'Days One', 'vw-one-page' ),
        'Dosis' => __( 'Dosis', 'vw-one-page' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-one-page' ),
        'Economica' => __( 'Economica', 'vw-one-page' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-one-page' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-one-page' ),
        'Francois One' => __( 'Francois One', 'vw-one-page' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-one-page' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-one-page' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-one-page' ),
        'Handlee' => __( 'Handlee', 'vw-one-page' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-one-page' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-one-page' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-one-page' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-one-page' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-one-page' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-one-page' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-one-page' ),
        'Kanit' => __( 'Kanit', 'vw-one-page' ),
        'Lobster' => __( 'Lobster', 'vw-one-page' ),
        'Lato' => __( 'Lato', 'vw-one-page' ),
        'Lora' => __( 'Lora', 'vw-one-page' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-one-page' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-one-page' ),
        'Merriweather' => __( 'Merriweather', 'vw-one-page' ),
        'Monda' => __( 'Monda', 'vw-one-page' ),
        'Montserrat' => __( 'Montserrat', 'vw-one-page' ),
        'Muli' => __( 'Muli', 'vw-one-page' ),
        'Marck Script' => __( 'Marck Script', 'vw-one-page' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-one-page' ),
        'Open Sans' => __( 'Open Sans', 'vw-one-page' ),
        'Overpass' => __( 'Overpass', 'vw-one-page' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-one-page' ),
        'Oxygen' => __( 'Oxygen', 'vw-one-page' ),
        'Orbitron' => __( 'Orbitron', 'vw-one-page' ),
        'Patua One' => __( 'Patua One', 'vw-one-page' ),
        'Pacifico' => __( 'Pacifico', 'vw-one-page' ),
        'Padauk' => __( 'Padauk', 'vw-one-page' ),
        'Playball' => __( 'Playball', 'vw-one-page' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-one-page' ),
        'PT Sans' => __( 'PT Sans', 'vw-one-page' ),
        'Philosopher' => __( 'Philosopher', 'vw-one-page' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-one-page' ),
        'Poiret One' => __( 'Poiret One', 'vw-one-page' ),
        'Quicksand' => __( 'Quicksand', 'vw-one-page' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-one-page' ),
        'Raleway' => __( 'Raleway', 'vw-one-page' ),
        'Rubik' => __( 'Rubik', 'vw-one-page' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-one-page' ),
        'Russo One' => __( 'Russo One', 'vw-one-page' ),
        'Righteous' => __( 'Righteous', 'vw-one-page' ),
        'Slabo' => __( 'Slabo', 'vw-one-page' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-one-page' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-one-page'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-one-page' ),
        'Sacramento' => __( 'Sacramento', 'vw-one-page' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-one-page' ),
        'Tangerine' => __( 'Tangerine', 'vw-one-page' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-one-page' ),
        'VT323' => __( 'VT323', 'vw-one-page' ),
        'Varela Round' => __( 'Varela Round', 'vw-one-page' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-one-page' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-one-page' ),
        'Volkhov' => __( 'Volkhov', 'vw-one-page' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-one-page' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-one-page' ),
			'100' => esc_html__( 'Thin',       'vw-one-page' ),
			'300' => esc_html__( 'Light',      'vw-one-page' ),
			'400' => esc_html__( 'Normal',     'vw-one-page' ),
			'500' => esc_html__( 'Medium',     'vw-one-page' ),
			'700' => esc_html__( 'Bold',       'vw-one-page' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-one-page' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'normal'  => esc_html__( 'Normal', 'vw-one-page' ),
			'italic'  => esc_html__( 'Italic', 'vw-one-page' ),
			'oblique' => esc_html__( 'Oblique', 'vw-one-page' )
		);
	}
}
