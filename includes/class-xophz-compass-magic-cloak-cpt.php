<?php

/**
 * Register the Custom Post Type for Magic Cloak Hints
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Xophz_Compass_Magic_Cloak
 * @subpackage Xophz_Compass_Magic_Cloak/includes
 */

/**
 * Register the Custom Post Type for Magic Cloak Hints.
 *
 * @package    Xophz_Compass_Magic_Cloak
 * @subpackage Xophz_Compass_Magic_Cloak/includes
 * @author     Your Name <email@example.com>
 */
class Xophz_Compass_Magic_Cloak_CPT {

	/**
	 * The name of the custom post type.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $cpt_name    The name of the custom post type.
	 */
	private $cpt_name = 'compass_cloak_hint';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
	}

	/**
	 * Register the Custom Post Type.
	 *
	 * @since    1.0.0
	 */
	public function register_cpt() {

		$labels = array(
			'name'                  => _x( 'Magic Cloak Hints', 'Post Type General Name', 'xophz-compass-magic-cloak' ),
			'singular_name'         => _x( 'Magic Cloak Hint', 'Post Type Singular Name', 'xophz-compass-magic-cloak' ),
			'menu_name'             => __( 'Magic Cape', 'xophz-compass-magic-cloak' ),
			'name_admin_bar'        => __( 'Magic Cloak Hint', 'xophz-compass-magic-cloak' ),
			'archives'              => __( 'Hint Archives', 'xophz-compass-magic-cloak' ),
			'attributes'            => __( 'Hint Attributes', 'xophz-compass-magic-cloak' ),
			'parent_item_colon'     => __( 'Parent Hint:', 'xophz-compass-magic-cloak' ),
			'all_items'             => __( 'All Hints', 'xophz-compass-magic-cloak' ),
			'add_new_item'          => __( 'Add New Hint', 'xophz-compass-magic-cloak' ),
			'add_new'               => __( 'Add New', 'xophz-compass-magic-cloak' ),
			'new_item'              => __( 'New Hint', 'xophz-compass-magic-cloak' ),
			'edit_item'             => __( 'Edit Hint', 'xophz-compass-magic-cloak' ),
			'update_item'           => __( 'Update Hint', 'xophz-compass-magic-cloak' ),
			'view_item'             => __( 'View Hint', 'xophz-compass-magic-cloak' ),
			'view_items'            => __( 'View Hints', 'xophz-compass-magic-cloak' ),
			'search_items'          => __( 'Search Hints', 'xophz-compass-magic-cloak' ),
			'not_found'             => __( 'Not found', 'xophz-compass-magic-cloak' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'xophz-compass-magic-cloak' ),
			'featured_image'        => __( 'Featured Image', 'xophz-compass-magic-cloak' ),
			'set_featured_image'    => __( 'Set featured image', 'xophz-compass-magic-cloak' ),
			'remove_featured_image' => __( 'Remove featured image', 'xophz-compass-magic-cloak' ),
			'use_featured_image'    => __( 'Use as featured image', 'xophz-compass-magic-cloak' ),
			'insert_into_item'      => __( 'Insert into hint', 'xophz-compass-magic-cloak' ),
			'uploaded_to_this_item' => __( 'Uploaded to this hint', 'xophz-compass-magic-cloak' ),
			'items_list'            => __( 'Hints list', 'xophz-compass-magic-cloak' ),
			'items_list_navigation' => __( 'Hints list navigation', 'xophz-compass-magic-cloak' ),
			'filter_items_list'     => __( 'Filter hints list', 'xophz-compass-magic-cloak' ),
		);
		$args = array(
			'label'                 => __( 'Magic Cloak Hint', 'xophz-compass-magic-cloak' ),
			'description'           => __( 'Hints and Tips for the Magic Cloak system', 'xophz-compass-magic-cloak' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'taxonomies'            => array(),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'show_in_rest'          => true, // Important for Vue app interaction
			'menu_icon'             => 'dashicons-hidden',
		);
		register_post_type( $this->cpt_name, $args );

	}

	/**
	 * Add Meta Boxes
	 */
	public function add_meta_boxes() {
		add_meta_box(
			'compass_cloak_settings',
			'Magic Cloak Settings',
			array( $this, 'render_meta_box' ),
			$this->cpt_name,
			'normal',
			'high'
		);
	}

	/**
	 * Render Meta Box content
	 */
	public function render_meta_box( $post ) {
		// retrieve the metadata values if they exist
		$trigger = get_post_meta( $post->ID, 'cloak_trigger', true );
		$priority = get_post_meta( $post->ID, 'cloak_priority', true );
		$icon = get_post_meta( $post->ID, 'cloak_icon', true );

		// Nonce field for security
		wp_nonce_field( 'xophz_compass_magic_cloak_save_meta_box', 'xophz_compass_magic_cloak_meta_box_nonce' );

		?>
		<p>
			<label for="cloak_trigger" style="display:block; font-weight:bold;">Trigger Event</label>
			<input type="text" id="cloak_trigger" name="cloak_trigger" value="<?php echo esc_attr( $trigger ); ?>" style="width:100%;" placeholder="e.g., route:enter:compass-explore">
			<span class="description">The event string that triggers this hint.</span>
		</p>
		<p>
			<label for="cloak_priority" style="display:block; font-weight:bold;">Priority</label>
			<input type="number" id="cloak_priority" name="cloak_priority" value="<?php echo esc_attr( $priority ); ?>" style="width:100%;">
			<span class="description">Higher numbers take precedence. Default is 0.</span>
		</p>
		<p>
			<label for="cloak_icon" style="display:block; font-weight:bold;">Custom Icon (Optional)</label>
			<input type="text" id="cloak_icon" name="cloak_icon" value="<?php echo esc_attr( $icon ); ?>" style="width:100%;" placeholder="e.g., mdi-wizard-hat">
			<span class="description">MDI Icon name or URL. If empty, uses default Magic Cloak icon.</span>
		</p>
		<?php
	}

	/**
	 * Save Meta Box
	 */
	public function save_meta_box( $post_id ) {
		// Check nonce
		if ( ! isset( $_POST['xophz_compass_magic_cloak_meta_box_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce( $_POST['xophz_compass_magic_cloak_meta_box_nonce'], 'xophz_compass_magic_cloak_save_meta_box' ) ) {
			return;
		}

		// Check autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check permissions
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Save fields
		if ( isset( $_POST['cloak_trigger'] ) ) {
			update_post_meta( $post_id, 'cloak_trigger', sanitize_text_field( $_POST['cloak_trigger'] ) );
		}
		if ( isset( $_POST['cloak_priority'] ) ) {
			update_post_meta( $post_id, 'cloak_priority', intval( $_POST['cloak_priority'] ) );
		}
		if ( isset( $_POST['cloak_icon'] ) ) {
			update_post_meta( $post_id, 'cloak_icon', sanitize_text_field( $_POST['cloak_icon'] ) );
		}
	}

	/**
	 * Register REST API Fields
	 * This makes custom meta available directly in the JSON response
	 */
	public function register_rest_fields() {
		$fields = array( 'cloak_trigger', 'cloak_priority', 'cloak_icon' );

		foreach ( $fields as $field ) {
			register_rest_field(
				$this->cpt_name,
				$field,
				array(
					'get_callback'    => array( $this, 'get_rest_meta_value' ),
					'update_callback' => array( $this, 'update_rest_meta_value' ),
					'schema'          => null,
				)
			);
		}
	}

	public function get_rest_meta_value( $object, $field_name, $request ) {
		return get_post_meta( $object['id'], $field_name, true );
	}

	public function update_rest_meta_value( $value, $object, $field_name ) {
		return update_post_meta( $object->ID, $field_name, $value );
	}
}
