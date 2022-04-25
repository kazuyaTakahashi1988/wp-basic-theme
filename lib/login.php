<?php /*
セキュリティ向上の為ログインURLを変更する
WPのルート階層に以下のPHPファイルを作っておく

↓↓↓ system-login.php ↓↓↓

<?php
define('LOGIN_CHANGE', sha1('WordPressLoginFormChange'));
require_once './wp-login.php'; ?>

↑↑↑ system-login.php ↑↑↑
*/ ?>


<?php /*
  define( 'LOGIN_CHANGE_PAGE', 'system-login.php' );

  add_action( 'login_init', 'login_change_init' );
  add_filter( 'site_url', 'login_change_site_url', 10, 4 );
  add_filter( 'wp_redirect', 'login_change_wp_redirect', 10, 2 );
  // 指定以外のログインURLは403エラーにする
  if ( ! function_exists( 'login_change_init' ) ) {
      function login_change_init() {
          if ( !defined( 'LOGIN_CHANGE' ) || sha1('WordPressLoginFormChange') !== LOGIN_CHANGE ) {
              status_header(403);
              exit;
          }
      }
  }
  // ログイン済みか新設のログインURLの場合はwp-login.phpを置き換える
  if ( ! function_exists( 'login_change_site_url' ) ) {
      function login_change_site_url( $url, $path, $orig_scheme, $blog_id ) {
          if ( $path == 'wp-login.php' && ( is_user_logged_in() || strpos( $_SERVER['REQUEST_URI'], LOGIN_CHANGE_PAGE ) !== false ) )
              $url = str_replace( 'wp-login.php', LOGIN_CHANGE_PAGE, $url );
          return $url;
      }
  }

  // 管理画面ログアウトリンクのURL設定
  function my_admin_script() {
    echo '<script>
  window.addEventListener("load", function(){
  var tr_logout = document.getElementById("wp-admin-bar-logout").children[0];
  var getAttrs = tr_logout.getAttribute("href").replace("wp-login.php","system-login.php");
  tr_logout.setAttribute("href",getAttrs);

  }, false);
    </script>'.PHP_EOL;
  }
  add_action('admin_print_scripts', 'my_admin_script');

  // ログアウト時のリダイレクト先の設定
  if ( ! function_exists( 'login_change_wp_redirect' ) ) {
      function login_change_wp_redirect( $location, $status ) {
          if ( strpos( $_SERVER['REQUEST_URI'], LOGIN_CHANGE_PAGE ) !== false )
              $location = str_replace( 'wp-login.php', LOGIN_CHANGE_PAGE, $location );
          return $location;
      }
  }

*/ ?>



