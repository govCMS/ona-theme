<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function agency_whitesite_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  agency_whitesite_preprocess_html($variables, $hook);
  agency_whitesite_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function agency_whitesite_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  // $variables['classes_array'] =
  //  array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function agency_whitesite_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function agency_whitesite_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // agency_whitesite_preprocess_node_page() or
  // agency_whitesite_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function agency_whitesite_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function agency_whitesite_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] =
  // array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function agency_whitesite_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];
}
// */

/**
 * Implementation for govcms_social_link.
 */
function agency_whitesite_govcms_social_link($variables) {
  $title = $variables['title'];
  $output = '';

  if ($title == 'Youtube') {
    $variables['icon'] = base_path() . drupal_get_path('theme', 'agency_whitesite') . '/images/youtube.png';
  }

  $service_image = theme('image', array(
    'path' => $variables['icon'],
    'title' => $variables['title'],
    'alt' => $variables['title'],
  ));

  $img_link = theme('link', array(
    'text' => $service_image,
    'path' => $variables['url'],
    'options' => array(
      'html' => TRUE,
      'attributes' => array('class' => array('social-links-img-link')),
    ),
  ));

  $title_link = theme('link', array(
    'text' => $title,
    'path' => $variables['url'],
    'options' => array(
      'html' => TRUE,
      'attributes' => array('class' => array('social-links-title-title')),
    ),
  ));

  $output .= '<div class="social-link">'  . $img_link   . $title_link . '</div>';
  return $output;
}

/**
 * Returns HTML for a button form element.
 */
