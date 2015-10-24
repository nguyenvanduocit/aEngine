<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 10/4/2015
 * Time: 11:45 AM
 */

namespace AEngine\Form;


class GalleryField extends FormField{
	public function __construct(array $args)
	{
		parent::__construct($args);
		if(!did_action('aengine_gallery_field')){
			wp_enqueue_media();
			wp_enqueue_script('galleryField', AENGINE_URL.'/includes/Form/asset/galleryField.js', array('form_module'), AENGINE_VERSION, true);
			do_action('aengine_gallery_field');
		}
	}

	/**
	 * Validates a value against a field.
	 *
	 * @param mixed $value The value to check.
	 *
	 * @return mixed null if the validation failed, sanitized value otherwise.
	 */
	function validate( $value ) {
		return array_values($value);
	}
	/**
	 * Mutate the field arguments so that the value passed is rendered.
	 *
	 * @param array $args
	 * @param mixed $value
	 */
	protected function _set_value( &$args, $value ) {
		$args['value'] = maybe_serialize($value);
	}

	/**
	 * The actual rendering.
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	protected function _render( $args ) {
		$args   = wp_parse_args( $args,
			array(
				'value'    => '',
				'desc_pos' => 'after',
				'extra'    => array( 'class' => 'regular-text' )
			) );
		$values = maybe_unserialize( $args[ 'value' ] );
		$opts = '<div class="ae_gallery_field" id="'.uniqid().'">';

		$opts.='<script class="data-args">'.wp_json_encode($args).'</script>';
		$opts.='<script class="data-value">'.wp_json_encode($values).'</script>';

		$opts .='</div>';
		return FormField::add_desc( $opts, $args[ 'desc' ], $args[ 'desc_pos' ] );
	}
}