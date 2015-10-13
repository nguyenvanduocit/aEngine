<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 5:10 PM
 */

namespace AEngine\Metabox;


use AEngine\Abstracts\Metabox;

class SimpleMetabox extends Metabox{
	protected $fields;
	public function __construct( $id, $title, array $args, array $fields ) {
		$this->fields = $fields;
		parent::__construct( $id, $title, $args );
	}
	public function form_fields() {
		return $this->fields;
	}
}