<?php
include "../config/connection.php";

class Question
{
	public function __construct($conn)
	{
		$this->connection = $conn;
	}
	
	public function AddQuestion($text)
	{
		$sql = "INSERT INTO mc_question (Text) VALUES ('$text')";
		
		if ($this->connection->query($sql))
			return mysqli_insert_id($this->connection);
		
		return 0;
	}
	
	public function GetQuestion($id)
	{
		$sql = "SELECT * FROM mc_question WHERE Id ='$id'";
		$qry = $this->connection->query($sql);
		
		return mysqli_fetch_array($qry);
	}
	
	public function RemoveQuestion($id)
	{
		$sql = "DELETE FROM mc_question WHERE Id ='$id'";
		
		return $this->connection->query($sql);
	}
	
	public function UpdateQuestion($id, $data_)
	{
		$sql = "UPDATE mc_question SET Text='$data_[Text]' WHERE Id ='$id'";
		
		return $this->connection->query($sql);
	}
}

if (isset($_GET['test']) && $_GET['test'] == "ok")
{
	$test_question = new Question($connection_mysql);
	
	echo "add: ";
	$id = $test_question->AddQuestion("test 124");
	var_dump($id);
	echo "<br/>";
	
	echo "get: ";
	var_dump($test_question->GetQuestion($id));
	echo "<br/>";
	
	echo "update: ";
	
	$data_update = array(
		"Text" => "Update test 123"
	);
	
	var_dump($test_question->UpdateQuestion($id, $data_update));
	echo "<br/>";
	
	echo "delete: ";
	
	var_dump($test_question->RemoveQuestion($id));
	echo "<br/>";
}
?>