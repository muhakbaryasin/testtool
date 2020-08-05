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

$get_question = $question->GetQuestion($id);
?>
<script>
	function deleteQuestion()
	{
		var r = confirm("Are you sure to delete this question?");
		
		if (!r)
		  return;
	  
		window.location.href = "ViewDeleteQuestion?id=<?=$id?>"
	}
	
	function back()
	{
		window.location.href = "ViewQuestion"
	}
</script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">

<form role="form">
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> View Question</h3>
                <button class="btn btn-default pull-right" id="resetButton" type="button" onclick="back()">Back</button>
				<button class="btn btn-primary pull-right" id="addButton" type="button" onclick="deleteQuestion()">Delete Question</button>
            </div>
        </div>
    </div>
</form>
<div class="preview" style="border: 1px solid #000; padding: 10px">
<?php
	while($row_question = $get_question->fetch_assoc()) {
?>
<div >
	<pre id="question"><?= $row_question['Text'] ?></pre>
</div>
<div id="option">
		
		<?php
			$get_option = $option->GetOptions( $row_question['Id'] );
			
			while($row_option = $get_option->fetch_assoc()) {
		?>
			<li><?= $row_option['Text'] ?> <?php if ($row_option['IsAnswer']) echo "<i> - the answer</i>" ?></li>
		<?php
			}
		?>
		</ul>
</div>
<?php
	}
?>
      
</div>