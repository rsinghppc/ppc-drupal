<div<?php print drupal_attributes( $pane_attributes ); ?>>
  <?php if( isset( $content->title ) ): ?>
  <h2 class="pane-title"><?php print $content->title; ?></h2>
  <?php endif ?>
  <div class="pane-content">
    <?php print render( $content->content ); ?>
  </div>
</div>