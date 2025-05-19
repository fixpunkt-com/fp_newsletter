<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log',
        'label' => 'email',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
        'searchFields' => 'gender,title,firstname,lastname,email,status,securityhash',
        'iconfile' => 'EXT:fp_newsletter/Resources/Public/Icons/tx_fpnewsletter_domain_model_log.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, gender, title, firstname, lastname, email, address, zip, city, region, country, phone, mobile, fax, www, birthday, position, company, categories, status, securityhash, retoken, mathcaptcha, gdpr, nl_table, nl_extension, cg_table, ex_uid'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => ['type' => 'language'],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_fpnewsletter_domain_model_log',
                'foreign_table_where' => 'AND {#tx_fpnewsletter_domain_model_log}.{#pid}=###CURRENT_PID### AND {#tx_fpnewsletter_domain_model_log}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'tstamp' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.tstamp',
            'config' => [
                'type' => 'datetime',
                'size' => 13,
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'gender' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.gender',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => '--', 'value' => 0],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.gender.mrs', 'value' => 1],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.gender.mr', 'value' => 2],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.gender.divers', 'value' => 3],
                ],
                'default' => 0,
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'firstname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.firstname',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'lastname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.lastname',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true
            ],
        ],
        'address' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.address',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'zip' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.zip',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'city' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.city',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'region' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.region',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'country' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.country',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'phone' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.phone',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'mobile' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.mobile',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'fax' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.fax',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'www' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.www',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'position' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.position',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'company' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.company',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'categories' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.categories',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.status.0', 'value' => 0],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.status.1', 'value' => 1],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.status.2', 'value' => 2],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.status.3', 'value' => 3],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.status.4', 'value' => 4],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.status.6', 'value' => 6],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.status.7', 'value' => 7],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.status.8', 'value' => 8],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.status.10', 'value' => 10],
                    ['label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.status.11', 'value' => 11]
                ],
                'default' => 0,
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
        'securityhash' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.securityhash',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'retoken' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.retoken',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'eval' => 'trim'
            ]
        ],
        'mathcaptcha' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.mathcaptcha',
            'config' => [
                'type' => 'input',
                'size' => 5,
                'eval' => 'trim'
            ],
        ],
        'gdpr' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.gdpr',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => false,
                    ],
                ],
            ],
        ],
        'nl_extension' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.nl_extension',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'nl_table' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.nl_table',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'cg_table' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.cg_table',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'ex_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:fp_newsletter/Resources/Private/Language/locallang_db.xlf:tx_fpnewsletter_domain_model_log.ex_uid',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim'
            ],
        ],
    ],
];
