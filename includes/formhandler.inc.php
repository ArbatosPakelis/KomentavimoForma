<?php

require_once 'FormHandler.php';
require_once 'dbh.inc.php';
// handles submit request from the form
// add database connection before handling
$formHandler = new FormHandler($pdo);
echo $formHandler->handleFormSubmission($additionalIdentifier);

?>
