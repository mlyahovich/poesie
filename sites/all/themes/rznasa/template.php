<?php
/**
 * @file
 * The primary PHP file for this theme.
 */

/**
 * Implement hook_breadcrumb().
 */
function rznasa_breadcrumb()
{
  $menu_item = menu_get_item();
  $output = '<ol class="breadcrumb">';
  $breadcrumb = array();
  $breadcrumb[] = '<li>' . l(t('Home'), '<front>') . '</li>';

  if (drupal_is_front_page()) {

  } elseif ($menu_item['path'] == 'node/%' && isset($menu_item['page_arguments'][0]->field_verse_category['und'][0]['tid']) && $menu_item['page_arguments'][0]->type == 'verse') {
    $tid = $menu_item['page_arguments'][0]->field_verse_category['und'][0]['tid'];
    $term_name = taxonomy_term_load((int)$tid);
    $breadcrumb[] = '<li>' . l(t('Всі вірші'), 'verse/all') . '</li>';
    $breadcrumb[] = '<li>' . l(t($term_name->name), drupal_get_path_alias('taxonomy/term/' . $tid)) . '</li>';
    $breadcrumb[] = '<li>' . drupal_get_title() . '</li>';
  } else {
    $breadcrumb[] = '<li>' . drupal_get_title() . '</li>';
  }

  $output .= implode('', $breadcrumb) . '</ol>';
  return $output;
}


/**
 * Implements hook_block_view_alter().
 */
function rznasa_block_view_alter(&$data, $block)
{

  /**
   * For block under product (social buttons).
   * http://donreach.com/social-share-buttons
   * todo remote FALSE
   */
  if ($block->delta == '11' && FALSE) {

    $path = drupal_lookup_path('alias', $_GET['q'], null);

    $style_name = 'social_480x250_';
    $current_page = menu_get_item();
    $uri = $current_page['page_arguments'][0]->field_verse_img['und'][0]['uri'];

    $image_path = image_style_url($style_name, $uri);
    $res_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $path;

    $comment_text = t('Відгуки');

    $html = <<<html
  <div class="don-share" data-limit="3" data-url="{$res_url}" data-image="{$image_path}" >
    <div class="don-share-total"></div>
    <div class="don-share-vk"></div>
    <div class="don-share-facebook"></div>
    <div class="don-share-google"></div>
    <div class="don-share-twitter"></div>
    <div class="don-share-linkedin"></div>
    <div class="don-share-pinterest"></div>
    <div class="don-share-tumblr"></div>
    <div class="don-share-stumbleupon"></div>
    <div class="don-share-buffer"></div>
  </div>

  <!--Лайки вконтакте-->
  <div id="vk_like" class="col-sm-6"></div>
  <script type="text/javascript">
      VK.Widgets.Like("vk_like", {type: "button", height: 30});
  </script>

  <!--Лайки фейсбук-->
  <div class="fb-like col-sm-6" data-href="{$res_url}" data-layout="button_count" data-action="like" size="large" data-size="large" data-show-faces="true" data-share="false"></div>

  <h2 class="comments">{$comment_text}</h2>

html;

$html_after_vk_blocked = <<<html
  <!--Лайки фейсбук-->
  <div class="fb-like col-sm-6" data-href="{$res_url}" data-layout="button_count" data-action="like" size="large" data-size="large" data-show-faces="true" data-share="false"></div>

  <h2 class="comments">{$comment_text}</h2>

html;

    $data['content'] = $html_after_vk_blocked;

  };

}

/**
 * Implement hook_preprocess_page().
 */
function rznasa_preprocess_page(&$variables)
{

  $fid = theme_get_setting('background');
  if (!empty($fid) && file_load($fid)) {
    $variables['background_url'] = file_create_url(file_load($fid)->uri);
  }

  $menu_item = menu_get_item();

  if ($menu_item['path'] == 'verse/%' && $menu_item['href'] == 'verse/all') {
    $variables['theme_hook_suggestions'][0] = 'page__taxonomy';
    $variables['theme_hook_suggestions'][1] = 'page__taxonomy__term';
  }

  if (isset($variables['node']) && $variables['node']->type == 'verse') {
    $variables['social'] = _block_get_renderable_array(_block_render_blocks(array(
      block_load('block', '11'),
    )));

    $variables['page']['bodys'] = $menu_item['page_arguments'][0]->field_boby['und'][0]['value'];

    if ($menu_item['href'] != 'verse/all' && isset($menu_item['page_arguments'][0]->field_verse_img['und'][0]['uri'])) {
      $image_path = $menu_item['page_arguments'][0]->field_verse_img['und'][0]['uri'];

      $image_url = image_style_url('fullhd', $image_path);
      $variables['image_url'] = $image_url;
    } elseif ($menu_item['href'] == 'verse/all') {
      $variables['image_url'] = '';
    }

  }

  if ($menu_item['path'] == 'taxonomy/term/%' && isset($menu_item['page_arguments'][0]->name)) {
    $variables['term_name'] = $menu_item['page_arguments'][0]->name;
  }

  // Add template suggestions based on content type
  if (isset($variables['node']->type) && $variables['node']->type == 'verse') {
    $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
  }
}

/**
 * Implement hook_preprocess_node().
 */
function rznasa_preprocess_node(&$variables)
{

  // todo remove FALSE
  if ($variables['node']->type == 'verse' && FALSE) {

    $variables['test'] = $variables['content']['disqus'];
    $variables['social'] = _block_get_renderable_array(_block_render_blocks(array(
      block_load('block', '11'),
    )));

    $variables['content']['social_block'] = array(
      '#markup' => drupal_render($variables['social']),
      '#weight' => -100,
    );
  }
}

/**
 * Implement hook_preprocess_html().
 */
function rznasa_preprocess_html(&$variables)
{

  $current_page = menu_get_item();

  if (isset($current_page['page_arguments'][0]) && isset($current_page['page_arguments'][0]->type) && $current_page['page_arguments'][0]->type == 'verse') {
    $style_name = 'social_480x250_';
    $uri = $current_page['page_arguments'][0]->field_verse_img['und'][0]['uri'];

    $image_path = image_style_url($style_name, $uri);

    if (isset($current_page['page_arguments'][0]->field_boby['und'][0]['value'])) {
      $no_html_body = strip_tags($current_page['page_arguments'][0]->field_boby['und'][0]['value']);
      $ready_body = mb_strimwidth($no_html_body, 0, 140, "...");
      $variables['og_body'] = $ready_body;
      $variables['image_path'] = $image_path;

    }
    $variables['image_path'] = $image_path;
  }

}