function agency_whitesite_button($variables) {
  $element = $variables['element'];
  $element['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));

  $element['#attributes']['class'][] = 'form-' . $element['#button_type'];
  if (!empty($element['#attributes']['disabled'])) {
    $element['#attributes']['class'][] = 'form-button-disabled';
  }

  return '<button' . drupal_attributes($element['#attributes']) . ' />' . $element['#attributes']['value'] . '</button>';
}

/**
 * Implements hook_form_alter().
 */
function agency_whitesite_form_search_api_page_search_form_default_search_alter(&$form, &$form_state, $form_id) {
  if (isset($form['id']['#value']) && isset($form['keys_' . $form['id']['#value']])) {
    $form['keys_' . $form['id']['#value']]['#attributes']['placeholder'] = t('Search website…');
  }
}

/**
 * Implements hook_preprocess_panels_pane().
 */
function agency_whitesite_preprocess_panels_pane(&$variables) {
  if ($variables['pane']->type == 'bean_panels' && isset($variables['pane']->configuration['bean_delta'])) {
    $delta = $variables['pane']->configuration['bean_delta'];
    $variables['theme_hook_suggestions'][] = 'panels_pane__' . str_replace('-', '_', $delta);
  }
}

/**
 * Returns HTML for a query pager.
 */
function agency_whitesite_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  // $quantity = $variables['quantity'];
  $quantity = 5;
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece.
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // Current is the page we are currently paged to.
  $pager_current = $pager_page_array[$element] + 1;
  // First is the first page listed by this pager piece (re quantity.)
  $pager_first = $pager_current - $pager_middle + 1;
  // Last is the last page listed by this pager piece (re quantity.)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // Max is the maximum page number.
  $pager_max = $pager_total[$element];

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }

  $li_first = theme('pager_first__responsive', array(
    'text' => (isset($tags[0]) ? $tags[0] : t('« first')),
    'element' => $element,
    'parameters' => $parameters,
  ));
  $li_previous = theme('pager_previous__responsive', array(
    'text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')),
    'element' => $element,
    'interval' => 1,
    'parameters' => $parameters,
  ));
  $li_next = theme('pager_next__responsive', array(
    'text' => (isset($tags[3]) ? $tags[3] : t('next ›')),
    'element' => $element,
    'interval' => 1,
    'parameters' => $parameters,
  ));
  $li_last = theme('pager_last__responsive', array(
    'text' => (isset($tags[4]) ? $tags[4] : t('last »')),
    'element' => $element,
    'parameters' => $parameters,
  ));

  $items = array(
    'pages' => array(
      'class' => array('pager-responsive__pages'),
      'children' => array(),
    ),
    'start' => array(
      'class' => array('pager-responsive__start-nav'),
      'children' => array(),
    ),
    'end' => array(
      'class' => array('pager-responsive__end-nav'),
      'children' => array(),
    ),
  );
  if ($pager_total[$element] > 1) {
    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items['pages']['children'][] = array(
          'class' => array('pager-responsive__item', 'pager-responsive__item-ellipsis'),
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items['pages']['children'][] = array(
            'class' => array('pager-responsive__item'),
            'data' => theme('pager_previous__responsive', array(
              'text' => $i,
              'element' => $element,
              'interval' => ($pager_current - $i),
              'parameters' => $parameters,
            )),
          );
        }
        if ($i == $pager_current) {
          $items['pages']['children'][] = array(
            'class' => array('pager-responsive__item', 'pager-responsive__item-current'),
            'data' => $i,
          );
        }
        if ($i > $pager_current) {
          $items['pages']['children'][] = array(
            'class' => array('pager-responsive__item'),
            'data' => theme('pager_next__responsive', array(
              'text' => $i,
              'element' => $element,
              'interval' => ($i - $pager_current),
              'parameters' => $parameters,
            )),
          );
        }
      }
      if ($i < $pager_max) {
        $items['pages']['children'][] = array(
          'class' => array('pager-responsive__item', 'pager-responsive__item-ellipsis'),
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_first) {
      $items['start']['children'][] = array(
        'class' => array('pager-responsive__item', 'pager-responsive__item-nav'),
        'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items['start']['children'][] = array(
        'class' => array('pager-responsive__item', 'pager-responsive__item-nav'),
        'data' => $li_previous,
      );
    }
    if ($li_next) {
      $items['end']['children'][] = array(
        'class' => array('pager-responsive__item', 'pager-responsive__item-nav'),
        'data' => $li_next,
      );
    }
    if ($li_last) {
      $items['end']['children'][] = array(
        'class' => array('pager-responsive__item', 'pager-responsive__item-nav'),
        'data' => $li_last,
      );
    }
    return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list__pager', array(
      'items' => $items,
      'attributes' => array('class' => array('pager-responsive')),
    ));
  }
}

/**
 * Returns HTML for a link to a specific query result page.
 */
function agency_whitesite_pager_link__responsive($variables) {
  $variables['attributes']['class'][] = 'pager-responsive__link';
  return theme_pager_link($variables);
}

/**
 * Returns HTML for the "first page" link in a query pager.
 */
function agency_whitesite_pager_first__responsive($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  global $pager_page_array;
  $output = '';

  $output = theme('pager_link__responsive', array(
    'text' => $text,
    'page_new' => pager_load_array(0, $element, $pager_page_array),
    'element' => $element,
    'parameters' => $parameters,
  ));

  return $output;
}

/**
 * Returns HTML for the "previous page" link in a query pager.
 */
function agency_whitesite_pager_previous__responsive($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  global $pager_page_array;
  $output = '';

  $page_new = pager_load_array($pager_page_array[$element] - $interval, $element, $pager_page_array);

  // If the previous page is the first page, mark the link as such.
  if ($page_new[$element] <= 0) {
    $output = theme('pager_first__responsive', array(
      'text' => $text,
      'element' => $element,
      'parameters' => $parameters,
    ));
  }
  // The previous page is not the first page.
  else {
    $output = theme('pager_link__responsive', array(
      'text' => $text,
      'page_new' => $page_new,
      'element' => $element,
      'parameters' => $parameters,
    ));
  }

  return $output;
}

/**
 * Returns HTML for the "next page" link in a query pager.
 */
