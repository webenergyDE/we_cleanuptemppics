<?php
if (!defined('TYPO3_MODE')) die ('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['tx_wecleanuptemppics_task'] = array(
	'extension' => $_EXTKEY,
	'title'            => 'LLL:EXT:' . $_EXTKEY . '/locallang.xml:task.name',
	'description'      => 'LLL:EXT:' . $_EXTKEY . '/locallang.xml:task.description',
	'additionalFields' => 'tx_wecleanuptemppics_task_addFields'
);
?>