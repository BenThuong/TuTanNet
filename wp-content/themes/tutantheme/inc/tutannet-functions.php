<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package TuTanNet
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */


/*---------Hide meta boxes in Editor---------------*/

if (is_admin()) :
function remove_meta_boxes() {
 if( !current_user_can('manage_options') ) {
  remove_meta_box('linktargetdiv', 'link', 'normal');
  remove_meta_box('linkxfndiv', 'link', 'normal');
  remove_meta_box('linkadvanceddiv', 'link', 'normal');
  remove_meta_box('trackbacksdiv', 'post', 'normal');
  remove_meta_box('postcustom', 'post', 'normal');
  remove_meta_box('commentstatusdiv', 'post', 'normal');
  remove_meta_box('commentsdiv', 'post', 'normal');
  remove_meta_box('authordiv', 'post', 'normal');
  remove_meta_box('sqpt-meta-tags', 'post', 'normal');
 }
}
add_action( 'admin_menu', 'remove_meta_boxes' );
endif;

/*--------------------------------------------------------------
# Define Formats
--------------------------------------------------------------*/
function childtheme_formats(){
     add_theme_support( 'post-formats', array( 'standard' ) );
}
add_action( 'after_setup_theme', 'childtheme_formats', 11 );


/*--------------------------------------------------------------
# Default Categories
--------------------------------------------------------------*/
function define_default_categories() {
	wp_insert_term(
		'Nổi Bật',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'noi-bat'
		)
	);
	wp_insert_term(
		'Tin Tức Phật Sự',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'tin-tuc-phat-su'
		)
	);
	wp_insert_term(
		'Phật Giáo và Xã Hội',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'phat-giao-va-xa-hoi'
		)
	);
	wp_insert_term(
		'Phật Học',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'phat-hoc'
		)
	);
	wp_insert_term(
		'Pháp Âm',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'phap-am'
		)
	);
	wp_insert_term(
		'Các Đạo Tràng',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'cac-dao-trang'
		)
	);
	$cac_ban_nganh_chua_term = get_term_by('slug','cac-ban-nganh-chua','category');
	$cac_ban_nganh_chua = $cac_ban_nganh_chua_term->term_id;
	wp_insert_term(
		'Gia Đình Phật Tử',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'gia-dinh-phat-tu',
		  'parent'=> $cac_ban_nganh_chua
		)
	);
	wp_insert_term(
		'Đạo Tràng Tu Thiền',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'dt-tu-thien',
		  'parent'=> $cac_ban_nganh_chua
		)
	);
	wp_insert_term(
		'Đạo Tràng Tu Bát Quan Trai',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'dt-tu-bat-quan-trai',
		  'parent'=> $cac_ban_nganh_chua
		)
	);
	wp_insert_term(
		'CLB Thiền - Khí Công',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'clb-thien-khi-cong',
		  'parent'=> $cac_ban_nganh_chua
		)
	);
	wp_insert_term(
		'CLB Thanh Niên Phật Tử',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'clb-thanh-nien-phat-tu',
		  'parent'=> $cac_ban_nganh_chua
		)
	);
	wp_insert_term(
		'CLB Từ Thiện Bến Thương',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'clb-tu-thien-ben-thuong',
		  'parent'=> $cac_ban_nganh_chua
		)
	);
	wp_insert_term(
		'Các Chùa Hệ Phái',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'cac-chua-he-phai'
		)
	);

	// functional category
	wp_insert_term(
		'Giới thiệu',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'gioi-thieu'
		)
	);
	wp_insert_term(
		'Thông Báo',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'thong-bao'
		)
	);
	wp_insert_term(
		'Bài Chọn Lọc',
		'category',
		array(
		  'description'	=> '',
		  'slug' 		=> 'bai-chon-loc'
		)
	);

	wp_update_term(1, 'category', array(
	  'name' => 'Không chuyên mục',
	  'slug' => 'khong-chuyen-muc'
	));
}
add_action( 'after_setup_theme', 'define_default_categories' );

/*--------------------------------------------------------------
# Default Pages
--------------------------------------------------------------*/
function define_default_pages() {
    // $instant_article = get_page_by_title( 'Bài Đọc' );
    // if ( !$instant_article ) {
    // 	wp_insert_post(
    // 		array(
    // 		  'post_title'    => 'Bài Đọc',
    // 		  'post_status'   => 'publish',
    // 		  'post_type'     => 'page',
    // 		  'page_template'  => 'instant-article.php'
    // 		)
    // 	);
    // }

    $about = get_page_by_title( 'Đôi Nét Về Chùa Từ Tân', OBJECT, 'post' );
    if ( !$about ) {
    	$cat = get_category_by_slug('gioi-thieu');
    	$id = $cat->term_id;
    	wp_insert_post(
    		array(
    		  'post_title'    => 'Đôi Nét Về Chùa Từ Tân',
    		  'post_status'   => 'publish',
    		  'post_type'     => 'post',
    		  'post_category' => array($id)
    		)
    	);
    }

    $monasteries = get_page_by_title( 'Các Chùa Hệ Phái', OBJECT, 'post' );
    if ( !$monasteries ) {
    	$cat = get_category_by_slug('gioi-thieu');
    	$id = $cat->term_id;
    	wp_insert_post(
    		array(
    		  'post_title'    => 'Các Chùa Hệ Phái',
    		  'post_status'   => 'publish',
    		  'post_type'     => 'post',
    		  'post_category' => array($id)
    		)
    	);
    }

    $contact = get_page_by_title( 'Liên Hệ', OBJECT, 'post' );
    if ( !$contact ) {
    	$cat = get_category_by_slug('gioi-thieu');
    	$id = $cat->term_id;
    	wp_insert_post(
    		array(
    		  'post_title'    => 'Liên Hệ',
    		  'post_status'   => 'publish',
    		  'post_type'     => 'post',
    		  'post_category' => array($id)
    		)
    	);
    }

}
add_action( 'after_setup_theme', 'define_default_pages' );

/*--------------------------------------------------------------
# Define Default Permalink Structure
--------------------------------------------------------------*/
function change_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
}
add_action('after_setup_theme', 'change_permalinks');
