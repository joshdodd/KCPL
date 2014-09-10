<?php

foreach($sidebar as $widget){
  //horizontal callout - single
  if($widget['field_type'] == 'horizontal-callout-single'){ ?>

    <?php if($widget['field_link'] != ''){ ?>
      <a target="_blank" href="<?php echo $widget['field_link']; ?>">
    <?php } ?>
        <div class="KCPL_horz-single KCPL_background-<?php echo $widget['field_color']; ?>">
          <div class="gutter">
             <span><?php echo $widget['horizontal_callout-single_title']; ?></span>
          </div>
        </div>
    <?php if($widget['field_link'] != ''){ ?>
      </a>
    <?php } ?>

  <?php }elseif($widget['field_type'] == 'card'){
    //horizontal callout - multi ?>

    <?php if($widget['field_link'] != ''){ ?>
      <a target="_blank" href="<?php echo $widget['field_link']; ?>">
    <?php } ?>
        <div class="KCPL_horz-card KCPL_background-<?php echo $widget['field_color']; ?>">
          <div class="gutter">
             <span class="KCPL_horz-card-first">Get your free</span> <span class="KCPL_horz-card-last">library card</span>
          </div>
        </div>
    <?php if($widget['field_link'] != ''){ ?>
      </a>
    <?php } ?>

  <?php }elseif($widget['field_type'] == 'horizontal-callout-multi'){
    //horizontal callout - multi ?>

    <?php if($widget['field_link'] != ''){ ?>
      <a target="_blank" href="<?php echo $widget['field_link']; ?>">
    <?php } ?>
      <div class="KCPL_horz-multi KCPL_background-<?php echo $widget['field_color']; ?>">
        <div class="gutter">
          <?php if($widget['horizontal_callout_alert'] == 'yes'){?> <span class="alert"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/alert.png" /> </span><?php } ?>
           <span><?php echo $widget['horizontal_callout-multi_title']; ?></span>
           <?php if($widget['field_link'] != ''){ ?>
             <a class="KCPL_readmore" href="<?php echo $widget['field_link']; ?>">Read More ≈</a>
           <?php } ?>
        </div>
      </div>

    <?php if($widget['field_link'] != ''){ ?>
      </a>
    <?php } ?>

  <?php }elseif($widget['field_type'] == 'listing-style-1-1'){
    //listing style 1-1 ?>

    <div class="KCPL_listing1-article KCPL_background-<?php echo $widget['field_color']; ?>">
      <span class="title"><?php echo $widget['field_title']; ?></span>
      <div class="gutter">
        <?php foreach($widget['listing_style_1-1'] as $entry){
          if($entry['reference'] == true){
            $post = $entry['reference_post'];
            setup_postdata($post);
            $link = get_permalink();
            $title = get_the_title();
            $excerpt = get_the_excerpt();
          }else{
            $title= $entry['title'];
            $excerpt = $entry['description'];
            $link = $entry['link_url'];
          } ?>
          <div class="entry">
             <a href="<?php echo $link; ?>"><span class="entry-title"><?php echo $title; ?></span></a>
             <div class="entry-excerpt">
                 <?php echo $excerpt; ?>
             </div>
             <a href="<?php echo $link; ?>" class="KCPL_readmore"><?php echo $entry['link_text']; ?></a>
          </div>
        <?php } wp_reset_postdata(); ?>
      </div>
    </div>

  <?php }elseif($widget['field_type'] == 'listing-style1-2'){
    //listing style 1-2 ?>

    <div class="KCPL_listing1-list KCPL_background-<?php echo $widget['field_color']; ?>">
       <span class="title"><?php echo $widget['field_title']; ?></span>
       <div class="gutter">
          <span class="list-title"><?php echo $widget['listing_title'];?></span>
          <ul>
             <?php foreach($widget['urls'] as $list){ ?>
                <li><a href="<?php echo $list['url']; ?>"><?php echo $list['title']; ?></a></li>
             <?php } ?>
          </ul>
          <?php if($widget['field_link'] != ''){ ?>
            <a class="KCPL_readmore" href="<?php echo $widget['field_link']; ?>">More Info ≈</a>
          <?php } ?>
       </div>
    </div>

  <?php } 
  elseif($widget['field_type'] == 'recs'){
    //OC Recommendations  ?>

    <div class="KCPL_listing-style-3 KCPL_background-red">
       <div class="KCPL_listing-style-3-header">
          <span>Most Recommended Books<?php echo $widget['field_title']; ?></span>
      </div>
      
      <div class="KCPL_listing-style-3-body">
          
        Most Recommended Books from Online Community Here [OC Function]
          
       </div>
    </div>

  <?php }
  elseif($widget['field_type'] == 'listing-style-3'){
    //OC Discussions  ?>

    <div class="KCPL_listing-style-3 KCPL_background-red">
       <div class="KCPL_listing-style-3-header">
          <span>Recent Discussions<?php echo $widget['field_title']; ?></span>
      </div>
      
      <div class="KCPL_listing-style-3-body">
          
        Most Recent Discussion From Online Community Here [OC Function]
          
       </div>
    </div>

  <?php }
  elseif($widget['field_type'] == 'ask'){
    //listing style 3 ?>

    <div class="KCPL_single-featured ">
       <span class="title KCPL_background-<?php echo $widget['field_color']; ?>">Ask A Librarian</span>
       <div class="gutter">
          
        <iframe src="http://libraryh3lp.com/chat/kcpltest@chat.libraryh3lp.com?skin=13921&amp;theme=alphamod&amp;title=&amp;identity=KCPL&amp;sounds=true" frameborder="1" style="width: 100%; height: 360px; border: none;"> </iframe>
          
       </div>
    </div>

  <?php }
   elseif($widget['field_type'] == 'listing-style-2-1'){
    //listing style 3 ?>

    <div class="KCPL_listing2-event KCPL_background-<?php echo $widget['field_color']; ?>">
       <span class="title"><?php echo $widget['field_title']; ?></span>
       <div class="gutter">


        <div class="entry">
           <div class="left">
               <span class="entry-title">title</span>
           </div>
           <div class="right">
               <span class="entry-date">date time</span>
               <span class="entry-loc">location</span>
               <div class="entry-tags">
                 <a href="#">tags</a>
               </div>
           </div>
        </div>
        <div class="entry">
           <div class="left">
               <span class="entry-title">title</span>
           </div>
           <div class="right">
               <span class="entry-date">date time</span>
               <span class="entry-loc">location</span>
               <div class="entry-tags">
                 <a href="#">tags</a>
               </div>
           </div>
        </div>
         
       </div> 
      
    </div>

  <?php }
   elseif($widget['field_type'] == 'vertical-block'){ ?>

     <div class="KCPL_vertical-callout clearfix">
    <?php 
    //2-COLS HERE  
    $ctr = 1;
    foreach($widget['vertical_blocks'] as $entry){

      if($entry['vertical_type'] == "small-single"){ ?>
       <div class="columns two <?php if($ctr == 1) echo 'alpha'; else echo 'omega';?> ">
        <div class="KCPL_single-featured ?>">
          <span class="title KCPL_background-<?php echo $widget['field_color']; ?>"><?php echo $entry['section_title']; ?></span>
          <div class="gutter">

             <div class="entry">
                <span class="entry-title"><?php echo $entry['title']; ?></span>
                <span class="entry-date"><?php echo $entry['supporting_info']; ?></span>
                <div class="entry-excerpt">
                    <?php echo $entry['description']; ?>
                </div>
                <a href="<?php echo $entry['page_link']; ?>" class="KCPL_readmore"><?php echo $entry['page_link_text']; ?></a>
             </div>
          </div>
        </div>
      </div>
        
      <?php
      }
      elseif($entry['vertical_type'] == "vertical-button"){ ?>
       <div class="columns two <?php if($ctr == 1) echo 'alpha'; else echo 'omega';?>">
        <a href="<?php echo $entry['page_link']; ?>">
          <div class="KCPL_short-callout KCPL_background-<?php echo $widget['field_color']; ?>">
            <span><?php echo $entry['title']; ?></span>
          </div>
        </a>
      </div>
        
      <?php
      }
      elseif($entry['vertical_type'] == "social-feed"){ ?>
         <div class="columns two <?php if($ctr == 1) echo 'alpha'; else echo 'omega';?> ">
          <div class="KCPL_social-callout">
           <div class="KCPL_social-callout-header">
               <span>Follow Us</span>
           </div>
           <div class="KCPL_social-callout-body">
               <div class="KCPL_sprite-facebook KCPL_social-callout-icon"></div>
               <div class="KCPL_sprite-instagram KCPL_social-callout-icon"></div>
               <div class="KCPL_sprite-twitter KCPL_social-callout-icon"></div>
               <div class="KCPL_sprite-twitter KCPL_social-callout-icon"></div>
               <div class="KCPL_sprite-twitter KCPL_social-callout-icon"></div>
               <div class="KCPL_sprite-twitter KCPL_social-callout-icon"></div>

               <div class="clear"></div>

               <div class="KCPL_social-callout-tweet">
                   <span class="KCPL_social-callout-tweet-content">"Tweets Go Here #awesome"</span>
                   <span class="KCPL_social-callout-tweet-date">Date Here</span>
               </div>
           </div>
         </div>
        </div>    
      <?php 
     }
      else{

      }
      $ctr++;

    }?>
    </div> <?php

  }
  else{
    echo "Hasn't been configured yet. Deal with it.";
  }
} ?>
