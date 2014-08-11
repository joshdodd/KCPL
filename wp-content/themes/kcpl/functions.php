<?php
  include_once('functions/branch-hours.php');

  //enqueue scripts and styles *use production assets. Dev assets are located in assets/css and assets/js
  function KCPL_scripts() {
    wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
  	wp_enqueue_style( 'KCPL-style', get_stylesheet_uri() );
  	wp_enqueue_script( 'KCPL-script', get_template_directory_uri().'/assets/prod/KCPL.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script('typekit','//use.typekit.net/drm7klb.js');
    wp_localize_script( 'KCPL-script', 'KCPL',array(
      'ajaxurl' => admin_url('admin-ajax.php'),
      'curUser' => get_current_user_id()
      )
    );
  }
  add_action( 'wp_enqueue_scripts', 'KCPL_scripts' );

  //theme supports
  add_theme_support('post-thumbnails');
  $defaults = array(
    'flex-height'   => true,
    'flex-width'    => true,
    'height'        => 78,
    'width'         => 194,
    'default-image' => get_template_directory_uri() . '/assets/img/logo.png',
    'header-text'   => false
  );
  add_theme_support('custom-header', $defaults);
  add_theme_support('custom-background');
  add_theme_support('html5');
  add_theme_support('automatic-feed-links');

  //menus
  register_nav_menus(array(
  	'main_nav'   => 'Header and breadcrumb trail heirarchy',
    'util_nav'   => 'Utility Nav in header',
  	'social_nav' => 'Social menu used throughout'
  ));

  // unregister all widgets
 function unregister_default_widgets() {
     unregister_widget('WP_Widget_Pages');
     unregister_widget('WP_Widget_Calendar');
     unregister_widget('WP_Widget_Archives');
     unregister_widget('WP_Widget_Links');
     unregister_widget('WP_Widget_Meta');
     unregister_widget('WP_Widget_Search');
     unregister_widget('WP_Widget_Categories');
     unregister_widget('WP_Widget_Recent_Posts');
     unregister_widget('WP_Widget_Recent_Comments');
     unregister_widget('WP_Widget_RSS');
     unregister_widget('WP_Widget_Tag_Cloud');
     unregister_widget('WP_Nav_Menu_Widget');
     unregister_widget('Twenty_Eleven_Ephemera_Widget');
 } add_action('widgets_init', 'unregister_default_widgets', 11);

  //widgets
  register_sidebar(array(
	   'name'          => __( 'Footer - Column One' ),
	   'id'            => 'footer-col1',
	   'description'   => '',
     'class'         => 'footer-location-widget',
	   'before_widget' => '',
	   'after_widget'  => '',
	   'before_title'  => '<span class="title">',
	   'after_title'   => '</span>' ));
  register_sidebar(array(
     'name'          => __( 'Footer - Column Two' ),
     'id'            => 'footer-col2',
     'description'   => '',
     'class'         => 'footer-location-widget',
     'before_widget' => '',
     'after_widget'  => '',
     'before_title'  => '<span class="title">',
     'after_title'   => '</span>' ));
  register_sidebar(array(
     'name'          => __( 'Footer - Column Three' ),
     'id'            => 'footer-col3',
     'description'   => '',
     'class'         => 'footer-location-widget',
     'before_widget' => '',
     'after_widget'  => '',
     'before_title'  => '<span class="title">',
     'after_title'   => '</span>' ));
  register_sidebar(array(
     'name'          => __( 'Footer - Column Four' ),
     'id'            => 'footer-col4',
     'description'   => '',
     'class'         => 'footer-location-widget',
     'before_widget' => '',
     'after_widget'  => '',
     'before_title'  => '<span class="title">',
     'after_title'   => '</span>' ));

  //editor style
  add_editor_style('assets/css/wp-editor.css');

  //login page style
  function KCPL_loginCSS() {
	   echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/assets/img/wp-login.css"/>';
  } add_action('login_head', 'KCPL_loginCSS');

  //footer attribution
  function KCPL_footer_admin () {
	   echo 'Theme developed by <a href="http://meshfresh.com">MESH Design</a>.';
  } add_filter('admin_footer_text', 'KCPL_footer_admin');

  //disable code editors
  define('DISALLOW_FILE_EDIT', true);

  //research CPT
  add_action('init','KCPL_researchCPT');
  function KCPL_researchCPT() {
  	$labels = array(
  		'name'               => _x('Research Tools & Resources','post type general name'),
  		'singular_name'      => _x('Research Tool or Resource','post type singular name'),
  		'menu_name'          => _x('Research Tools & Resources','admin menu'),
  		'name_admin_bar'     => _x('Research Tool or Resource','add new on admin bar'),
  		'add_new'            => _x('Add New'),
  		'add_new_item'       => __('Add New Research Tool or Resource'),
  		'new_item'           => __('New Research Tool or Resource'),
  		'edit_item'          => __('Edit Research Tool or Resource'),
  		'view_item'          => __('View Research Tool or Resource'),
  		'all_items'          => __('All Research Tools & Resources'),
  		'search_items'       => __('Search Research Tools & Resources'),
  		'parent_item_colon'  => __('Parent Research Tools & Resources:'),
  		'not_found'          => __('No Research Tools or Resources found.'),
  		'not_found_in_trash' => __('No Research Tools or Resources found in Trash.')
  	);

  	$args = array(
  		'labels'             => $labels,
  		'public'             => true,
  		'publicly_queryable' => true,
  		'show_ui'            => true,
  		'show_in_menu'       => true,
  		'query_var'          => true,
  		'rewrite'            => array( 'slug' => 'resources'),
  		'capability_type'    => 'post',
  		'has_archive'        => true,
  		'hierarchical'       => false,
  		'menu_position'      => null,
  		'supports'           => array('title','editor','author','thumbnail','excerpt','comments')
  	); register_post_type('resources',$args);
  }

  //research Tax
  add_action( 'init', 'KCPL_researchTax' );
  function KCPL_researchTax() {
  	register_taxonomy(
  		'resources-category',
  		'resources',
  		array(
  			'label' => __('Resource Category'),
  			'rewrite' => array('slug'=>'resource-category'),
  			'hierarchical' => true,
  		)
  	);
  }

  //get parent ID
  function KCPL_get_menu_parent_ID(){
    $menu_slug = 'main_nav';
    $locations = get_nav_menu_locations();
    $menu_id   = $locations[$menu_slug];
    $post_id        = get_the_ID();
    $menu_items     = wp_get_nav_menu_items($menu_id);
    $parent_item_id = wp_filter_object_list($menu_items,array('object_id'=>$post_id),'and','menu_item_parent');
    $parent_item_id = array_shift( $parent_item_id );
    function checkForParent($parent_item_id,$menu_items){
      $parent_post_id = wp_filter_object_list( $menu_items, array( 'ID' => $parent_item_id ), 'and', 'object_id' );
      $parent_item_id = wp_filter_object_list($menu_items,array('ID'=>$parent_item_id),'and','menu_item_parent');
      $parent_item_id = array_shift( $parent_item_id );
      if($parent_item_id=="0"){
        $parent_post_id = array_shift($parent_post_id);
        return $parent_post_id;
      }else{
        return checkForParent($parent_item_id,$menu_items);
      }
    }
    if(!empty($parent_item_id)){
      return checkForParent($parent_item_id,$menu_items);
    }else{
      return $post_id;
    }
  }
  //get sidebar widget from KCPL_get_menu_parent_ID()
  function KCPL_get_sidebar($postID){
    return get_field('sidebar_fields',intval($postID));
  }


  //Comment walker
	function comments_walker($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
	?>
		<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? 'clearfix' : 'clearfix parent' ) ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
		<?php endif; ?>


    <!-- New !-->
    <div class="comment-wrap clearfix">
      <?php edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
       <div class="comment-img"><?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?></div>
       <div class="comment-content">
          <span class="name"><?php printf( __( 'Posted by %s' ),get_comment_author_link()); ?></span>
          <span class="date"><?php printf( __('%1$s'), get_comment_date()); ?></span>
          <div class="comment-comment">
            <?php if ( $comment->comment_approved == '0' ){ ?>
              <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
              <br />
            <?php } ?>
            <?php comment_text(); ?></div>
          <!--<a class="reply KCPL_readmore" href="#">Reply ≈</a>!-->
          <?php comment_reply_link(array_merge($args,array('reply_text'=>'Reply ≈','add_below'=>$add_below,'depth'=>$depth,'max_depth'=>$args['max_depth']))); ?>
          <a class="leave-comment KCPL_readmore" href="#KCPL_commentbox">Leave a Comment ≈</a>
       </div>
    </div>


    <!-- Old
		<div class="comment-author vcard">
			<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
			<br />
		<?php endif; ?>
		<div class="comment-content-box">
			<?php comment_text(); ?>
			<div class="comment-content-meta-things">
				<?php printf( __( 'Posted by %s' ),get_comment_author_link()); ?>
				|
				<a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
					<?php printf( __('%1$s'), get_comment_date()); ?>
				</a>
				<?php edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
				|
				<?php comment_reply_link(array_merge($args,array('add_below'=>$add_below,'depth'=>$depth,'max_depth'=>$args['max_depth']))); ?>
			</div>
		</div> !-->


		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
	<?php
	}


?>
