<?php
include "Question.php";
include "Option.php";
	
$question = new Question($connection_mysql);
$option = new Option($connection_mysql);
?>
<html>
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <table class="table table-striped custab">
    <thead>
    <a href="ViewAddQuestion" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new question</a>
        <tr>
            <th>No</th>
            <th>Question Text</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
			<?php
				$get_question = $question->GetQuestion();
				$no = 1;
				
				while($row_question = $get_question->fetch_assoc()) {
				?>
            <tr>
                <td><?=$no?></td>
                <td><?=$row_question["Text"]?></td>
                <td class="text-center">
					<a class='btn btn-info btn-xs' href="ViewEditQuestion?id=<?=$row_question["Id"]?>">
						<span class="glyphicon glyphicon-edit"></span> Details
					</a> 
				</td>
            </tr>
			<?php
					$no++;
				}
			?>
    </table>
	<a href="ViewAddQuestion" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new question</a>
    
</div>
</html>