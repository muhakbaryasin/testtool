<?php
include "connection.php";

class Option
{
	public function __construct($conn)
	{
		$this->connection = $conn;
	}
	
	public function AddOption($questionId, $text, $isAnswer = 0)
	{
		$sql = "INSERT INTO mc_option (IdQuestion, Text, IsAnswer) VALUES ($questionId, '$text', $isAnswer)";
		
		echo $sql;
		
		if ($this->connection->query($sql))
			return mysqli_insert_id($this->connection);
		
		return 0;
	}
	
	public function GetOptions($questionId)
	{
		$sql = "SELECT * FROM mc_option WHERE IdQuestion = $questionId";
		return $this->connection->query($sql);
	}
	
	public function RemoveOption($id)
	{
		$sql = "DELETE FROM mc_option WHERE Id ='$id'";
		
		return $this->connection->query($sql);
	}
	
	public function UpdateOption($id, $data_)
	{
		$len = count($data_);
		$i = 0;
		$sql = "UPDATE mc_option SET ";
		
		foreach ($data_ as $key => $value)
		{
			$sql = $sql ."". $key . "='" .$value . "'";
			
			if ($i < $len - 1)
				$sql = $sql.",";
			
			$i++;
		}
		
		$sql = $sql ." WHERE Id ='$id'";
		
		return $this->connection->query($sql);
	}
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['test']) && $_GET['test'] == "ok")
{
	$test_option = new Option($connection_mysql);
	
	echo "add: ";
	$id = $test_option->AddOption(7, "option 1 test");
	var_dump($id);
	echo "<br/>";
	$id = $test_option->AddOption(7, "option 2 test", 1);
	var_dump($id);
	echo "<br/>";
}
?>