<php function custom_login() { ?>
<style>
.login {
    background: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDQwIiBoZWlnaHQ9IjkwMCI+PHBhdGggZD0iTTYzNiwyMThMNzMwLC0xMzNMNDYxLC0yNDVaIiBmaWxsPSIjZjBmMGYwIiBzdHJva2U9IiNmMGYwZjAiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik00NjEsLTI0NUwxMTksLTEyTDYzNiwyMThaIiBmaWxsPSIjZjVmNWY1IiBzdHJva2U9IiNmNWY1ZjUiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0zNjQsLTI3NkwxMTksLTEyTDQ2MSwtMjQ1WiIgZmlsbD0iI2Y3ZjdmNyIgc3Ryb2tlPSIjZjdmN2Y3IiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNNzMwLC0xMzNMODM1LC0zMTdMNDYxLC0yNDVaIiBmaWxsPSIjZWVlZWVlIiBzdHJva2U9IiNlZWVlZWUiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik00NjEsLTI0NUwxOTAsLTYyMEwzNjQsLTI3NloiIGZpbGw9IiNmNmY2ZjYiIHN0cm9rZT0iI2Y2ZjZmNiIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTEyMjksLTgwTDgzNSwtMzE3TDczMCwtMTMzWiIgZmlsbD0iI2U4ZThlOCIgc3Ryb2tlPSIjZThlOGU4IiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMTE5LC0xMkw2NywyNTRMNjM2LDIxOFoiIGZpbGw9IiNmMmYyZjIiIHN0cm9rZT0iI2YyZjJmMiIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTYzNiwyMThMMTA3MSwyNzBMNzMwLC0xMzNaIiBmaWxsPSIjZTZlNmU2IiBzdHJva2U9IiNlNmU2ZTYiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xMDIzLDc3OEwxMDcxLDI3MEw2MzYsMjE4WiIgZmlsbD0iI2Q4ZDhkOCIgc3Ryb2tlPSIjZDhkOGQ4IiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMzY0LC0yNzZMLTQsLTU2NEwxMTksLTEyWiIgZmlsbD0iI2ZiZmJmYiIgc3Ryb2tlPSIjZmJmYmZiIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMTE5LC0xMkwtMjQxLC00Nkw2NywyNTRaIiBmaWxsPSIjZmNmY2ZjIiBzdHJva2U9IiNmY2ZjZmMiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik04MzUsLTMxN0wxOTAsLTYyMEw0NjEsLTI0NVoiIGZpbGw9IiNmMmYyZjIiIHN0cm9rZT0iI2YyZjJmMiIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTY3LDI1NEw1Nyw1NDVMNjM2LDIxOFoiIGZpbGw9IiNlYmViZWIiIHN0cm9rZT0iI2ViZWJlYiIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTEwNzEsMjcwTDEyMjksLTgwTDczMCwtMTMzWiIgZmlsbD0iI2U1ZTVlNSIgc3Ryb2tlPSIjZTVlNWU1IiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNLTQsLTU2NEwtMjQxLC00NkwxMTksLTEyWiIgZmlsbD0iI2ZmZmZmZiIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNNjcsMjU0TC03Miw1MDdMNTcsNTQ1WiIgZmlsbD0iI2VkZWRlZCIgc3Ryb2tlPSIjZWRlZGVkIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNNTcsNTQ1TDU3OCw3NjJMNjM2LDIxOFoiIGZpbGw9IiNlMGUwZTAiIHN0cm9rZT0iI2UwZTBlMCIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTE5MCwtNjIwTC00LC01NjRMMzY0LC0yNzZaIiBmaWxsPSIjZmFmYWZhIiBzdHJva2U9IiNmYWZhZmEiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik01Nyw5MzBMNjQ2LDk5Mkw1NzgsNzYyWiIgZmlsbD0iI2QxZDFkMSIgc3Ryb2tlPSIjZDFkMWQxIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNLTI5NSwzNDNMLTcyLDUwN0w2NywyNTRaIiBmaWxsPSIjZjBmMGYwIiBzdHJva2U9IiNmMGYwZjAiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xMDcxLDI3MEwxMzYzLDMzMUwxMjI5LC04MFoiIGZpbGw9IiNkYWRhZGEiIHN0cm9rZT0iI2RhZGFkYSIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTEwMjMsNzc4TDEyMjIsNTI3TDEwNzEsMjcwWiIgZmlsbD0iI2NmY2ZjZiIgc3Ryb2tlPSIjY2ZjZmNmIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNLTI0MSwtNDZMLTI5NSwzNDNMNjcsMjU0WiIgZmlsbD0iI2Y3ZjdmNyIgc3Ryb2tlPSIjZjdmN2Y3IiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNODM1LC0zMTdMMTE0NywtNjI2TDE5MCwtNjIwWiIgZmlsbD0iI2VkZWRlZCIgc3Ryb2tlPSIjZWRlZGVkIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMTIyOSwtODBMMTE0NywtNjI2TDgzNSwtMzE3WiIgZmlsbD0iI2U1ZTVlNSIgc3Ryb2tlPSIjZTVlNWU1IiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMTIyOSwtODBMMTQ0MywtNDE0TDExNDcsLTYyNloiIGZpbGw9IiNlMGUwZTAiIHN0cm9rZT0iI2UwZTBlMCIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTEyMjIsNTI3TDEzNjMsMzMxTDEwNzEsMjcwWiIgZmlsbD0iI2QyZDJkMiIgc3Ryb2tlPSIjZDJkMmQyIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNNTc4LDc2MkwxMDIzLDc3OEw2MzYsMjE4WiIgZmlsbD0iI2Q1ZDVkNSIgc3Ryb2tlPSIjZDVkNWQ1IiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNLTI0MSwtNDZMLTcxOSwzMjNMLTI5NSwzNDNaIiBmaWxsPSIjZjdmN2Y3IiBzdHJva2U9IiNmN2Y3ZjciIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0tNCwtNTY0TC00MTAsLTIyNUwtMjQxLC00NloiIGZpbGw9IiNmZmZmZmYiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTU3OCw3NjJMNjQ2LDk5MkwxMDIzLDc3OFoiIGZpbGw9IiNjYmNiY2IiIHN0cm9rZT0iI2NiY2JjYiIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTU3LDkzMEw1NzgsNzYyTDU3LDU0NVoiIGZpbGw9IiNkY2RjZGMiIHN0cm9rZT0iI2RjZGNkYyIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTE3MzMsLTI1N0wxNDQzLC00MTRMMTIyOSwtODBaIiBmaWxsPSIjZGJkYmRiIiBzdHJva2U9IiNkYmRiZGIiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0tMzgyLDc5Mkw1Nyw5MzBMLTcyLDUwN1oiIGZpbGw9IiNlMmUyZTIiIHN0cm9rZT0iI2UyZTJlMiIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTS03Miw1MDdMNTcsOTMwTDU3LDU0NVoiIGZpbGw9IiNlNGU0ZTQiIHN0cm9rZT0iI2U0ZTRlNCIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTS00LC01NjRMLTUzOCwtMzg3TC00MTAsLTIyNVoiIGZpbGw9IiNmZmZmZmYiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTS00MTAsLTIyNUwtNzE5LDMyM0wtMjQxLC00NloiIGZpbGw9IiNmZWZlZmUiIHN0cm9rZT0iI2ZlZmVmZSIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTEzMTQsODQyTDE0ODIsNjIyTDEyMjIsNTI3WiIgZmlsbD0iI2M0YzRjNCIgc3Ryb2tlPSIjYzRjNGM0IiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMTIyMiw1MjdMMTQ4Miw2MjJMMTM2MywzMzFaIiBmaWxsPSIjY2FjYWNhIiBzdHJva2U9IiNjYWNhY2EiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik02NDYsOTkyTDEwNzUsOTk0TDEwMjMsNzc4WiIgZmlsbD0iI2M1YzVjNSIgc3Ryb2tlPSIjYzVjNWM1IiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMTMxNCw4NDJMMTIyMiw1MjdMMTAyMyw3NzhaIiBmaWxsPSIjYzZjNmM2IiBzdHJva2U9IiNjNmM2YzYiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xMzYzLDMzMUwxNjk1LDMyOEwxMjI5LC04MFoiIGZpbGw9IiNkNWQ1ZDUiIHN0cm9rZT0iI2Q1ZDVkNSIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTEwNzUsOTk0TDEzMTQsODQyTDEwMjMsNzc4WiIgZmlsbD0iI2MxYzFjMSIgc3Ryb2tlPSIjYzFjMWMxIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNLTI5NSwzNDNMLTM4Miw3OTJMLTcyLDUwN1oiIGZpbGw9IiNlOWU5ZTkiIHN0cm9rZT0iI2U5ZTllOSIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTS03MTksMzIzTC0zODIsNzkyTC0yOTUsMzQzWiIgZmlsbD0iI2VjZWNlYyIgc3Ryb2tlPSIjZWNlY2VjIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMTQ4Miw2MjJMMTY5NSwzMjhMMTM2MywzMzFaIiBmaWxsPSIjY2JjYmNiIiBzdHJva2U9IiNjYmNiY2IiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xNjk1LDMyOEwxNzMzLC0yNTdMMTIyOSwtODBaIiBmaWxsPSIjZGJkYmRiIiBzdHJva2U9IiNkYmRiZGIiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xNDQzLC00MTRMMjAzOCwtMjg5TDExNDcsLTYyNloiIGZpbGw9IiNkYmRiZGIiIHN0cm9rZT0iI2RiZGJkYiIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTS01MzgsLTM4N0wtNzE5LDMyM0wtNDEwLC0yMjVaIiBmaWxsPSIjZmZmZmZmIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik02NDYsOTkyTDEwMDksMTI4M0wxMDc1LDk5NFoiIGZpbGw9IiNjNWM1YzUiIHN0cm9rZT0iI2M1YzVjNSIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTI3OCwxMzI5TDYxOCwxMjc4TDY0Niw5OTJaIiBmaWxsPSIjY2ZjZmNmIiBzdHJva2U9IiNjZmNmY2YiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0yNzgsMTMyOUw2NDYsOTkyTDU3LDkzMFoiIGZpbGw9IiNkNGQ0ZDQiIHN0cm9rZT0iI2Q0ZDRkNCIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTS0zMDgsMTExMkwtMjAsMTE3NEw1Nyw5MzBaIiBmaWxsPSIjZGJkYmRiIiBzdHJva2U9IiNkYmRiZGIiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0tMjAsMTE3NEwyNzgsMTMyOUw1Nyw5MzBaIiBmaWxsPSIjZDlkOWQ5IiBzdHJva2U9IiNkOWQ5ZDkiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0tMzgyLDc5MkwtMzA4LDExMTJMNTcsOTMwWiIgZmlsbD0iI2RiZGJkYiIgc3Ryb2tlPSIjZGJkYmRiIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNLTcxOSwzMjNMLTUzNyw4NjNMLTM4Miw3OTJaIiBmaWxsPSIjZTVlNWU1IiBzdHJva2U9IiNlNWU1ZTUiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0yMTIwLDY0MEwyMDg1LDM1MUwxNjk1LDMyOFoiIGZpbGw9IiNjYWNhY2EiIHN0cm9rZT0iI2NhY2FjYSIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTEzMTQsODQyTDE1NDYsOTg0TDE0ODIsNjIyWiIgZmlsbD0iI2JjYmNiYyIgc3Ryb2tlPSIjYmNiY2JjIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMTA3NSw5OTRMMTU0Niw5ODRMMTMxNCw4NDJaIiBmaWxsPSIjYmNiY2JjIiBzdHJva2U9IiNiY2JjYmMiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik02MTgsMTI3OEwxMDA5LDEyODNMNjQ2LDk5MloiIGZpbGw9IiNjOWM5YzkiIHN0cm9rZT0iI2M5YzljOSIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTEyNzcsMTQ0NkwxMDA5LDEyODNMNjE4LDEyNzhaIiBmaWxsPSIjYzRjNGM0IiBzdHJva2U9IiNjNGM0YzQiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0tNTM3LDg2M0wtMzA4LDExMTJMLTM4Miw3OTJaIiBmaWxsPSIjZGJkYmRiIiBzdHJva2U9IiNkYmRiZGIiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0tMjAsMTE3NEwtNDQ1LDEyNTdMMjc4LDEzMjlaIiBmaWxsPSIjZGJkYmRiIiBzdHJva2U9IiNkYmRiZGIiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xNDgyLDEzNzdMMTU0Niw5ODRMMTA3NSw5OTRaIiBmaWxsPSIjYmFiYWJhIiBzdHJva2U9IiNiYWJhYmEiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xNjk1LDMyOEwxOTg5LC01NEwxNzMzLC0yNTdaIiBmaWxsPSIjZGJkYmRiIiBzdHJva2U9IiNkYmRiZGIiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0yMDg1LDM1MUwxOTg5LC01NEwxNjk1LDMyOFoiIGZpbGw9IiNkM2QzZDMiIHN0cm9rZT0iI2QzZDNkMyIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTE5ODksLTU0TDIwMzgsLTI4OUwxNzMzLC0yNTdaIiBmaWxsPSIjZGJkYmRiIiBzdHJva2U9IiNkYmRiZGIiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xNzMzLC0yNTdMMjAzOCwtMjg5TDE0NDMsLTQxNFoiIGZpbGw9IiNkYmRiZGIiIHN0cm9rZT0iI2RiZGJkYiIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTS01MzcsODYzTC00NDUsMTI1N0wtMzA4LDExMTJaIiBmaWxsPSIjZGJkYmRiIiBzdHJva2U9IiNkYmRiZGIiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0tMzA4LDExMTJMLTQ0NSwxMjU3TC0yMCwxMTc0WiIgZmlsbD0iI2RiZGJkYiIgc3Ryb2tlPSIjZGJkYmRiIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNLTcxOSwzMjNMLTQ0NSwxMjU3TC01MzcsODYzWiIgZmlsbD0iI2RmZGZkZiIgc3Ryb2tlPSIjZGZkZmRmIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMTk4OSwtNTRMMjA4NSwzNTFMMjAzOCwtMjg5WiIgZmlsbD0iI2RiZGJkYiIgc3Ryb2tlPSIjZGJkYmRiIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMjEyMCw2NDBMMTY5NSwzMjhMMTQ4Miw2MjJaIiBmaWxsPSIjYzdjN2M3IiBzdHJva2U9IiNjN2M3YzciIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xOTY0LDEwNDlMMjEyMCw2NDBMMTQ4Miw2MjJaIiBmaWxsPSIjYmViZWJlIiBzdHJva2U9IiNiZWJlYmUiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xMDA5LDEyODNMMTI3NywxNDQ2TDEwNzUsOTk0WiIgZmlsbD0iI2MwYzBjMCIgc3Ryb2tlPSIjYzBjMGMwIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMjc4LDEzMjlMMTI3NywxNDQ2TDYxOCwxMjc4WiIgZmlsbD0iI2NhY2FjYSIgc3Ryb2tlPSIjY2FjYWNhIiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNLTQ0NSwxMjU3TDEyNzcsMTQ0NkwyNzgsMTMyOVoiIGZpbGw9IiNkM2QzZDMiIHN0cm9rZT0iI2QzZDNkMyIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PHBhdGggZD0iTTEyNzcsMTQ0NkwxNDgyLDEzNzdMMTA3NSw5OTRaIiBmaWxsPSIjYmRiZGJkIiBzdHJva2U9IiNiZGJkYmQiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xOTY0LDEwNDlMMTQ4Miw2MjJMMTU0Niw5ODRaIiBmaWxsPSIjYjliOWI5IiBzdHJva2U9IiNiOWI5YjkiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0yMDg1LDM1MUwyMTIwLDY0MEwyMDM4LC0yODlaIiBmaWxsPSIjZDJkMmQyIiBzdHJva2U9IiNkMmQyZDIiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xNDgyLDEzNzdMMTk2NCwxMDQ5TDE1NDYsOTg0WiIgZmlsbD0iI2I5YjliOSIgc3Ryb2tlPSIjYjliOWI5IiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMTQ4MiwxMzc3TDE4OTAsMTUxOEwxOTY0LDEwNDlaIiBmaWxsPSIjYjliOWI5IiBzdHJva2U9IiNiOWI5YjkiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0xOTY0LDEwNDlMMTg5MCwxNTE4TDIxMjAsNjQwWiIgZmlsbD0iI2I5YjliOSIgc3Ryb2tlPSIjYjliOWI5IiBzdHJva2Utd2lkdGg9IjEuNTEiLz48cGF0aCBkPSJNMTI3NywxNDQ2TDE4OTAsMTUxOEwxNDgyLDEzNzdaIiBmaWxsPSIjYjliOWI5IiBzdHJva2U9IiNiOWI5YjkiIHN0cm9rZS13aWR0aD0iMS41MSIvPjxwYXRoIGQ9Ik0tNDQ1LDEyNTdMMTg5MCwxNTE4TDEyNzcsMTQ0NloiIGZpbGw9IiNjNWM1YzUiIHN0cm9rZT0iI2M1YzVjNSIgc3Ryb2tlLXdpZHRoPSIxLjUxIi8+PC9zdmc+) no-repeat center center;
    background-size: cover;
}
</style>
<?php }
  add_action( 'login_enqueue_scripts', 'custom_login' );
