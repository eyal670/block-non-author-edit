<?php
/*
Plugin Name: ER block non-author edit
Description: block any user role from edit other authors posts of any selected post-type
Author: Eyal Ron Web Development
Developer: Eyal Ron
version: 1.0
License: MIT
@create date 2021-01-28 11:40:11
@modify date 2021-01-28 11:43:35
*/

function block_non_author(){
	$active_on_post_types = ['post'];//array of post types you want to protect
	$active_on_user_roles = ['editor'];//array of user roles you want to block
	global $post;
	$screen = get_current_screen();
	$user = wp_get_current_user();
	if($screen->parent_base == 'edit' && in_array($screen->post_type,$active_on_post_types ) && in_array($user->roles[0],$active_on_user_roles ) && $post->post_author != $user->ID){
		die('you are not the author of this post');//block with a massage
		// wp_redirect(home_url( '/wp-admin' ));//redirect to dashboard
	}
}
add_action( 'edit_form_top', 'block_non_author', 10 );