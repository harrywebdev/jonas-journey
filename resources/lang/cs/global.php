<?php

return [
    'title' => 'Jonášova cesta',

    'actions' => [
        'logout'  => 'Odhlásit',
        'save'    => 'Uložit',
        'discard' => 'Zahodit',
        'cancel'  => 'Zrušit',
        'delete'  => 'Smazat',
    ],

    'login' => [
        'title'   => 'Přihlášení',
        'fields'  => [
            'password' => 'Heslo',
        ],
        'actions' => [
            'login' => 'Přihlásit',
        ],
    ],

    'posts' => [
        'day'                 => 'den',
        'is_empty'            => 'Nejsou tu zatím žádné zápisky.',
        'go_to_next_post'     => '→',
        'go_to_previous_post' => '←',
        'go_to_index'         => 'Rejstřík',
        'add_new'             => 'Přidat zápisek',
        'edit'                => 'Upravit zápisek',
        'form'                => [
            'date_format'  => 'RRRR-MM-DD',
            'published_on' => 'Datum publikace',
            'content'      => 'Obsah',
            'status'       => 'Stav',
        ],
        'status'              => [
            'published' => 'Publikováno',
            'draft'     => 'Koncept',
        ],
    ],

    'errors' => [
        'page_not_found' => 'Ouvej, tahle stránka tu není.',
        'unauthorized'   => 'Ouvej, tahle stránka tu není.',
        'continue_home'  => 'Pokračovat domů →',
    ],
];
