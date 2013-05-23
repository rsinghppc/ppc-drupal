<article<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php print render($title_suffix); ?>
  <div class="profile">
    <h2 class="alternate-title">Client Profile</h2>
    <div class="clearfix content">
      <?php print render( $content[ 'field_study_image' ] ); ?>
      <?php print render( $content[ 'body' ] ); ?>
    </div>
  </div>
  <div class="clearfix">
    <div class="right-column">
      <div class="testimonials">
        <h2 class="alternate-title">Testimonials</h2>
        <div class="content">
          <?php print render( $content[ 'field_testimonials' ] ); ?>
          <p class="watch-more"><a href="http://www.youtube.com/PurchasingPowerTV" target="_blank" class="external""><strong>Watch Customer Video Testimonials</strong></a></p>
        </div>
      </div>
    </div>
    <div class="left-column">
      <div class="performance">
        <h2>Program Performance (as at <?php print strip_tags( render( $content[ 'field_performance_as_at' ] ) ); ?>)</h2>
        <div class="content">
          <?php print render( $content[ 'field_performance' ] ); ?>
        </div>    
      </div>
      <div class="reasons">
        <h2>Reasons for Offering the Program</h2>
        <div class="content">
          <?php print render( $content[ 'field_reasons' ] ); ?>
        </div>
      </div>
      <div class="marketing-plan">
        <h2>Marketing Plan</h2>
        <div class="content">
          <?php print render( $content[ 'field_marketing_plan' ] ); ?>
        </div>
      </div>        
    </div>
  </div>

  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>
  
</article>