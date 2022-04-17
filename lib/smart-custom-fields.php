<?php
/*━━━━━━━━━━━━━━━
Smart Custom Fields フィールド定義
━━━━━━━━━━━━━━━*/
function scf_meta_box($settings, $post_type, $post_id)
{
    $slug = get_post($post_id)->post_name;	//スラッグ取得
    /*  ↓ 記述例 ↓ 
        if (in_array($post_type, array('post') && $slug === 'hoge')) {
            $Setting = SCF::add_setting('shop', 'カスタムフィールド');
            $Setting->add_group('shop', false, array(
                array('type'      => 'text', //テキスト
                    'name'        => 'shop',
                    'instruction' => '店舗名', //説明文
                    'notes'       => '', //注釈
                    'label'       => '', //nameの代替文字
                    'default'     => '',	//初期値
                ),
            ));
            $settings[] = $Setting;
        }
    */
    if (in_array($post_type, array('custompost') )) {  //メタボックスを追加する投稿タイプやスラッグの条件
        $Setting = SCF::add_setting('ct-field-01', 'メインコンテンツ');
        $Setting->add_group('ct-field-01', false, array(
            array('type'      => 'wysiwyg', // タイプ
                'name'        => 'contents', // 名前
                'instruction' => 'wysiwygによるテキスト編集', // 説明文
                'notes'       => '', // 注記
                'label'       => '', // ラベル
                'default'     => '', // 初期値
            ),
        ));
        $settings[] = $Setting;
    }
    if (in_array($post_type, array('custompost') )) {  //メタボックスを追加する投稿タイプやスラッグの条件
        $Setting = SCF::add_setting('slides', 'スライド画像（ループ登録）');
        $Setting->add_group('slides', true /* ←trueでループ */, array( 
            array('type'      => 'image',
                'name'        => 'slide_img',
                'instruction' => 'スライド画像',
                'notes'       => '',
                'label'       => '',
                'size'        => 'full' // プレビューサイズ
            ),
            array('type'      => 'text',
                'name'        => 'slide_ttl',
                'instruction' => 'スライド画像のタイトル',
                'notes'       => '',
                'label'       => '',
                'default'     => '',
            ),
            array('type'        => 'text',
                'name'        => 'slide_caption',
                'instruction' => 'スライド画像のキャプション',
                'notes'       => '',
                'label'       => '',
                'default'     => '',
            )
        ));
        $settings[] = $Setting;
    }
    if (in_array($post_type, array('custompost'))) {  //メタボックスを追加する投稿タイプやスラッグの条件
        $Setting = SCF::add_setting('comps', '企業情報');
        $Setting->add_group('comps', false, array(
            array('type'      => 'text',
                'name'        => 'company',
                'instruction' => '会社名',
                'notes'       => '', 
                'label'       => '',
                'default'     => '株式会社○◻️▲',
            ),
            array('type'      => 'text',
                'name'        => 'addres',
                'instruction' => '所在地',
                'notes'       => '', 
                'label'       => '',
                'default'     => '○◻️▲県○◻️▲市○◻️▲町',
            )
        ));
        $settings[] = $Setting;
    }
    return $settings;
}
add_filter('smart-cf-register-fields', 'scf_meta_box', 10, 3);


/*
######  ## #######       ####### ######  ## ########  ######  ######
##   ## ## ##            ##      ##   ## ##    ##    ##    ## ##   ##
##   ## ## ####### ##### #####   ##   ## ##    ##    ##    ## ######
##   ## ##      ##       ##      ##   ## ##    ##    ##    ## ##   ##
######  ## #######       ####### ######  ##    ##     ######  ##   ##
*/

add_action('admin_enqueue_scripts', 'CSF_RemovePageEditor');	//指定固定ページの本文エディタ削除
function CSF_RemovePageEditor()
{
    $slug = get_post(get_the_ID())->post_name;
    if (strpos($slug, 'parts-') !== false) {	//本文エディタを削除するページ
        remove_post_type_support('page', 'editor');
    }
}

