<?php /* Template Name: OC | Profile Edit */
get_header();
global $post;
$pID = KCPL_get_highest_ancestor($post);
$sidebar = KCPL_get_sidebar($pID);
$color = get_field('section_color',$pID);
$color = 'red';
?>


<?php if(have_posts()){while(have_posts()){the_post(); ?>

<?php include_once(locate_template('partials/module-breadcrumbs.php')); ?>

<div id="content">
  <div class="container">
    <?php include_once(locate_template('partials/module-sidebar-nav.php')); ?>

    <div class="columns eight omega" id="contentPrimary">

      <?php if(is_user_logged_in()){ ?>
        <div class="column eight alpha omega">

          <?php include_once(locate_template('partials/module-content-topcallout.php')); ?>
        </div>

        <div class="columns eight alpha omega">

          <?php include_once(locate_template('partials/module-content-8column.php')); ?>
        </div>

        <?php $rightSidebar = get_field('page_sidebar');
              $rsCount = count($rightSidebar); ?>

        <div class="columns page-content eight alpha omega">
            <?php
              $curid = get_current_user_id();
              if($curid != 0){
                $uid = $curid;
                $pr = true;
              }else{
                $pr = false;
                $er = "You must be logged in to see your profile";
              }

              if($pr = true){
                KCPL_OC_profile::showProfile($uid,true);
              }else{
                echo $er;
              } ?>
        </div>

        <div class="columns eight alpha omega">
          <?php
            if($pr = true){
              KCPL_OC_profile::editProfile();
            }else{
              echo "You must be logged in to view your profile";
            }
          ?>
        </div>
      <?php }else{
        echo "<p>You must be logged in to access the Online Community</p>
              <div class='KCPL_listing4'>
                <span class='title KCPL_background-red'>Log In</span>
                <div class='gutter'>";
        $options = get_site_option('kcpl-oc');
        $args = array(
          'echo'           => true,
          'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
          'form_id'        => 'loginform',
          'label_username' => __( 'Card Number' ),
          'label_password' => __( 'PIN Number' ),
          'label_log_in'   => __( 'Log In' ),
          'id_username'    => 'user_login',
          'id_password'    => 'user_pass',
          'id_remember'    => 'rememberme',
          'id_submit'      => 'wp-submit',
          'remember'       => false,
          'value_username' => NULL,
          'value_remember' => false
        ); ?>
        <?php wp_login_form( $args );
      }
      echo "</div></div>"; ?>

    </div>

  </div>
</div>

<?php } } ?>

<?php get_footer(); ?>
