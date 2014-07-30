<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php wp_title(); ?></title>
  <?php wp_head(); ?>
</head>
<body>
<header>
  <div id="header-util">
    <div class="container cf">
      <div id="header-logo">
        <a href="<?php echo home_url(); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /></a>
      </div>
      <div class="gutter cf">

      </div>
    </div>
  </div>
  <div id="header-nav">
    <div class="container cf">
      <div class="gutter cf">
        <?php if(has_nav_menu('main_nav')){
            $defaults = array(
            	'theme_location'  => 'main_nav',
            	'menu'            => 'main_nav',
            	'container'       => false,
            	'container_class' => '',
            	'container_id'    => '',
            	'menu_class'      => 'menu',
            	'menu_id'         => '',
            	'echo'            => true,
            	'fallback_cb'     => 'wp_page_menu',
            	'before'          => '',
            	'after'           => '',
            	'link_before'     => '',
            	'link_after'      => '',
            	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            	'depth'           => 0,
            	'walker'          => ''
            ); wp_nav_menu( $defaults );
          }else{
            echo "<p><em>main_nav</em> doesn't exist! Create it and it'll render here.</p>";
          } ?>
      </div>
    </div>
  </div>
</header>
