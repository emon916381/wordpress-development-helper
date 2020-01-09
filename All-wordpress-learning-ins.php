<?php

/**
 * 1. How to start theme development
 * 2. Define theme name and version and other details
 * 3. Make menus
 * 4. Show Post Content
 * 5. Make Custom Post Option in dashboard
 * 6. Make Sidebar
 * 7. Theme support 
 * 8. Comment template
 * 10. Showing Post Date OR time 
 * 11. Category Id name and link get
 */

/*
. How to start theme development
 File Name:header.php
 ===================
*/
 ?>


<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php
	 if (function_exists('is_tag') && is_tag()) {
			echo 'Tag Archive for &quot;'.$tag.'&quot; | '; 
	} 
	elseif (is_archive()) {
			 wp_title(''); echo ' category | '; 
	}
	 elseif (is_search()) {
		  echo 'Search for &quot;'.wp_specialchars($s).'&quot; - ';
	}
	 elseif (!(is_404()) && (is_single()) || (is_page())) { 
		 wp_title(''); echo ' | '; 
	}
	elseif (is_404()) { echo 'Not Found | '; }
			 
	if (is_home()) {
				  bloginfo('name'); echo ' | '; bloginfo('description'); 
	} 
	else { 
		bloginfo('name');
	 }
				  
		 ?>
		 </title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
<?php
/*
----------------------------
File Name: footer.php
=========================
	<?php wp_footer(); ?>
</body>
</html>

------------------------    
File Name: index.php
=============================
    get_header();
    get_footer();
 */


 /*
 @ Define theme name and version and other details
 =>File Name: style.css
 =================================

Theme Name: Twenty Seventeen
Theme URI: https://wordpress.org/themes/twentyseventeen/
Author: the WordPress team
Author URI: https://wordpress.org/
Description: Twenty Seventeen brings your site to life with header video and immersive featured images. With a focus on business sites, it features multiple sections on the front page as well as widgets, navigation and social menus, a logo, and more. Personalize its asymmetrical grid with a custom color scheme and showcase your multimedia content with post formats. Our default theme for 2017 works great in many languages, for any abilities, and on any device.
Version: 2.2
Requires at least: 4.7
Requires PHP: 5.2.4
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: twentyseventeen
Tags: one-column, two-columns, right-sidebar, flexible-header, accessibility-ready, custom-colors, custom-header, custom-menu, custom-logo, editor-style, featured-images, footer-widgets, post-formats, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready

This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.
*/


/**
 * =================
 * Make menus
 * =================
 */
//file Name: functions.php
function ak_after_theme_setup(){
	register_nav_menus(
	array(
		'top'    => __( 'Top Menu', 'twentyseventeen' ),
		'social' => __( 'Social Links Menu', 'twentyseventeen' ),
	));
}
add_action( 'after_setup_theme' ,  'ak_after_theme_setup');

	//this is advance menu setting
	function twentytwenty_menus() {

		$locations = array(
			'primary'  => __( 'Desktop Horizontal Menu', 'twentytwenty' ),
			'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
			'mobile'   => __( 'Mobile Menu', 'twentytwenty' ),
			'footer'   => __( 'Footer Menu', 'twentytwenty' ),
			'social'   => __( 'Social Menu', 'twentytwenty' ),
		);

		register_nav_menus( $locations );
	}

add_action( 'init', 'twentytwenty_menus' );



//== file Name: index.php
	if(is_user_logged_in()):
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'       => 'nav',
			'fallback_cb' => 'custom_primary_menu_fallback',

		) );
	else:
		wp_nav_menu( 
			array(

			'theme_location' => 'primary',
			'container'       => 'nav',
			'fallback_cb' => 'logout_menu'

		) );
	endif;
	function  logout_menu(){

	};
	function custom_primary_menu_fallback(){
		//menu edite page redirecting 
	?>
		<a href= "<?php home_url() ?> wp-admin/nav-menus.php">Set primary menu</a>
	<?php }

/**
 * Show Post Content
 */
//File Name : Index.php
if( have_posts() ):
	while( have_posts() ): the_post();
	//Contant themplate part of the theme------You cann't use extention........this file work  @https://wpshout.com/get-template-part/
	get_template_part( 'templatefile_path' );
	//check post thumbnail have or not
	has_post_thumbnail(  );
	//showing thumbnails
	the_post_thumbnail( null, array(
		'class' => 'img_class'
	) );
	//get post link   to get clean url use  [ esc_url()];
	echo esc_url(get_permalink()) ;
	//showing content
	wp_trim_words( get_the_content(), 10 ,'  [continue...]');
endwhile;
endif;
?>
<!-- ====authore url and name -->
<a class="ctg_link_ele" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?> "><?php the_author() ?></a>


<?php

/**
 * Make Custom Post Option in dashboard
 */
//File Name: functions.php
register_post_type( 'Unick_Id', array(
	'labels'=> array(
	'name' => 'slider',
	),
	'public' => true
) )
//File Name: index.php

$custom_posts = new WP_Query(array(
	'post_type' => 'Unick_Id',
	'posts_per_page' => 5,
	'category_name'	=> 'catName',
	'offset'	=>4,
	)	
);
while( $custom_posts->have_posts()):$custom_posts-> the_post();

endwhile;


/**
 * Make Sidebar
 */
