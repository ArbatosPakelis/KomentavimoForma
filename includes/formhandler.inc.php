<?php

require_once 'FormHandler.php';
require_once 'dbh.inc.php';

$formHandler = new FormHandler($pdo);
echo $formHandler->handleFormSubmission($additionalIdentifier);

?>
