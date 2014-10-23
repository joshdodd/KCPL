<?php
  /* Template Name: OC | Discussions */
get_header();
global $post;
$pID = KCPL_get_highest_ancestor($post);
$sidebar = KCPL_get_sidebar($pID);
$color = get_field('section_color',$pID);
$settings = get_option('kcpl-oc');
$color = 'red'; ?>

<?php include_once(locate_template('partials/module-breadcrumbs.php')); ?>
<div id="content">
  <div class="container">
    <div class="columns four alpha" id="contentSecondary">
      <?php include_once(locate_template('partials/module-sidebar-nav.php')); ?>
      <?php get_template_part('partials/module','sidebar-widgets'); ?>
    </div>
    <div class="columns eight omega" id="contentPrimary">

      <?php if(is_user_logged_in()){ ?>

        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $posts = get_posts(array(
          'post_type' => 'kcpl_oc-discussion',
          'paged'     => $paged,
        ));
        $postCount = count($posts);
        $lCol = array_slice($posts,0,$postCount/2);
        $rCol = array_slice($posts,$postCount/2); ?>

        <div class="columns four alpha">
          <?php foreach($lCol as $post){
            setup_postdata($post); ?>

            <div class="KCPL_single-featured">
               <span class="title KCPL_background-red"> </span>
               <div class="gutter">
                  <div class="entry">
                     <span class="entry-title"><?php the_title(); ?></span>
                     <div class="entry-excerpt">
                         <?php the_excerpt(); ?>
                     </div>
                     <a href="<?php the_permalink(); ?>" class="KCPL_readmore">Join ≈</a>
                  </div>
               </div>
             </div>

          <?php } ?>
        </div>
        <div class="columns four omega">
          <?php foreach($rCol as $post){
            setup_postdata($post); ?>

            <div class="KCPL_single-featured">
               <span class="title KCPL_background-red"> </span>
               <div class="gutter">
                  <div class="entry">
                     <span class="entry-title"><?php the_title(); ?></span>
                     <div class="entry-excerpt">
                         <?php the_excerpt(); ?>
                     </div>
                     <a href="<?php the_permalink(); ?>" class="KCPL_readmore">Join ≈</a>
                  </div>
               </div>
             </div>

          <?php } ?>
        </div>
      <?php }else{ ?>
        <div class="four columns alpha">
       <h2>Join Our Online Community</h2>
        <p>We are proud to announce we have a new online community you can join for free. Now you can connect with your library from home with ease. Participate in online discussions, create and share reading lists, recommend books to others and more!
         Login or create a free account below by providing a username, password and valid email address.</p><p style="font-style: italic"> <em>NOTE: This account is different from your library card account. You cannot use your library card PIN to access the Online Community. Please create a separate account through the Online Community.</em></p>
      

        <br/>

        <div class="">

            <div id="verification">
              <?php KCPL_OC_auth::processVerify(); ?>
            </div>
         
              <div class='KCPL_listing4'>
                <span class='title KCPL_background-red'>Log In</span>
                <div class="gutter">
                  <div class="login-form">
                    <?php
                    $options = get_site_option('kcpl-oc');
                    $args = array(
                      'echo'           => true,
                      'redirect'       => get_permalink($options['dashboard']),
                      'form_id'        => 'loginform',
                      'label_username' => __( 'Username' ),
                      'label_password' => __( 'Password' ),
                      'label_log_in'   => __( 'Log In' ),
                      'id_username'    => 'user_login',
                      'id_password'    => 'user_pass',
                      'id_remember'    => 'rememberme',
                      'id_submit'      => 'wp-submit',
                      'remember'       => false,
                      'value_username' => NULL,
                      'value_remember' => false
                    ); ?>
                    <?php wp_login_form( $args ); ?>
                  </div>
                  <p> Dont have an account? Register Below!</p>
                </div>
              </div>
          

          
              <div class='KCPL_listing4'>
                <span class='title KCPL_background-red'>Register</span>
                <div class='gutter'>
                  <?php KCPL_OC_auth::registerForm(); ?>
                </div>
              </div>
       


        </div>
      </div> <!-- end oc login -->

      <div class="four columns omega">
       <h2>Online Catalog Login</h2>
        <p>To access your online catalog account to place holds and review your checkout history, click the button below to login with your library card and PIN. </p>
        <p><br/>
<!--<a class="cal_button" href="#" style="background-color: #FFA751"><strong>Catalog Login</strong></a></p>-->
<a href="http://kana.ent.sirsi.net/client/en_US/default/#">
  <div class="KCPL_horz-single KCPL_background-yellow"  >
          <div class="gutter">
             <span style="color: #fff !important">Catalog login</span>
          </div>
        </div></a>
      </div> <!-- end ent login -->
      
      <?php } ?>


    </div>
  </div>
</div>

<?php get_footer(); ?>
