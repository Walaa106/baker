<?php

/**
 * @file
 * Contains the vCard style plugin.
 */

/**
 * Default style plugin to render one or more vCards.
 */
class views_vcards_plugin_style_vcard extends views_plugin_style {

  function attach_to($display_id, $path, $title) {
    $url_options = array();
    $input = $this->view->get_exposed_input();
    if ($input) {
      $url_options['query'] = $input;
    }
    $url_options['absolute'] = TRUE;

    $url = url($this->view->get_url(NULL, $path), $url_options);

    if (empty($this->view->feed_icon)) {
      $this->view->feed_icon = '';
    }

    $this->view->feed_icon .= theme('views_vcards_vcard_icon', array(
        'url' => $url,
        'title' => $title,
      ));
  }


  function render() {
    if (empty($this->row_plugin)) {
      vpr('views_plugin_style_default: Missing row plugin');
      return;
    }

    $rows = array();
    foreach ($this->view->result as $row_index => $row) {
      $this->view->row_index = $row_index;

      $item = $this->row_plugin->vcard_parse_row($row_index);

      $desired_name = $suffixed_desired_name = $item->full_name;
      $iterator = 1;
      while (array_key_exists($suffixed_desired_name, $rows)) {
        $suffixed_desired_name = $desired_name.$iterator;
        $iterator ++;
      }

      $rows[$suffixed_desired_name] = $this->row_plugin->render($row);
    }

    $output = theme($this->theme_functions(),
      array(
        'view' => $this->view,
        'options' => $this->options,
        'rows' => $rows,
      ));
    unset($this->view->row_index);
    return $output;
  }
}
