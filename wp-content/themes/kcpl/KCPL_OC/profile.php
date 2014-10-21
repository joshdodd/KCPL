<?php /* Template Name: OC | Profile */
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
              if(isset($_GET['uid'])){
                $uid = $_GET['uid'];
                $ud = get_userdata($uid);
                if($ud==false){
                  $pr = false;
                  $er = "Member does not exist";
                }else{
                  $pr = true;
                }
              }elseif($curid != 0){
                $uid = $curid;
                $pr = true;
              }else{
                $pr = false;
                $er = "You must be logged in to see your profile";
              }

              if($pr = true){
                KCPL_OC_profile::showProfile($uid);
              }else{
                echo $er;
              } ?>
        </div>

        <div class="columns eight alpha omega">
          <div class="KCPL_listing4">
            <span class="title KCPL_background-red">Materials I Have Recommended</span>
            <div class="gutter">
              <?php KCPL_OC_recommended::getUserRecommended($uid); ?>
            </div>
          </div>
        </div>

        <div class="columns four alpha">
          <div class="KCPL_listing4">
            <span class="title KCPL_background-red">My Recent Book List</span>
            <div class="gutter">
              <div class="row">
                <?php $bl = KCPL_OC_booklist::getUserBooklists(4,1,$uid,false);
                  if(is_array($bl)){
                    $i=1;
                    foreach($bl[0] as $b){
                      echo "<div class='entry kcpl_oc-mylist' id='kcpl_oc-mylist-".$b['id']."'>
                              <div class='image'><img src='".$b['img']."'/></div>
                              <div class='number'>".$i."</div>
                              <div class='content'>
                                <span class='entry-title'>".$b['title']."</span>
                                <span class='entry-author'>".$b['author']."</span>
                              </div>
                            </div>";
                      $i++;
                    }
                  }else{
                    echo $bl;
                  } ?>
              </div>
            </div>
          </div>
        </div>

        <div class="columns four omega">
          <?php KCPL_OC_discussions::getUserDiscussion(2,$uid); ?>
        </div>

      <?php }else{ ?>
         <h2>Join Our Online Community Today!</h2>
        <p>We are proud to announce we have a new online community you can join for free. Now you can connect with your library from home with ease. Participate in online discussions, create and share reading lists, recommend books to other and more!
         Login or create a free account below by providing a username, password and valid email address.</p><p>Current library cardholder must register for an account and cannot use their library card and PIN to access the Online Community.</p>


        <br/>

        <div class="">

            <div id="verification">
              <?php KCPL_OC_auth::processVerify(); ?>
            </div>
            <div class="columns four alpha">
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
                </div>
              </div>
            </div>

            <div class="columns four omega">
              <div class='KCPL_listing4'>
                <span class='title KCPL_background-red'>Register</span>
                <div class='gutter'>
                  <?php KCPL_OC_auth::registerForm(); ?>
                </div>
              </div>
            </div>


        </div>
      <?php } ?>


    </div>

  </div>
</div>

<?php } } ?>

<?php get_footer(); ?>
