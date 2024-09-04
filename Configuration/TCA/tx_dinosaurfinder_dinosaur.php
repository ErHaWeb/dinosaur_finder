<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'name,slug',
        'typeicon_classes' => [
            'default' => 'dinosaur',
        ],
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;;dinosaurData,slug,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    hidden,starttime,endtime
            ',
        ],
    ],
    'palettes' => [
        'dinosaurData' => ['showitem' => 'name,diet,--linebreak--,size,weight,--linebreak--,era,region,--linebreak--,discovery_year,discoverer,--linebreak--,group,--linebreak--,image'],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'slug' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:pages.slug',
            'config' => [
                'type' => 'slug',
                'readOnly' => true,
                'generatorOptions' => [
                    'fields' => ['name'],
                    'fieldSeparator' => '/',
                    'prefixParentPageSlug' => true,
                    'replacements' => [
                        '/' => '',
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => '',
            ],
        ],
        'diet' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.diet',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.diet.I.carnivore', 'value' => 'carnivore'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.diet.I.herbivore', 'value' => 'herbivore'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.diet.I.insectivore', 'value' => 'insectivore'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.diet.I.omnivore', 'value' => 'omnivore'],
                ],
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'size' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.size',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,float',
                'default' => ''
            ],
        ],
        'weight' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.weight',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,float',
                'default' => ''
            ],
        ],
        'era' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.era',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.era.I.cretaceous', 'value' => 'cretaceous'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.era.I.jurassic', 'value' => 'jurassic'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.era.I.permian', 'value' => 'permian'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.era.I.triassic', 'value' => 'triassic'],
                ],
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'region' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.region',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.region.I.africa', 'value' => 'africa'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.region.I.antarctica', 'value' => 'antarctica'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.region.I.asia', 'value' => 'asia'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.region.I.australia', 'value' => 'australia'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.region.I.europe', 'value' => 'europe'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.region.I.north-america', 'value' => 'north-america'],
                    ['label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.region.I.south-america', 'value' => 'south-america'],
                ],
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'discovery_year' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.discovery_year',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,int+',
                'default' => ''
            ],
        ],
        'discoverer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.discoverer',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,float',
                'default' => ''
            ],
        ],
        'group' => [
            'exclude' => true,
            'label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.group',
            'config' => [
                'type' => 'input',
                'eval' => 'trim,float',
                'default' => ''
            ],
        ],
        'image' => [
            'label' => 'LLL:EXT:dinosaur_finder/Resources/Private/Language/locallang_db.xlf:tx_dinosaurfinder_dinosaur.image',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-media-types',
            ],
        ],
    ],
];
