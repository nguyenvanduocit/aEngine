<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 8:01 AM
 */

namespace AEngine;


use AEngine\Abstracts\Singleton;

class PostType extends Singleton{
	/** @var  \AEngine\PostType\Base[] */
	protected $postTypes;

	protected function loadPostType($load_posttypes){
		$load_posttypes = apply_filters( 'aengine_posttypes', $load_posttypes );
		// Get sort order option
		// Load gateways in order
		foreach ( $load_posttypes as $postType ) {
			/** @var \AEngine\PostType\Base $load_postType */
			$load_postType = is_string( $postType ) ? new $postType() : $postType;
			$this->postTypes[ $load_postType->getPostType() ] = $load_postType;
		}
	}
	/**
	 * Get gateways.
	 *
	 * @access public
	 * @return PostType\Base[]
	 */
	public function getPostTypes() {
		return $this->postTypes;
	}

	/**
	 * @param $id
	 *
	 * @return PostType\Base|null
	 */
	public function getPostType( $postTypeName ) {
		if ( array_key_exists( $postTypeName, $this->postTypes ) ) {
			return $this->postTypes[ $postTypeName ];
		}

		return null;
	}

	/**
	 * Register posttype
	 */
	public function init() {
		foreach ( $this->postTypes as $postTypeName => $postType ) {
			$postType->init();
		}
	}
}