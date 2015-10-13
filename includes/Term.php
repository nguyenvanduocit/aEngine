<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 10:00 AM
 */

namespace AEngine;


use AEngine\Abstracts\Singleton;

class Term extends Singleton{
	/** @var  \AEngine\Term\Base[] */
	protected $terms;
	protected function loadTerm($load_terms){
		$load_terms = apply_filters( 'aengine_terms', $load_terms );
		// Get sort order option
		// Load gateways in order
		foreach ( $load_terms as $term ) {
			/** @var \AEngine\Term\Base $load_term */
			$load_term = is_string( $term ) ? new $term() : $term;

			$this->terms[ $load_term->getName() ] = $load_term;
		}
	}
	/**
	 * Get gateways.
	 *
	 * @access public
	 * @return PostType\Base[]
	 */
	public function getTerms() {
		return $this->terms;
	}

	/**
	 * @param $id
	 *
	 * @return PostType\Base|null
	 */
	public function getTerm($termName){
		if(array_key_exists($termName, $this->terms)){
			return $this->terms[$termName];
		}
		return null;
	}
	/**
	 * Register posttype
	 */
	public function init(){
		foreach($this->terms as $termName => $term){
			$term->init();
		}
	}
}