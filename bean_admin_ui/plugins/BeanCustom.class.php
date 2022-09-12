<?php

/**
 * @file
 * Bean ctools plugin
 */

/**
 * DO NOT USE THIS BEAN.  ONLY USED FOR THE UI PLUGINS
 */
class BeanCustom extends BeanPlugin {
  /**
   * Delete the record from the database.
   */
  public function delete() {
    db_delete('bean')
    ->condition('type', $this->type)
    ->execute();

    //ctools_include('export');
    ctools_export_crud_delete('bean_type', $this->type);
    field_attach_delete_bundle('bean', $this->type);

    bean_reset();
  }

  /**
   * Save the record to the database
   */
  public function save($new = FALSE) {
    $config = config('bean.type.' . $this->type);
    $config->set('name', check_plain($this->name));
    $config->set('label', check_plain($this->getLabel()));
    $config->set('description', check_plain($this->getDescription()));

    bean_reset();
  }

  /**
   * Revert the bean type to code defaults.
   */
  public function revert() {
    //ctools_include('export');
    ctools_export_crud_delete('bean_type', $this->type);
    bean_reset();
  }

  /**
   * Get the export status
   */
  public function getExportStatus() {
    return $this->plugin_info['export_status'];
  }

  /**
   * Set the label.
   *
   * @param label
   */
  public function setLabel($label) {
    $this->plugin_info['label'] = $label;
  }

  /**
   * Set the description.
   *
   * @param description
   */
  public function setDescription($description) {
    $this->plugin_info['description'] = $description;
  }

  /**
   * Build the URL string
   */
  public function buildURL() {
    return str_replace('_', '-', $this->type);
  }

}
