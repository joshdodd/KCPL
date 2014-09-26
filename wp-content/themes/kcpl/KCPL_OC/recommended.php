<?php /* Template Name: OC | Recommended */
get_header();
global $post;
$pID = KCPL_get_highest_ancestor($post);
$sidebar = KCPL_get_sidebar($pID);
$color = get_field('section_color',$pID);

?>


<?php if(have_posts()){while(have_posts()){the_post(); ?>

<?php include_once(locate_template('partials/module-breadcrumbs.php')); ?>

<div id="content">
  <div class="container">
    <?php include_once(locate_template('partials/module-sidebar-nav.php')); ?>

    <div class="columns eight omega" id="contentPrimary">

      <div class="KCPL_listing4">
        <span class="title KCPL_background-red">Most Recommended Books</span>
        <div class="gutter">
          <?php KCPL_OC_recommended::getMostRecommended(4); ?>
        </div>
      </div>

      <?php KCPL_OC_recommended::searchRecommended(10,"Search Recommended Books"); ?>

    </div>

  </div>
</div>

<?php } } ?>

<?php get_footer(); ?>