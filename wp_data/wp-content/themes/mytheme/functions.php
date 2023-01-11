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
            'revisions' // リビジョンの保存
          ),
        )
    );
}
add_action('init', 'create_post_type');

/* ---------- カスタムタクソノミー（カテゴリー）の追加 ---------- */
function custom_taxonomy_cat()
{
    register_taxonomy( // カスタムタクソノミーの追加関数
        'naming', // カテゴリーの名前（半角英数字の小文字）
        'FY2023',     // タグを追加したいカスタム投稿タイプ
        array(      // オプション（以下
          'label' => 'ネーム', // 表示名称
          'public' => true, // 管理画面に表示するかどうかの指定
          'hierarchical' => true, // 階層を持たせるかどうか
          'show_in_rest' => true, // REST APIの有効化。ブロックエディタの有効化。
        )
    );
    register_taxonomy( // カスタムタクソノミーの追加関数
        'completed_manuscript', // カテゴリーの名前（半角英数字の小文字）
        'FY2023',     // タグを追加したいカスタム投稿タイプ
        array(      // オプション（以下
          'label' => '本稿', // 表示名称
          'public' => true, // 管理画面に表示するかどうかの指定
          'hierarchical' => true, // 階層を持たせるかどうか
          'show_in_rest' => true, // REST APIの有効化。ブロックエディタの有効化。
        )
    );
}
add_action('init', 'custom_taxonomy_cat');
