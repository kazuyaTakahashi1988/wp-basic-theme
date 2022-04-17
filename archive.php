<?php
$cate = get_the_category()[0]; // カテゴリー
$args = [
    'pageTtl' => $cate->name . 'のタイトル' . '｜' . SITE_NAME, // タイトル
    'pageDes' => $cate->name . 'のディスクリプション', // ディスクリプション
    'pageKey' => $cate->name . 'のキーワード', // キーワード
    // 'ogpImg' => '', // OGP画像
    // 'pageCss' => 'xxxx.css', // cssファイル
    // 'pageJs' => 'xxxx.min.js', // jsファイル
    // 'queryParam' => $_GET['query'], // クエリーパラメーター
];
get_header(null, $args);
?>

<div class="contswrap">
    <p>cate：<?php echo $cate->name; ?>一覧</p><br>
    <?php
    /* --------------------------
        記事一覧 ▽ start ▽
    ----------------------------------- */
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
            <a href="<?php the_permalink(); ?>">
                <h3><?php the_title(); ?></h3>
                <?php echo wp_trim_words(get_the_content(), 135, ''); ?>
            </a><br>
    <?php endwhile;
    endif; ?>
    <?php /* wp_pagenavi(); ←プラグイン[WP-PageNavi]必要 */ 
    /* --------------------------
        記事一覧 ▲ end ▲ 
    ----------------------------------- */ ?>
</div>

<?php get_footer(null, $args); ?>