<?php
/**
 * HideRiver_Alltab
 * Hide only all tab from river
 * @author Liang Lee
 * @copyright Copyright 2014, Liang Lee
 * @ide The Code is Generated by Liang Lee php IDE.
 * @File start.php
 */
elgg_register_event_handler('init', 'system', 'hideriver_alltab_initialize');
function hideriver_alltab_initialize(){
	elgg_unregister_page_handler('activity');
	elgg_register_page_handler('activity', 'activity_hide_alltab_river');

        $blog = new ElggMenuItem('blog', elgg_echo('blog:blogs'), 'blog/all');
        $file = new ElggMenuItem('file', elgg_echo('file'), 'file/all');
	$wire = new ElggMenuItem('thewire', elgg_echo('thewire'), 'thewire/all');
	elgg_register_menu_item('site', $wite);
	elgg_register_menu_item('site', $blog);
	elgg_unregister_menu_item('site', $file);
	elgg_unregister_menu_item('site', array(
		'name' => 'bookmarks',
		'text' => elgg_echo('bookmarks'),
		'href' => 'bookmarks/all'
	));
}
function activity_hide_alltab_river($page){
    $file = elgg_get_plugins_path().'hideriver_alltab/';

	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());

	$page_type = elgg_extract(0, $page, 'all');
	$page_type = preg_replace('[\W]', '', $page_type);
	if ($page_type == 'owner') {
		$page_type = 'mine';
	}
	set_input('page_type', $page_type);

	require_once("{$file}pages/river.php");
	return true;	
	
}
