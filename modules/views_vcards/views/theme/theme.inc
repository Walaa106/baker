<?php

/**
 * @file
 * Preprocessors and helper functions to make theming easier.
 */

/**
 * Preprocess a vCards list.
 */
function template_preprocess_views_vcards_view_vcard(&$vars) {
  $view = &$vars['view'];
  $options = &$vars['options'];
  $items = &$vars['rows'];

  $style = &$view->style_plugin;

  // Figure out which display which has a path we're using for this feed. If
  // there isn't one, use the global $base_url.
  $link_display_id = $view->display_handler->get_link_display();
  if ($link_display_id && !empty($view->display[$link_display_id])) {
    $path = $view->display[$link_display_id]->handler->get_path();
  }

  if ($path) {
    $path = $view->get_url(NULL, $path);
    $url_options = array('absolute' => TRUE);
    if (!empty($view->exposed_raw_input)) {
      $url_options['query'] = $view->exposed_raw_input;
    }

    // Compare the link to the default home page; if it's the default home
    // page, just use $base_url.
    if ($path == variable_get('site_frontpage', 'node')) {
      $path = '';
    }

    $vars['link'] = check_url(url($path, $url_options));
  }

  // During live preview we don't want to output the header since the contents
  // of the feed are being displayed inside a normal HTML page.
  if (empty($vars['view']->live_preview)) {

    // Only build the zip if we are not watching the preview.
    if (count($items) > 1) {

      // Try to load the library and check if that worked.
      if (($library = libraries_load('zipstream')) && !empty($library['loaded'])) {
        $zip = new ZipStream\ZipStream();
        foreach ($items as $name => $item) {
          $zip->addFile($name . '.vcf', $item);
        }
        $zip->finish();
      }
      else {
        drupal_set_message(t("The zipstream library was not loaded"), 'error');
      }
      // Even though we present a zip with download headers, the view needs
      // something otherwise it crashes.
      $vars['items'] = 'foo';

      // Add headers for zip file. Content is already built by $zip->finish().
      drupal_add_http_header('Content-Type', 'application/zip');
      drupal_add_http_header('Content-Disposition', 'attachment; filename=' .
        $view->human_name . '.zip');
      drupal_add_http_header('Pragma', 'no-cache');
      drupal_add_http_header('Expires', '0');
    }
    else {
      // Only one item? Add headers for vCard and output single (first) item.
      $filename = key($items);
      if (module_exists('pathauto')) {
        module_load_include('inc', 'pathauto', 'pathauto');
        $filename = pathauto_cleanstring($filename);
      }
      $filename = drupal_encode_path($filename);
      if (empty($filename)){
        $filename = 'vcard';
      }

      drupal_add_http_header('Content-Type', 'text/vcard; charset=utf-8');
      drupal_add_http_header('Content-Disposition', 'attachment; filename=' .
        $filename . '.vcf');

      $vars['items'] = array_shift($items);
    }
  }
  else {
    // If we are in preview mode, just place all vCards under each other.
    $vars['items'] = implode("\n", $items);
  }
}

/**
 * Default theme function for all vCards entries.
 *
 * Sanitizes all items on a row.
 */
function template_preprocess_views_vcards_view_row_vcard(&$vars) {
  $view = &$vars['view'];
  $options = &$vars['options'];
  $item = &$vars['row'];

  $vars['first_name']     = filter_xss($item->first_name, array());
  $vars['middle_name']    = filter_xss($item->middle_name, array());
  $vars['last_name']      = filter_xss($item->last_name, array());
  $vars['full_name']      = filter_xss($item->full_name, array());
  $vars['title']          = filter_xss($item->title, array());
  $vars['email']          = filter_xss($item->email, array());
  $vars['email2']         = filter_xss($item->email2, array());
  $vars['email3']         = filter_xss($item->email3, array());
  $vars['home_address']   = filter_xss($item->home_address, array());
  $vars['home_city']      = filter_xss($item->home_city, array());
  $vars['home_state']     = filter_xss($item->home_state, array());
  $vars['home_zip']       = filter_xss($item->home_zip, array());
  $vars['home_country']   = filter_xss($item->home_country, array());
  $vars['home_phone']     = filter_xss($item->home_phone, array());
  $vars['home_cellphone'] = filter_xss($item->home_cellphone, array());
  $vars['home_website']   = filter_xss($item->home_website, array());
  $vars['work_title']     = filter_xss($item->work_title, array());
  $vars['work_company']   = filter_xss($item->work_company, array());
  $vars['work_address']   = filter_xss($item->work_address, array());
  $vars['work_city']      = filter_xss($item->work_city, array());
  $vars['work_state']     = filter_xss($item->work_state, array());
  $vars['work_zip']       = filter_xss($item->work_zip, array());
  $vars['work_country']   = filter_xss($item->work_country, array());
  $vars['work_phone']     = filter_xss($item->work_phone, array());
  $vars['work_fax']       = filter_xss($item->work_fax, array());
  $vars['work_website']   = filter_xss($item->work_website, array());
  $vars['photo']          = filter_xss($item->photo, array());
}
