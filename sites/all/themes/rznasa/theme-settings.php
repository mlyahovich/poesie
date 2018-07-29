<?php
/**
 * @file
 * theme-settings.php
 *
 * Provides theme settings for Bootstrap based themes when admin theme is not.
 *
 * @see ./includes/settings.inc
 */


/**
 * Implements hook_form_FORM_ID_alter().
 */
function rznasa_form_system_theme_settings_alter(&$form, $form_state, $form_id = NULL) {
  // Advanced settings.
  $form['mysetting'] = array(
    '#type' => 'fieldset',
    '#title' => t('My setting'),
    '#group' => 'bootstrap',
  );
  $form['mysetting']['background'] = array(
    '#type' => 'managed_file',
    '#title' => t('Background'),
    '#required' => FALSE,
    '#preview' => TRUE,
    '#upload_location' => file_default_scheme() . '://theme/backgrounds/',
    '#default_value' => theme_get_setting('background'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg'),
    ),
  );
  // Перезберігаємо картинку, якщо їй присвоєно статус "тимчасово".
  $image_custom_index = theme_get_setting('background');
  if ($image_custom_index) {
    // Грузимо нашу картинку.
    $file = file_load($image_custom_index);
    if ($file) {
      // Якщо статус дійсно "тимчасова", то ...
      if ($file->status == 0) {
        // Вставнолюємо нормальний статус
        $file->status = FILE_STATUS_PERMANENT;
        // Зберігаємо наш файл.
        file_save($file);
      }
    }
  }
  //ВИдаляємо картинки, які не використовуються цим полем
  $replace_text = 'public://theme/backgrounds';
  //Робимо вибірку fids, для цього поля
  $fids = db_select('file_managed', 'n')
    ->fields('n', array('fid'))
    ->condition('n.uri', '%' . db_like($replace_text) . '%', 'LIKE')
    ->execute()
    ->fetchCol();
  //грузимо всі файли
  $files = file_load_multiple($fids);
  //видаляємо ті, які зара не використовуються
  foreach($files as $file) {
    if ($file->fid != $image_custom_index) {
      file_delete($file);
    }
  }
}
