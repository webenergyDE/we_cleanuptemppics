<?php
class tx_wecleanuptemppics_task_addFields implements tx_scheduler_AdditionalFieldProvider {
	public function getAdditionalFields(array &$taskInfo, $task, tx_scheduler_Module $parentObject) {

		if (empty($taskInfo['age'])) {
			if ($parentObject->CMD == 'add') {
				$taskInfo['age'] = '7';
			} elseif ($parentObject->CMD == 'edit') {
				$taskInfo['age'] = $task->age;
			} else {
				$taskInfo['age'] = '';
			}
		}

			// Write the code for the field
		$fieldID = 'task_age';
		$fieldCode = '<input type="text" name="tx_scheduler[age]" id="' . $fieldID . '" value="' . $taskInfo['age'] . '" size="5" />';
		$additionalFields = array();
		$additionalFields[$fieldID] = array(
			'code' => $fieldCode,
			'label' => 'LLL:EXT:we_cleanuptemppics/locallang.xml:task.label.age',
			'cshKey' => '_MOD_tools_txschedulerM1',
			'cshLabel' => $fieldID
		);

		return $additionalFields;
	}

	public function validateAdditionalFields(array &$submittedData, tx_scheduler_Module $parentObject) {
		$submittedData['age'] = trim($submittedData['age']);
		return true;
	}

	public function saveAdditionalFields(array $submittedData, tx_scheduler_Task $task) {
		$task->age = $submittedData['age'];
	}
}
?>