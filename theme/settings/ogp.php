<?php

/**
 * OGP / Twitter Card 用の description を整形する。
 */
if (!function_exists('ts_ogp_clean_description')) {
  function ts_ogp_clean_description($text, $limit = 160)
  {
    $charset = get_bloginfo('charset') ?: 'UTF-8';
    $text = html_entity_decode((string) $text, ENT_QUOTES, $charset);
    $text = wp_strip_all_tags(strip_shortcodes($text));
    $text = preg_replace('/\s+/u', ' ', $text);
    $text = trim((string) $text);

    if ($text === '') {
      return '';
    }

    if (function_exists('mb_strimwidth')) {
      return mb_strimwidth($text, 0, $limit, '...', 'UTF-8');
    }

    return wp_trim_words($text, $limit, '...');
  }
}

/**
 * OGP / Twitter Card を一か所から出力する。
 * SEOプラグイン利用時はプラグイン側の出力を優先する。
 */
function output_ogp()
{
  global $wp;

  $has_seo_plugin = function_exists('ts_is_major_seo_plugin_active')
    ? ts_is_major_seo_plugin_active()
    : (
      defined('WPSEO_VERSION') ||
      defined('RANK_MATH_VERSION') ||
      defined('AIOSEO_VERSION') ||
      defined('SEOPRESS_VERSION') ||
      defined('SLIM_SEO_VERSION') ||
      class_exists('The_SEO_Framework\\Load') ||
      function_exists('rank_math')
    );

  if (is_admin() || $has_seo_plugin) {
    return;
  }

  $og_site_name = get_bloginfo('name');
  $og_title     = is_front_page() ? $og_site_name : wp_get_document_title();
  $og_type      = is_singular('post') ? 'article' : 'website';
  $og_url       = home_url('/');
  $og_image     = get_theme_file_uri('/img/ogp.png');

  if (function_exists('ts_get_fallback_canonical_url')) {
    $canonical_url = ts_get_fallback_canonical_url();
    if ($canonical_url !== '') {
      $og_url = $canonical_url;
    }
  } elseif (is_singular()) {
    $og_url = get_permalink();
  } elseif (!empty($wp->request)) {
    $og_url = home_url('/' . ltrim($wp->request, '/'));
  }

  $og_description = isset($GLOBALS['ts_meta_description_override'])
    ? (string) $GLOBALS['ts_meta_description_override']
    : '';

  if ('' === trim($og_description) && function_exists('ts_get_fallback_meta_description')) {
    $og_description = ts_get_fallback_meta_description();
  }

  if ('' === trim($og_description) && is_singular()) {
    $post_id = get_queried_object_id();
    $og_description = get_post_field('post_excerpt', $post_id);

    if ('' === trim((string) $og_description)) {
      $og_description = get_post_field('post_content', $post_id);
    }
  }

  if ('' === trim((string) $og_description)) {
    $og_description = get_bloginfo('description');
  }

  if (is_singular() && has_post_thumbnail()) {
    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    if (!empty($thumbnail[0])) {
      $og_image = $thumbnail[0];
    }
  }

  $og_description = ts_ogp_clean_description($og_description, 160);
  ?>
  <meta property="og:locale" content="ja_JP">
  <meta property="og:title" content="<?php echo esc_attr($og_title); ?>">
  <meta property="og:type" content="<?php echo esc_attr($og_type); ?>">
  <meta property="og:url" content="<?php echo esc_url($og_url); ?>">
  <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
  <?php if ($og_description !== '') : ?>
    <meta property="og:description" content="<?php echo esc_attr($og_description); ?>">
  <?php endif; ?>
  <meta property="og:site_name" content="<?php echo esc_attr($og_site_name); ?>">

  <meta name="twitter:card" content="<?php echo $og_image ? 'summary_large_image' : 'summary'; ?>">
  <meta name="twitter:title" content="<?php echo esc_attr($og_title); ?>">
  <?php if ($og_description !== '') : ?>
    <meta name="twitter:description" content="<?php echo esc_attr($og_description); ?>">
  <?php endif; ?>
  <?php if ($og_image) : ?>
    <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
  <?php endif; ?>
  <?php
}

// <head> 要素に追加
add_action('wp_head', 'output_ogp');