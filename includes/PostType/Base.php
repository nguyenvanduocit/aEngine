<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/27/2015
 * Time: 8:10 AM
 */

namespace AEngine\PostType;
use AEngine\Metabox\SimpleMetabox;

abstract class Base {
	protected $singularName;
	protected $pluralName;
	protected $menuName;
	protected $postType;
	protected $slug;
	protected $meta_fields;
	protected $terms;
	protected $populatedFields = array();
	protected $args;
	protected $hierarchical = false;
	protected $description;
	abstract function init();

	public function registerPostType(){
		$args = array(
			'labels' => $this->createPostTypeLable(),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => esc_attr( apply_filters( 'aengine_temple_slug', $this->slug ) ) ,
			                    'with_front' => apply_filters( 'aengine_rewrite_'.$this->slug.'_with_front', true ),
			                    'feeds' => true,
			                    'pages' => true
			),
			'has_archive' => true,
			'hierarchical' => $this->hierarchical,
			'menu_position' => 51,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail','comments'),
			'description'=>$this->getDescription()
		);
		if($this->getTerms()){
			$args['taxonomies'] = $this->getTerms();
		}
		if($this->args){
			$this->args = wp_parse_args($this->args, $args);
		}
		register_post_type( $this->getPostType(), $this->args );
		if(isset($this->meta_fields) && is_admin()){
			$this->initMetabox();
		}
	}

	protected function createPostTypeLable () {
		$singular = $this->getSingularName();
		$plural = $this->getPluralName();
		$menu = $this->getMenuName();
		$labels = array(
			'name' => sprintf( _x( '%s', 'post type general name', AENGINE_DOMAIN ), $plural ),
			'singular_name' => sprintf( _x( '%s', 'post type singular name', AENGINE_DOMAIN ), $singular ),
			'add_new' => __( 'Add New', AENGINE_DOMAIN ),
			'add_new_item' => sprintf( __( 'Add New %s', AENGINE_DOMAIN ), $singular ),
			'edit_item' => sprintf( __( 'Edit %s', AENGINE_DOMAIN ), $singular ),
			'new_item' => sprintf( __( 'New %s', AENGINE_DOMAIN ), $singular ),
			'all_items' => sprintf( __( 'All %s', AENGINE_DOMAIN ), $plural ),
			'view_item' => sprintf( __( 'View %s', AENGINE_DOMAIN ), $singular ),
			'search_items' => sprintf( __( 'Search %s', AENGINE_DOMAIN ), $plural ),
			'not_found' =>  sprintf( __( 'No %s found', AENGINE_DOMAIN ), mb_strtolower( $plural, 'UTF-8') ),
			'not_found_in_trash' => sprintf( __( 'No %s found in Trash', AENGINE_DOMAIN ), mb_strtolower( $plural, 'UTF-8') ),
			'parent_item_colon' => '',
			'menu_name' => sprintf( __( '%s', AENGINE_DOMAIN ), $menu )
		);
		return $labels;
	}
	public function initMetabox($id = null,$title = null, $fields = null){
		if(!isset($id)){
			$id=$this->postType.'_metabox';
		}
		if(!isset($fields)){
			$fields = $this->meta_fields;
		}
		if(!isset($title)){
			$title = "Meta";
		}
		$args = array(
			'post_type'=>$this->postType
		);
		$metabox = new SimpleMetabox($id, $title, $args, $fields);
		$metabox->init();
	}
	/**
	 * @return mixed
	 */
	public function getPostType() {
		return $this->postType;
	}

	/**
	 * @param mixed $postType
	 */
	public function setPostType( $postType ) {
		$this->postType = $postType;
	}

	/**
	 * @return mixed
	 */
	public function getMetaFields() {
		return $this->meta_fields;
	}

	/**
	 * @param mixed $meta_fields
	 */
	public function setMetaFields( $meta_fields ) {
		$this->meta_fields = $meta_fields;
	}

	/**
	 * @return mixed
	 */
	public function getSingularName() {
		if(is_null($this->singularName)){
			$this->setSingularName($this->postType);
		}
		return $this->singularName;
	}

	/**
	 * @param mixed $singularName
	 */
	public function setSingularName( $singularName ) {
		$this->singularName = $singularName;
	}

	/**
	 * @return mixed
	 */
	public function getPluralName() {
		if(is_null($this->pluralName)){
			$this->setPluralName($this->postType);
		}
		return $this->pluralName;
	}

	/**
	 * @param mixed $pluralName
	 */
	public function setPluralName( $pluralName ) {
		$this->pluralName = $pluralName;
	}

	/**
	 * @return mixed
	 */
	public function getMenuName() {
		if(is_null($this->menuName)){
			$this->setMenuName(ucfirst($this->postType));
		}
		return $this->menuName;
	}

	/**
	 * @param mixed $menuName
	 */
	public function setMenuName( $menuName ) {
		$this->menuName = $menuName;
	}

	/**
	 * @return mixed
	 */
	public function getSlug() {
		if(is_null($this->slug)){
			$this->setSlug($this->postType);
		}
		return $this->slug;
	}

	/**
	 * @param mixed $slug
	 */
	public function setSlug( $slug ) {
		$this->slug = $slug;
	}

	/**
	 * @return mixed
	 */
	public function getTerms() {
		return $this->terms;
	}

	/**
	 * @param mixed $terms
	 */
	public function setTerms( $terms ) {
		$this->terms = $terms;
	}

	/**
	 * @param $postId
	 * @param $size
	 *
	 * @return string
	 */
	public function getThumbnailSrc($arg){
		if(!array_key_exists('thumbnail_id', $arg)){
			$post_thumbnail_id = get_post_thumbnail_id( $arg['postId'] );
		}
		else{
			$post_thumbnail_id = $arg['thumbnail_id'];
		}
		if($post_thumbnail_id ){
			$src = wp_get_attachment_image_src( $post_thumbnail_id, $arg['size']);
			if(is_array($src)){
				return $src[0];
			}
		}
		return '';
	}

	public function populate($post, $fields = array()){
		if(is_numeric($post)){
			$post = get_post($post);
		}
		$fields = array_flip(array_merge($fields, $this->populatedFields));
		if(!$post){
			return new \WP_Error('Post not found');
		}
		foreach($this->meta_fields as $key => $field){
			$value = get_post_meta($post->ID, $field['name'], true);
			if($value){
				$post->$field['name'] = $value;
			}
		}
		$terms = wp_get_post_terms( $post->ID, $this->terms, array("fields" => "all") );
		$post->taxonomies = $terms;
		/** @var array $post */
		$post = (array)$post;
		if(count($fields) > 0){
			$post  = array_intersect_key( $post, $fields );
		}
		return $post;
	}
	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}
}