<?php
$path = $_SERVER['DOCUMENT_ROOT'];
include $path . '/apps/edu/controllers/NoteController.php';

$noteController = new NoteController();

$note = $noteController->get_note_edit($_GET['id']);