//file Name: functons.php
function twentyseventeen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'twentyseventeen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

//File Name : Index.php
if ( is_active_sidebar( 'sidebar-1' ) ) {
	//check sidbar active or not
	dynamic_sidebar( 'sidebar-1' )
}
#[Note : To Know Advance Sidebare Please Check twentytwenty Theme]


/**
 * Stylesheet Calling System
 * File Name : functions.php
 */
function AK_call_style_script_file(){
	$theme_style_ver = wp_get_theme()->get( 'Version' );
	//For Inc css Files
	wp_enqueue_style( 'Uniqe_File_ID', get_theme_file_uri( '/path.css' ), array(), 2.0 , 'all' );
	//deregister style OR js files
	wp_deregister_script( 'Uniqe_File_ID' );
	//For inc js Files
	wp_enqueue_script( 'Uniqe_File_ID', get_theme_file_uri('/path.js'), array('jQuery'), 2.0, true)

}
add_action( 'wp_enqueue_scripts','AK_call_style_script_file' );
/**
 * Calling stylesheet and script file 
 */
require_once get_template_directory()."/inc/calling-style.php";


/**
 * Theme Support
 */
//file name: functions.php

function support_system(){
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Custom Logo
		 * Display logo
		 * file-name: functions.php
		 */		
		add_theme_support( 'custom-logo' );
		//file name: index.php
		the_custom_logo();


		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#post-thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );
		/**
		 * custom background supprt
		 * it automatic index background paba
		 * file : functions.php
		 */
		add_theme_support('custom-background');
		add_theme_support( 'html5' );
		/**
		 * custom header Image
		 * file name:functions.php
		 */
		
		add_theme_support( 'custom-header');
		 //disolaying -----> file name: index.php
		<img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">	

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'support_system' );

?>
<!-- ================ Comment Part ============ -->
<?php
/**========== Post password protected or not =========== */
if(post_password_required()){
    return;
}
?>

<!-- ====== Comment List ========== -->
<div class="comment_from_option">
    <?php if( have_comments() ): ?>

        <ol>
        <!-- ======= wp_comment_list() all details in @https://developer.wordpress.org/reference/functions/wp_list_comments/ -->
            <?php
            $args =array(
                'walker'    =>  null,
                'max_depth' =>  2,
                'style'     => 'li',
                'type'      =>  'all',
                'per_page'  => 4,
                'avatar_size'   => 32,
                'reverse_top_level' => 1,
                'reverse_children' => 1,
                'formate   '    => 'html5',
                'reply_text'   => '[Reply]',
                'short_ping'    => true,
                'echo'          =>true,

            );
                wp_list_comments( $args );
            ?>
        </ol>

    <?php endif ?>
</div>

<!-- Comment form -->
<?php
/**
 * Stylize our custom form filds 
 * file Name: comments.php
 */
$filds  = array(
    'author' => '<div class="col-md-6"> <div class="form-group">' . '<label for="author">' . __(               'Name' ).'<span>        (Required)</span></label>
                 <input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ).'"/></div> </div>',

    'email'  => '<div class="col-md-6"><div class="form-group">
                 <label for="email">' . __( 'Email' ) . ' <span> (Required)</span></label> ' .
                '<input class="form-control" id="email" name="email" type="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" /></div> </div>',

    'url'    => '<div class="form-group"><label for="url">' . __( 'Website' ) . '</label> 
                <input class="form-control" id="url" name="url" type="url"type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"/></div>',
);

 $args  =   array(
    'comment_notes_before' => '<h5 class="text-danger">Please Comment</h5>',
    'label_submit'  => 'Sent',
    'class_submit'  => 'btn btn-secondary btn-block',
    'title_reply'   => 'Please Comment Here',
	'fields'    => apply_filters( 'comment_form_default_fields', $filds ),
	'comment_field' => '<div class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" rows="8" aria-required="true"></textarea></p>',
);
 );
comment_form( $args );
?>

<!-- ========== Showing Post Date OR time ==================  -->

<?php

//file Name: functions.php
function ash_relative_time() { 
    $post_date = get_the_time('U');
    $delta = time() - $post_date;
    if ( $delta < 60 ) {
        echo 'Just Now';
    }
    elseif ($delta > 60 && $delta < 120){
        echo '1 minute ago';
    }
    elseif ($delta > 120 && $delta < (60*60)){
        echo strval(round(($delta/60),0)), ' minutes ago';
    }
    elseif ($delta > (60*60) && $delta < (120*60)){
        echo '1 hour ago';
    }
    elseif ($delta > (120*60) && $delta < (24*60*60)){
        echo strval(round(($delta/3600),0)), ' hours ago';
    }
    else {
        echo the_time('j\<\s\u\p\>S\<\/\s\u\p\> M y g:i a');
    }}
//file Name: index.php

echo ash_relative_time();


/**
 * Category Id name and link get
 */

 //using slug
 $catObj = get_category_by_slug('uncategorized');  echo get_category_link($catObj);
 $catName = $catObj->name;//get ctg name by slug


 //category page @ use this code just category.php
 $catID = get_the_category(); 
  esc_html( $catID[0]->name );
 category_description( $catID[0] );

 //Post -e category show korta-  it will use to while loop
 foreach((get_the_category()) as $category){
	 echo esc_url( get_category_link(  $category->cat_ID );
	 $category->cat_name . ' ';
 }
