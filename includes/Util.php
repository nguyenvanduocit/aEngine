<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 4:54 PM
 */

namespace AEngine;


class Util {
	public static function html( $tag ) {
		static $SELF_CLOSING_TAGS = array( 'area', 'base', 'basefont', 'br', 'hr', 'input', 'img', 'link', 'meta' );
		$args = func_get_args();
		$tag = array_shift( $args );
		if ( is_array( $args[0] ) ) {
			$closing = $tag;
			$attributes = array_shift( $args );
			foreach ( $attributes as $key => $value ) {
				if ( false === $value ) {
					continue;
				}
				if ( true === $value ) {
					$value = $key;
				}
				$tag .= ' ' . $key . '="' . esc_attr( $value ) . '"';
			}
		} else {
			list( $closing ) = explode( ' ', $tag, 2 );
		}
		if ( in_array( $closing, $SELF_CLOSING_TAGS ) ) {
			return "<{$tag} />";
		}
		$content = implode( '', $args );
		return "<{$tag}>{$content}</{$closing}>";
	}
	public static function html_link( $url, $title = '' ) {
		if ( empty( $title ) ) {
			$title = $url;
		}
		return Util::html( 'a', array( 'href' => esc_url( $url ) ), $title );
	}
	public static function admin_notice($msg, $class = 'updated' ){
		return Util::html( "div class='$class fade'", Util::html( "p", $msg ) );
	}

	/**
	 * Enable delayed plugin activation. To be used with scb_init()
	 *
	 * @param string $plugin
	 * @param string|array $callback
	 *
	 * @return void
	 */
	public static function add_activation_hook( $plugin, $callback ) {
		register_activation_hook( $plugin, $callback );
	}
	/**
	 * Allows more than one uninstall hooks.
	 * Also prevents an UPDATE query on each page load.
	 *
	 * @param string $plugin
	 * @param string|array $callback
	 *
	 * @return void
	 */
	public static function add_uninstall_hook( $plugin, $callback ) {
		if ( ! is_admin() ) {
			return;
		}
		register_uninstall_hook( $plugin, '__return_false' );	// dummy
		add_action( 'uninstall_' . plugin_basename( $plugin ), $callback );
	}
	public static function GET($var){
		return isset($_GET[$var]) ? $_GET[$var] : (isset($_REQUEST[$var]) ? $_REQUEST[$var] : '');
	}
	public static function POST($var){
		return isset($_POST[$var]) ? $_POST[$var] : null;
	}
	function COOKIE($var)
	{
		return isset($_COOKIE[$var]) ? $_COOKIE[$var] : null;
	}
}