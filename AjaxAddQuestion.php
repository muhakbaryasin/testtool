<?php
include "Question.php";
include "Option.php";

$question = new Question($connection_mysql);
$option = new Option($connection_mysql);
	
if ($_SERVER["REQUEST_METHOD"] != "POST" )
	exit;

if (!isset($_POST['question']))
	exit;

if (!isset($_POST['options']))
	exit;

$question_id = $question->AddQuestion($_POST['question']);
$option_len = count($_POST['options']);

for ($i = 0; $i < $option_len; $i++)
{
	$option->AddOption($question_id, $_POST['options'][$i]["text"], $_POST['options'][$i]["isAnswer"]);
}
?>