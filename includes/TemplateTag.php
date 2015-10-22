<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 10/22/2015
 * Time: 3:27 PM
 */

namespace AEngine;


use AEngine\Abstracts\Singleton;

class TemplateTag extends Singleton{
	public static function getFeaturedImageSrc($postId = null){
		if(is_null($postId)){
			$postId =  get_the_ID();
		}else{
			return '';
		}
		return wp_get_attachment_url( get_post_thumbnail_id($postId) );
	}
}