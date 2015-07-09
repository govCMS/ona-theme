<?php
/**
 * @file
 * Returns the HTML for a Panels pane.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/2052505
 */
?>
<?php print $pane_prefix; ?>
<div class="<?php print $classes; ?> mission">
  <?php print $admin_links; ?>

  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <h2 class="mission__title"><?php print $title; ?></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($feeds): ?>
    <div class="feed">
      <?php print $feeds; ?>
    </div>
  <?php endif; ?>

  <div class="mission__statement">
    <?php print render($content); ?>
  </div>

  <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <div class="more-link">
      <?php print $more; ?>
    </div>
  <?php endif; ?>

</div>
<?php print $pane_suffix; ?>
