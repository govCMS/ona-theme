<?php


function ona_preprocess_page(&$variables) {
  $path = drupal_get_path('theme', 'ona');
  $my_settings = array(
    'themePath' => $path,
  );
  drupal_add_js(array('myTheme' => $my_settings), 'setting');

}

