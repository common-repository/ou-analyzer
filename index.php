<?php
/*
Plugin Name: OU ANALYZER
Plugin URI: http://oleksandrustymenko.com/ouanalyzer.html
Description: OU ANALYZER is the plugin which displays number of users, posts, pages and comments.
Version: 1.0
Author: Oleksandr Ustymenko
Author URI: http://oleksandrustymenko.com
*/

/*  
	Copyright 2016 oleksandr87 (email:ustymenkooleksandrnew@gmail.com)

   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_menu', 'ou_analyzer_option_pages');

function ou_analyzer_option_pages() 
{
	add_options_page( 'OU ANALYZER', 'OU ANALYZER', 'manage_options', 'ou_analyzer_option', 'ou_analyzer_option_function');
}

function ou_analyzer_option_function()
{
	global $wpdb;
	$ou_analyzer_one_t1 = $wpdb->prefix."users";
	$ou_analyzer_one_t2 = $wpdb->prefix."posts";
	$ou_analyzer_one_t3 = $wpdb->prefix."comments";	
	$ou_analyzer_timestamp = current_time('timestamp');
	$ou_analyzer_two_count_users_all1 = count_users();
	$ou_analyzer_two_count_users_all = $ou_analyzer_two_count_users_all1['total_users'];
	$ou_analyzer_two_count_posts1 = wp_count_posts('post');
	$ou_analyzer_two_count_posts = $ou_analyzer_two_count_posts1->publish;
	$ou_analyzer_two_count_pages1 = wp_count_posts('page');
	$ou_analyzer_two_count_pages = $ou_analyzer_two_count_pages1->publish;
	$ou_analyzer_two_count_comments1 =  wp_count_comments();
	$ou_analyzer_two_count_comments = $ou_analyzer_two_count_comments1->total_comments;	
	$ou_analyzer_two_count_users_24hours = $wpdb->get_var( "SELECT COUNT(*) FROM  $ou_analyzer_one_t1 WHERE  ($ou_analyzer_timestamp - (UNIX_TIMESTAMP(user_registered) + 10800)) <86400" );
	$ou_analyzer_two_count_posts_24hours = $wpdb->get_var( "SELECT COUNT(*) FROM  $ou_analyzer_one_t2 WHERE post_type='post' AND post_status = 'publish' AND ($ou_analyzer_timestamp - (UNIX_TIMESTAMP(post_date) + 10800)) <86400" );
	$ou_analyzer_two_count_page_24hours = $wpdb->get_var( "SELECT COUNT(*) FROM  $ou_analyzer_one_t2 WHERE post_type='page' AND post_status = 'publish' AND ($ou_analyzer_timestamp - (UNIX_TIMESTAMP(post_date) + 10800)) <86400" );
	$ou_analyzer_two_count_comments_24hours = $wpdb->get_var( "SELECT COUNT(*) FROM  $ou_analyzer_one_t3 WHERE ($ou_analyzer_timestamp - (UNIX_TIMESTAMP(comment_date) + 10800)) <86400" );
	echo '<div style="margin:10px; width:460px;">';
	
		echo '<div style="width:450px; background:#041729;">';
			echo '<div style="padding:5px; font-size:18px; text-align:left; color:#E8E8E8;">';
				echo '<b>OU ANALYZER</b>';
			echo '</div>';
		echo '</div>';
	
		echo '<div style="width:448px; overflow:hidden; min-height:100px; border:1px solid #041729;">';
	
			echo '<div style="float:left; width:149px; margin:0px 0px 5px 0px;">';
				echo '<div style="padding:5px 5px 5px 5px; font-size:16px; text-align:center; color:#041729;">';
					echo '<b>Users</b>';
					
					echo '<div style="padding:5px 0px 0px 0px;">';
						echo $ou_analyzer_two_count_users_all;
					echo '</div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div style="float:left; width:299px; margin:0px 0px 5px 0px;">';
				echo '<div style="padding:5px 5px 5px 5px; font-size:16px; text-align:center; color:#041729;">';
					echo '<b>New users in the past 24 hours</b>';
					
					echo '<div style="padding:5px 0px 0px 0px;">';
						echo $ou_analyzer_two_count_users_24hours;
					echo '</div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div style="float:left; width:149px; margin:0px 0px 5px 0px;">';
				echo '<div style="padding:5px 5px 5px 5px; font-size:16px; text-align:center; color:#041729;">';
					echo '<b>Published posts</b>';
					
					echo '<div style="padding:5px 0px 0px 0px;">';
						echo $ou_analyzer_two_count_posts;
					echo '</div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div style="float:left; width:299px; margin:0px 0px 5px 0px;">';
				echo '<div style="padding:5px 5px 5px 5px; font-size:16px; text-align:center; color:#041729;">';
					echo '<b>Published posts in the past 24 hours</b>';
					
					echo '<div style="padding:5px 0px 0px 0px;">';
						echo $ou_analyzer_two_count_posts_24hours;
					echo '</div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div style="float:left; width:149px; margin:0px 0px 5px 0px;">';
				echo '<div style="padding:5px 5px 5px 5px; font-size:16px; text-align:center; color:#041729;">';
					echo '<b>Published pages</b>';
					
					echo '<div style="padding:5px 0px 0px 0px;">';
						echo $ou_analyzer_two_count_pages;
					echo '</div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div style="float:left; width:299px; margin:0px 0px 5px 0px;">';
				echo '<div style="padding:5px 5px 5px 5px; font-size:16px; text-align:center; color:#041729;">';
					echo '<b>Published pages in the past 24 hours</b>';
					
					echo '<div style="padding:5px 0px 0px 0px;">';
						echo $ou_analyzer_two_count_page_24hours;
					echo '</div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div style="float:left; width:149px; margin:0px 0px 5px 0px;">';
				echo '<div style="padding:5px 5px 5px 5px; font-size:16px; text-align:center; color:#041729;">';
					echo '<b>Comments</b>';
					
					echo '<div style="padding:5px 0px 0px 0px;">';
						echo $ou_analyzer_two_count_comments;
					echo '</div>';
				echo '</div>';
			echo '</div>';
	
			echo '<div style="float:left; width:299px; margin:0px 0px 5px 0px;">';
				echo '<div style="padding:5px 5px 5px 5px; font-size:16px; text-align:center; color:#041729;">';
					echo '<b>Comments in the past 24 hours</b>';
					
					echo '<div style="padding:5px 0px 0px 0px;">';
						echo $ou_analyzer_two_count_comments_24hours;
					echo '</div>';
				echo '</div>';
			echo '</div>';
	
		echo '</div>';
	
	echo '</div>';
}
?>