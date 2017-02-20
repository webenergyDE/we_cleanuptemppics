<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Julian Hofmann <TYPO3.ext.YYYY@webenergy.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 */
/**
 * Task for deleting old images in typo3temp/pics/
 */
class tx_wecleanuptemppics_task extends tx_scheduler_Task {
	/**
	 * Executes the task
	 */
	public function execute() {
		$this->age = t3lib_div::intInRange($this->age, 1, 366, 28);

			// 1. Finding outdated entries in cache_imagesizes
		$picRows = $this->findOutdatedPics();

			// 2. Deleting pics and cache entries
		if (is_array($picRows)) {
			foreach ($picRows as $picRow) {
				$theFile = PATH_site . $picRow['filename'];
				unlink($theFile);

				$where = 'md5filename = "' . $picRow['md5filename'] . '"';
				$where.= ' AND md5hash = "' . $picRow['md5hash'] . '"';
				$GLOBALS['TYPO3_DB']->exec_DELETEquery('cache_imagesizes', $where);
			}
		}
		return true;
	}

	/**
	 * Finds all outdated pics
	 *
	 * @return array Pics as rows of cache_imagesizes
	 */
	public function findOutdatedPics() {
		$groupBy       = '';
		$orderBy       = '';
		$limit         = '10000';
		$uidIndexField = '';
		$fromTable     = 'cache_imagesizes';
		$select_fields = 'cache_imagesizes.*';

		$where = 'tstamp < ' . (time() - (3600*24*$this->age));
		$where.= ' AND filename LIKE "typo3temp/pics/%"';

		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows($select_fields, $fromTable, $where, $groupBy, $orderBy, $limit, $uidIndexField);
		return $rows;
	}
}
?>