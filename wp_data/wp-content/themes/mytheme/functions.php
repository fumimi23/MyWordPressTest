<?php

/* ---------- カスタムブロックの追加 ---------- */
require_once(get_template_directory() . '/myblock/myblock.php');

/* ---------- サムネイル画像の追加 ---------- */
add_theme_support('post-thumbnails');

/* ---------- カスタム投稿の追加 ---------- */
function create_post_type()
{
    register_post_type( // カスタム投稿タイプの追加関数
        'FY2023', //カスタム投稿タイプ名（半角英数字の小文字）
        array( //オプション（以下）
          'label' => '2023年度', // 管理画面上の表示（日本語でもOK）
          'public' => true, // 管理画面に表示するかどうかの指定
          'has_archive' => true, // 投稿した記事の一覧ページを作成する
          'menu_position' => 5, // 管理画面メニューの表示位置（投稿の下に追加）
          'show_in_rest' => true, // Gutenbergの有効化
          'supports' => array( // サポートする機能（以下）
            'title',  // タイトル
            'editor', // エディター
            'thumbnail', // アイキャッチ画像
            'excerpt',  // 抜粋
            'custom-fields', // カスタムフィールド
            'revisions' // リビジョンの保存
          ),
          'taxonomies' => array('category'), // 使用するタクソノミー
        )
    );
}
add_action('init', 'create_post_type');

/* ---------- ブロックテーマサポートの追加 ---------- */
if (! function_exists('mytheme_setup')) {
    function mytheme_setup()
    {
        add_theme_support('wp-block-styles');
    }
}
add_action('after_setup_theme', 'mytheme_setup');

function get_all_posts($query)
{
    if ($query->is_main_query()) {
        $query->set('post_type', 'any');
    }
}
add_action('pre_get_posts', 'get_all_posts');
