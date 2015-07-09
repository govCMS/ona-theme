<?php
/**
 * @file
 * Overridden template implementation to display the value of a field.
 */
?>
<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if (!$label_hidden): ?>
    <h2<?php print $title_attributes; ?>><?php print $label ?></h2>
  <?php endif; ?>
  <ul>
    <?php foreach ($items as $delta => $item): ?>
	  <li><?php print $item_attributes[$delta]; ?><?php print render($item); ?></li>
    <?php endforeach; ?>
    </ul>
</div>