?>


<?php /*
// 新規ユーザー登録時に送信されるメールの内容を変更
function custom_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
  $key = get_password_reset_key( $user );
  if ( is_wp_error( $key ) ) {
  return;
  }
    $subject = '【' . $blogname . '】 新規ユーザー登録';
    $message = 'パスワードを設定するには以下のアドレスへ移動してください。'. "\r\n\r\n";
  $message .= network_site_url( "system-login.php?action=rp&key=$key&login=" . rawurlencode( $user->user_login ), 'login' ) . "\r\n\r\n";
  
  
    $wp_new_user_notification_email['subject'] = $subject;
    $wp_new_user_notification_email['message'] = $message;
    return $wp_new_user_notification_email;
  }
  add_filter( 'wp_new_user_notification_email', 'custom_new_user_notification_email', 10, 3 );
  
// パスワードリセット時に「登録者」へ送信されるメールをカスタマイズ
// 件名を設定
function custom_retrieve_password_title( $title, $user_login, $user_data ) {
  $title = 'パスワードリセットのお知らせ【サイト名】';
  return $title;
 }
 add_filter( 'retrieve_password_title', 'custom_retrieve_password_title', 10, 3 );
  
 // メッセージを設定
 function custom_retrieve_password_message( $message, $key, $user_login, $user_data ) {
  
  // サイト情報を取得
  $blogname = stripslashes( get_option( 'blogname' ) );
  
  // メッセージを編集
  $message = $user_login . ' 様' . "\r\n";
  $message .= "\r\n";
  $message .= 'あなたのアカウントに対して、パスワードのリセットが要求されました。' . "\r\n";
  $message .= "\r\n";
  $message .= 'もしこのリクエストが間違いだった場合は、このメールを無視してください。' . "\r\n";
  $message .= '何も操作をしなければ、これまでのパスワードがそのまま使用できます。' . "\r\n";
  $message .= "\r\n";
  $message .= 'パスワードをリセットする場合は、次のリンクをクリックしてください。' . "\r\n";
  $message .= 'パスワード変更画面にアクセスしますので、新しいパスワードを入力してください。' . "\r\n";
  $message .= "\r\n";
  $message .= network_site_url( "system-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . "\r\n";
  $message .= "\r\n";
  $message .= $blogname;
  
  // メッセージを表示
  return $message;
 }
 add_filter( 'retrieve_password_message', 'custom_retrieve_password_message', 10, 4 );

 function remove_redirect_guess_404_permalink( $redirect_url ) {
  if ( is_404() )
      return false;
  return $redirect_url;
}
add_filter( 'redirect_canonical', 'remove_redirect_guess_404_permalink' );

function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
  // if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
  if($post_type !== "service"){
    if( $post_type == "tech" || "content" || "post" ){
      $postini = substr(utf8_uri_encode( $post_type ), 0, 1) ;
      if($postini == 'p'){ $postini = 'n'; }
      $slug =  $postini. $post_ID;
    }
  }
  // }
  return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );

function login_autocomplete_off() { 
  echo '<script>
  window.addEventListener("load", function(){
    var resetForm = document.getElementById("resetpassform");
    var lostForm = document.getElementById("lostpasswordform");
    var registerForm = document.getElementById("registerForm");

    if(resetForm){
      var setURL = resetForm.getAttribute("action").replace( "wp-login.php", "system-login.php" );
      resetForm.setAttribute("action", setURL);
    }
    if(lostForm){
      var setURL02 = lostForm.getAttribute("action").replace( "wp-login.php", "system-login.php" );
      lostForm.setAttribute("action", setURL02);
    }
    if(registerForm){
      var setURL03 = lostForm.getAttribute("action").replace( "wp-login.php", "system-login.php" );
      registerForm.setAttribute("action", setURL03);
    }
  }, false);
  </script>'.PHP_EOL;
}
add_action( 'login_enqueue_scripts', 'login_autocomplete_off' );
*/ ?>

