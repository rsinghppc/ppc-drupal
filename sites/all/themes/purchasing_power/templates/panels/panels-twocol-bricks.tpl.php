<div class="panel-display panel-2col-bricks clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="panel-panel panel-col-top">
    <div class="inside"><?php print $content['top']; ?></div>
  </div>
  <div class="center-wrapper center-wrapper-top clearfix">
    <div class="panel-panel panel-col-first">
      <div class="inside"><?php print $content['left_above']; ?></div>
    </div>
    <div class="panel-panel panel-col-last">
      <div class="inside"><?php print $content['right_above']; ?></div>
    </div>
  </div>
  <div class="panel-panel panel-col-middle">
    <div class="inside"><?php print $content['middle']; ?></div>
  </div>
  <div class="center-wrapper center-wrapper-bottom clearfix">
    <div class="panel-panel panel-col-first">
      <div class="inside"><?php print $content['left_below']; ?></div>
    </div>
    <div class="panel-panel panel-col-last">
      <div class="inside"><?php print $content['right_below']; ?></div>
    </div>
  </div>
  <div class="panel-panel panel-col-bottom">
    <div class="inside"><?php print $content['bottom']; ?></div>
  </div>
</div>