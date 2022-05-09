<?php
// global $wp_rewrite;
// $wp_rewrite->flush_rules();

// 自動補完無効化
function disable_redirect_canonical( $redirect_url ) {
  if( is_404() ) {
    return false;
  }
  return $redirect_url;
}
// add_filter( 'redirect_canonical', 'disable_redirect_canonical' );

// カスタム投稿のURLをIDに変更
function my_post_type_link( $link, $post ){
  if ( 'custompost' === $post->post_type ) {
    return home_url( '/custompost/' . $post->ID . '.html');
  } else  {
    return $link;
  }
}
add_filter( 'post_type_link', 'my_post_type_link', 1, 2 );

// リライト設定
function urlRewrite(){
  add_rewrite_rule('custompost/([0-9]+).html?$', 'index.php?post_type=custompost&p=$matches[1]', 'top');
  add_rewrite_rule('custompost/([^/]+)?$', 'index.php?cat_industry=$matches[1]', 'top');
  add_rewrite_rule('custompost/([^/]+)/page/([0-9]+)/?$', 'index.php?cat_industry=$matches[1]&paged=$matches[2]', 'top');
}
add_action( 'init', 'urlRewrite' );

?>
