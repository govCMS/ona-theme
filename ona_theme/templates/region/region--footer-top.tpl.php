<?php
/**
 * @file
 * Returns the HTML for the footer region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728140
 */
?>
<?php if ($content): ?>
  <div id="footer-top" class="<?php print $classes; ?> clearfix">
    <h2 class="element-invisible">Footer Top</h2>
    <?php print $content; ?>
  </div>
<?php endif; ?>
