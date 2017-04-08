<?php

namespace Drupal\views_vcards\Plugin\views\row;

use Drupal\views\Plugin\views\row\RowPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Renders a vCard item based on fields.
 *
 * @ingroup views_row_plugins
 *
 * @ViewsRow(
 *   id = "views_vcard_fields",
 *   title = @Translation("vCard"),
 *   help = @Translation("Combines fields into a vCard."),
 *   theme = "views_vcards_view_row_vcard",
 *   display_types = {"vcard"}
 * )
 */
class ViewsVcardsRowPluginVcard extends RowPluginBase {

  /**
   * Does the row plugin support to add fields to it's output.
   *
   * @var bool
   */
  protected $usesFields = TRUE;

  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['name_email']['first'] = array('default' => '');
    $options['name_email']['middle'] = array('default' => '');
    $options['name_email']['last'] = array('default' => '');
    $options['name_email']['full'] = array('default' => '');
    $options['name_email']['title'] = array('default' => '');
    $options['name_email']['email'] = array('default' => '');
    $options['name_email']['email2'] = array('default' => '');
    $options['name_email']['email3'] = array('default' => '');
    $options['home']['home_address'] = array('default' => '');
    $options['home']['home_city'] = array('default' => '');
    $options['home']['home_state'] = array('default' => '');
    $options['home']['home_zip'] = array('default' => '');
    $options['home']['home_country'] = array('default' => '');
    $options['home']['home_phone'] = array('default' => '');
    $options['home']['home_cellphone'] = array('default' => '');
    $options['home']['home_website'] = array('default' => '');
    $options['work']['work_title'] = array('default' => '');
    $options['work']['work_company'] = array('default' => '');
    $options['work']['work_address'] = array('default' => '');
    $options['work']['work_city'] = array('default' => '');
    $options['work']['work_state'] = array('default' => '');
    $options['work']['work_zip'] = array('default' => '');
    $options['work']['work_country'] = array('default' => '');
    $options['work']['work_phone'] = array('default' => '');
    $options['work']['work_fax'] = array('default' => '');
    $options['work']['work_website'] = array('default' => '');
    return $options;
  }

  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $initial_labels = array('' => $this->t('- None -'));
    $view_fields_labels = $this->displayHandler->getFieldLabels();
    $view_fields_labels = array_merge($initial_labels, $view_fields_labels);

    $form['name_email'] = array(
      '#type' => 'details',
      '#title' => $this->t('Name and E-mail'),
      '#open' => TRUE,
    );

    $form['name_email']['first'] = array(
      '#type' => 'select',
      '#title' => $this->t('First name'),
      '#description' => $this->t('The field that is going to be used as the first name for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['name_email']['first'],
      '#required' => TRUE,
    );

    $form['name_email']['middle'] = array(
      '#type' => 'select',
      '#title' => $this->t('Middle name'),
      '#description' => $this->t('The field that is going to be used as the middle name for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['name_email']['middle'],
      '#required' => FALSE,
    );

    $form['name_email']['last'] = array(
      '#type' => 'select',
      '#title' => $this->t('Last name'),
      '#description' => $this->t('The field that is going to be used as the last name for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['name_email']['last'],
      '#required' => TRUE,
    );

    $form['name_email']['full'] = array(
      '#type' => 'select',
      '#title' => $this->t('Full name'),
      '#description' => $this->t('The field that is going to be used as the full name for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['name_email']['full'],
      '#required' => TRUE,
    );

    $form['name_email']['title'] = array(
      '#type' => 'select',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The field that is going to be used as the title for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['name_email']['title'],
      '#required' => FALSE,
    );

    $form['name_email']['email'] = array(
      '#type' => 'select',
      '#title' => $this->t('Primary E-mail'),
      '#description' => $this->t('The field that is going to be used as the primary e-mail address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['name_email']['email'],
      '#required' => TRUE,
    );

    $form['name_email']['email2'] = array(
      '#type' => 'select',
      '#title' => $this->t('Secondary E-mail'),
      '#description' => $this->t('The field that is going to be used as the secondary e-mail address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['name_email']['email2'],
      '#required' => FALSE,
    );

    $form['name_email']['email3'] = array(
      '#type' => 'select',
      '#description' => $this->t('The field that is going to be used as the tertiary e-maila address for each vCard.'),
      '#title' => $this->t('Tertiary E-mail'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['name_email']['email3'],
      '#required' => FALSE,
    );

    $form['home'] = array(
      '#type' => 'details',
      '#title' => $this->t('Home'),
      '#open' => FALSE,
    );

    $form['home']['home_address'] = array(
      '#type' => 'select',
      '#title' => $this->t('Address'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['home']['home_address'],
      '#required' => FALSE,
    );

    $form['home']['home_city'] = array(
      '#type' => 'select',
      '#title' => $this->t('City'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['home']['home_city'],
      '#required' => FALSE,
    );

    $form['home']['home_state'] = array(
      '#type' => 'select',
      '#title' => $this->t('State/Province'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['home']['home_state'],
      '#required' => FALSE,
    );

    $form['home']['home_zip'] = array(
      '#type' => 'select',
      '#title' => $this->t('Zip'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['home']['home_zip'],
      '#required' => FALSE,
    );

    $form['home']['home_country'] = array(
      '#type' => 'select',
      '#title' => $this->t('Country'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['home']['home_country'],
      '#required' => FALSE,
    );

    $form['home']['home_phone'] = array(
      '#type' => 'select',
      '#title' => $this->t('Phone'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['home']['home_phone'],
      '#required' => FALSE,
    );

    $form['home']['home_cellphone'] = array(
      '#type' => 'select',
      '#title' => $this->t('Cellphone'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['home']['home_cellphone'],
      '#required' => FALSE,
    );

    $form['home']['home_website'] = array(
      '#type' => 'select',
      '#title' => $this->t('Website'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['home']['home_website'],
      '#required' => FALSE,
    );

    $form['work'] = array(
      '#type' => 'details',
      '#title' => $this->t('Work'),
      '#open' => FALSE,
    );

    $form['work']['work_title'] = array(
      '#type' => 'select',
      '#title' => $this->t('Title'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['work']['work_title'],
      '#required' => FALSE,
    );

    $form['work']['work_company'] = array(
      '#type' => 'select',
      '#title' => $this->t('Company'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['work']['work_company'],
      '#required' => FALSE,
    );

    $form['work']['work_address'] = array(
      '#type' => 'select',
      '#title' => $this->t('Address'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['work']['work_address'],
      '#required' => FALSE,
    );

    $form['work']['work_city'] = array(
      '#type' => 'select',
      '#title' => $this->t('City'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['work']['work_city'],
      '#required' => FALSE,
    );

    $form['work']['work_state'] = array(
      '#type' => 'select',
      '#title' => $this->t('State/Province'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['work']['work_state'],
      '#required' => FALSE,
    );

    $form['work']['work_zip'] = array(
      '#type' => 'select',
      '#title' => $this->t('Zip'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['work']['work_zip'],
      '#required' => FALSE,
    );

    $form['work']['work_country'] = array(
      '#type' => 'select',
      '#title' => $this->t('Country'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['work']['work_country'],
      '#required' => FALSE,
    );

    $form['work']['work_phone'] = array(
      '#type' => 'select',
      '#title' => $this->t('Phone'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['work']['work_phone'],
      '#required' => FALSE,
    );

    $form['work']['work_fax'] = array(
      '#type' => 'select',
      '#title' => $this->t('Fax'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['work']['work_fax'],
      '#required' => FALSE,
    );

    $form['work']['work_website'] = array(
      '#type' => 'select',
      '#title' => $this->t('Website'),
      '#description' => $this->t('The field that is going to be used as the address for each vCard.'),
      '#options' => $view_fields_labels,
      '#default_value' => $this->options['work']['work_website'],
      '#required' => FALSE,
    );
  }

  /**
   * {@inheritdoc}
   */
  public function validate() {
    $errors = parent::validate();
    $required_options = array(
      'name_email' => array(
        'first',
        'last',
        'full',
        'email'
      ),
    );

    foreach ($required_options as $group => $options) {
      foreach ($options as $required_option) {
        if (empty($this->options[$group][$required_option])) {
          $errors[] = $this->t('Some required fields are missing to construct a valid vCard. Check the vCard formatter settings.');
          break;
        }
      }
    }
    return $errors;
  }

  /**
   * {@inheritdoc}
   */
  public function render($row) {
    static $row_index;
    if (!isset($row_index)) {
      $row_index = 0;
    }

    // Create the vCard item object.
    $item = new \stdClass();
    $item->first_name     = $this->getField($row_index, $this->options['name_email']['first']);
    $item->middle_name    = $this->getField($row_index, $this->options['name_email']['middle']);
    $item->last_name      = $this->getField($row_index, $this->options['name_email']['last']);
    $item->full_name      = $this->getField($row_index, $this->options['name_email']['full']);
    $item->title          = $this->getField($row_index, $this->options['name_email']['title']);
    $item->email          = $this->getField($row_index, $this->options['name_email']['email']);
    $item->email2         = $this->getField($row_index, $this->options['name_email']['email2']);
    $item->email3         = $this->getField($row_index, $this->options['name_email']['email3']);
    $item->home_address   = $this->getField($row_index, $this->options['home']['home_address']);
    $item->home_city      = $this->getField($row_index, $this->options['home']['home_city']);
    $item->home_state     = $this->getField($row_index, $this->options['home']['home_state']);
    $item->home_zip       = $this->getField($row_index, $this->options['home']['home_zip']);
    $item->home_country   = $this->getField($row_index, $this->options['home']['home_country']);
    $item->home_phone     = $this->getField($row_index, $this->options['home']['home_phone']);
    $item->home_cellphone = $this->getField($row_index, $this->options['home']['home_cellphone']);
    $item->home_website   = $this->getField($row_index, $this->options['home']['home_website']);
    $item->work_title     = $this->getField($row_index, $this->options['work']['work_title']);
    $item->work_company   = $this->getField($row_index, $this->options['work']['work_company']);
    $item->work_address   = $this->getField($row_index, $this->options['work']['work_address']);
    $item->work_city      = $this->getField($row_index, $this->options['work']['work_city']);
    $item->work_state     = $this->getField($row_index, $this->options['work']['work_state']);
    $item->work_zip       = $this->getField($row_index, $this->options['work']['work_zip']);
    $item->work_country   = $this->getField($row_index, $this->options['work']['work_country']);
    $item->work_phone     = $this->getField($row_index, $this->options['work']['work_phone']);
    $item->work_fax       = $this->getField($row_index, $this->options['work']['work_fax']);
    $item->work_website   = $this->getField($row_index, $this->options['work']['work_website']);

    $row_index++;

    $build = array(
      '#theme' => $this->themeFunctions(),
      '#view' => $this->view,
      '#options' => $this->options,
      '#row' => $item,
      '#field_alias' => isset($this->field_alias) ? $this->field_alias : '',
    );

    return $build;
  }

  /**
   * Retrieves a views field value from the style plugin.
   *
   * @param $index
   *   The index count of the row as expected by views_plugin_style::getField().
   * @param $field_id
   *   The ID assigned to the required field in the display.
   *
   * @return string|null|\Drupal\Component\Render\MarkupInterface
   *   An empty string if there is no style plugin, or the field ID is empty.
   *   NULL if the field value is empty. If neither of these conditions apply,
   *   a MarkupInterface object containing the rendered field value.
   */
  public function getField($index, $field_id) {
    if (empty($this->view->style_plugin) || !is_object($this->view->style_plugin) || empty($field_id)) {
      return '';
    }
    // Convert plaintext into render array.
    $field =  $this->view->style_plugin->getField($index, $field_id);
    return is_array($field) ? $field : ['#markup' => $field];
  }

}