function agency_whitesite_pager_next__responsive($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  global $pager_page_array, $pager_total;
  $output = '';

  $page_new = pager_load_array($pager_page_array[$element] + $interval, $element, $pager_page_array);
  // If the next page is the last page, mark the link as such.
  if ($page_new[$element] >= ($pager_total[$element] - 1)) {
    $output = theme('pager_last__responsive', array(
      'text' => $text,
      'element' => $element,
      'parameters' => $parameters,
    ));
  }
  // The next page is not the last page.
  else {
    $output = theme('pager_link__responsive', array(
      'text' => $text,
      'page_new' => $page_new,
      'element' => $element,
      'parameters' => $parameters,
    ));
  }

  return $output;
}

/**
 * Returns HTML for the "last page" link in query pager.
 */
function agency_whitesite_pager_last__responsive($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  global $pager_page_array, $pager_total;
  $output = '';

  $output = theme('pager_link__responsive', array(
    'text' => $text,
    'page_new' => pager_load_array($pager_total[$element] - 1, $element, $pager_page_array),
    'element' => $element,
    'parameters' => $parameters,
  ));

  return $output;
}

/**
 * Returns HTML for a list or nested list of items.
 */
function agency_whitesite_item_list__pager($variables) {
  $items = $variables['items'];
  $attributes = $variables['attributes'];
  $output = '';
  $attributes['class'][] = 'pager-responsive__list';

  if (!empty($items)) {
    $output .= '<ul' . drupal_attributes($attributes) . '>';
    $num_items = count($items);
    $i = 0;
    foreach ($items as $item) {
      $attributes = array();
      $children = array();
      $data = '';
      $i++;
      if (is_array($item)) {
        foreach ($item as $key => $value) {
          if ($key == 'data') {
            $data = $value;
          }
          elseif ($key == 'children') {
            $children = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $data = $item;
      }
      if (count($children) > 0) {
        // Render nested list.
        $data .= agency_whitesite_item_list__pager(array(
          'items' => $children,
          'attributes' => array(),
        ));
      }
      $output .= '<li' . drupal_attributes($attributes) . '>' . $data . '</li>';
    }
    $output .= '</ul>';
  }
  return $output;
}

/**
 * Implements hook_preprocess_menu_link().
 */
function agency_whitesite_preprocess_menu_link(&$variables, $hook) {
  // For quick links, load the svg icons.
  if (isset($variables['element']['#bid']['delta']) && $variables['element']['#bid']['delta'] == 'ctools-menu-frontpage-quicklinks-1') {
    $svg = '';
    switch ($variables['element']['#original_link']['mlid']) {
      case '695':
        $svg = 'sample-svg';
        break;

      case '696':
        $svg = 'sample-svg';
        break;

      case '697':
        $svg = 'sample-svg';
        break;

      case '698':
        $svg = 'sample-svg';
        break;

      case '699':
        $svg = 'sample-svg';
        break;
    }
    if ($svg) {
      $svg = file_get_contents(DRUPAL_ROOT . '/' . drupal_get_path('theme', 'agency_whitesite') . '/images/icons/quick-links--' . $svg . '.svg');
    }
    $variables['element']['#localized_options']['attributes']['class'] = array('quick-links__link');
    $variables['element']['#attributes']['class'] = array('quick-links__item');
    $variables['element']['#title'] = $svg . ' ' . check_plain($variables['element']['#title']);
    $variables['element']['#localized_options']['html'] = TRUE;
  }
}


/// make the timestamp pretty
function agency_whitesite_preprocess_node(&$vars, $hook) {
  $vars['submitted'] = "<span class='postedStart'>Posted </span>".
                       "<span class='postedTime'>at " . date("g:ia", $vars['created']) . " </span>".
                       "<span class='postedDate'>on " . date("l, M jS, Y", $vars['created']) . " </span>".
                       "<span class='postedBy'>by " . $vars['name'] ."</span>";
}