/*

    ###    ########  ########                ##  ######
   ## ##   ##     ## ##     ##               ## ##    ##
  ##   ##  ##     ## ##     ##               ## ##
 ##     ## ##     ## ##     ## #######       ##  ######
 ######### ##     ## ##     ##         ##    ##       ##
 ##     ## ##     ## ##     ##         ##    ## ##    ##
 ##     ## ########  ########           ######   ######

*/
// add_action('admin_footer','SCF_JSPlus');	//入力改善用のJS追記　コメントアウトを外して有効化
function SCF_JSPlus()
{
    echo <<< EOF
    <script type="text/javascript">
    jQuery(function($){
        $('[name="smart-custom-fields[hogehoge][0]"]').attr('type','number') // 指定フィールドをナンバー型に変換
    })
    </script>
EOF;
}

/*
  ######  ########    ###    ########   ######  ##     ##
 ##    ## ##         ## ##   ##     ## ##    ## ##     ##
 ##       ##        ##   ##  ##     ## ##       ##     ##
  ######  ######   ##     ## ########  ##       #########
       ## ##       ######### ##   ##   ##       ##     ##
 ##    ## ##       ##     ## ##    ##  ##    ## ##     ##
  ######  ######## ##     ## ##     ##  ######  ##     ##
*/

// カスタムフィールドをテキスト検索の対象に加える
add_filter('posts_search', 'custom_search', 10, 2);
function custom_search($search, $wp_query)
{
    global $wpdb;
    if (!$wp_query->is_search) {
        return $search;
    }
    if (!isset($wp_query->query_vars)) {
        return $search;
    }

    $search_words = explode(' ', isset($wp_query->query_vars['s']) ? $wp_query->query_vars['s'] : '');
    if (count($search_words) > 0) {
        $search = '';
        $search .= "AND post_type = 'post'";
        foreach ($search_words as $word) {
            if (!empty($word)) {
                $search_word = '%' . esc_sql($word) . '%';
                $search .= " AND (
                                {$wpdb->posts}.post_title LIKE '{$search_word}'
                                OR {$wpdb->posts}.post_content LIKE '{$search_word}'
                                OR {$wpdb->posts}.ID IN (
                                SELECT distinct post_id
                                FROM {$wpdb->postmeta}
                                WHERE meta_value LIKE '{$search_word}'
                                )
                            ) ";
            }
        }
    }
    return $search;
}


/*
####### ########  #####  ######## ##  ######
##         ##    ##   ##    ##    ## ##
#######    ##    #######    ##    ## ##
     ##    ##    ##   ##    ##    ## ##
#######    ##    ##   ##    ##    ##  ######
*/
/*━━━━━━━━━━━━━━━━━━━━━
基本編集不要エリア
━━━━━━━━━━━━━━━━━━━━━*/

/*
 ###### ####### #######
##      ##      ##
##      ####### #######
##           ##      ##
 ###### ####### #######
*/
add_action('admin_enqueue_scripts', 'SCF_CSSPlus');	//入力改善用のCSS/JS追記
function SCF_CSSPlus()
{
    echo '
    <style>
    .smart-cf-meta-box-table tr th{
        width: 5rem;
    }
    .mce-edit-area iframe{
    }
    .smart-cf-meta-box .smart-cf-upload-image img, .smart-cf-meta-box .smart-cf-upload-file img{
        max-width:30%;
    }
    .smart-cf-meta-box .smart-cf-meta-box-table .smart-cf-relation-right
    ,.smart-cf-meta-box .smart-cf-meta-box-table .smart-cf-relation-left {
        width:auto;
        max-height:150px;
    }
    .smart-cf-meta-box .smart-cf-meta-box-table .smart-cf-relation-left .smart-cf-relation-children-select{
        height:260px;
    }

    .smart-cf-meta-box-repeat-tables{
        counter-reset:count-number;
    }
    .smart-cf-meta-box-repeat-tables .smart-cf-meta-box-table:before {
      counter-increment: count-number;
      content: counters(count-number,".") " ";
      display: inline-block;
    }
    </style>
    ';
}
