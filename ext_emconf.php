<?php
$EM_CONF[$_EXTKEY] = array(
    'title' => 'Cleaner for typo3temp/pics',
    'description' => 'Deletes old images within typo3temp/pics and corresponding records in table cache_imagesizes.',
    'category' => 'be',
    'shy' => 0,
    'version' => '0.1.0',
    'priority' => '',
    'loadOrder' => '',
    'module' => '',
    'state' => 'obsolete',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearcacheonload' => 0,
    'lockType' => '',
    'author' => 'Julian Hofmann',
    'author_email' => 'TYPO3.ext.YYYY@webenergy.de',
    'author_company' => '',
    'CGLcompliance' => '',
    'CGLcompliance_note' => '',
    'constraints' => array(
        'depends' => array(
            'typo3' => '4.5.0-4.5.99'
        ),
        'conflicts' => array(),
        'suggests' => array()
    )
);
?>