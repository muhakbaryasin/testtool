<?php
include "Question.php";
include "Option.php";

if ($_SERVER["REQUEST_METHOD"] != "GET" )
	exit;

if (!isset($_GET['id']))
	exit;

$id = intval($_GET['id']);

$question = new Question($connection_mysql);
$option = new Option($connection_mysql);

$get_option = $option->GetOptions( $id );

while($row_option = $get_option->fetch_assoc()) {
	$option->RemoveOption($row_option['Id']);
}

$question->RemoveQuestion($id);

header("Location: ViewQuestion", true, 301);
?>