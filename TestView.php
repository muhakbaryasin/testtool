<?php
	include "Question.php";
	include "Option.php";
	
	$question = new Question($connection_mysql);
	$option = new Option($connection_mysql);
	
	if ($_SERVER["REQUEST_METHOD"] != "GET" )
		exit;
	
	if (!isset($_GET['seq']))
		header("Location: TestView?seq=0", true, 301);
	
	$seq = intval($_GET['seq']);
?>

<html>
<head>

<script>
	function updateQueryStringParameter(uri, key, value) {
		var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
		var separator = uri.indexOf('?') !== -1 ? "&" : "?";
  
		if (uri.match(re)) {
			return uri.replace(re, '$1' + key + "=" + value + '$2');
		}
		else {
			return uri + separator + key + "=" + value;
		}
	}
	
	function goToQuestion(seq)
	{
		var current_uri = window.location.href.split('?')[0];
		window.location.href = updateQueryStringParameter(window.location.href, "seq", seq);
	}
	
	function submitAnswer(seq)
	{
		
	}
</script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="static/library/css/site.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
   <div class="row">
      <br/>
	<?php
		$len_question = ($question->GetQuestion()->num_rows);
		$get_question = $question->GetQuestionBySeq($seq);
		
		if ($seq >= $len_question)
			echo "Selesai terima kasih";
		
		while($row_question = $get_question->fetch_assoc()) {
	?>
<div class="panel panel-primary">
         <div class="panel-heading">
		<pre>
<?php echo $row_question['Text']; ?>
		</pre>
         </div>
         <!--.panel-heading-->
         <div class = "panel-body">
            <h4>Your Answer</h4>
         </div>
         <form>
			 <div class="panel-footer">
				<div class="row">
				   <div class="funkyradio">
				   <?php
					$get_option = $option->GetOptions( $row_question['Id'] );
					
					while($row_option = $get_option->fetch_assoc()) {
				   ?>
					  <div class="funkyradio-primary">
						 <input type="radio" name="radio" id="<?=$row_option['Id']?>"/>
						 <label for="<?=$row_option['Id']?>"><?php echo $row_option['Text'] ?></label>
					  </div>
					 <?php
					}
					?>
				   </div>
				</div>
			 </div>
			 <?php
			 if ($seq > 0) {?>
				<input type="button" value="<< previous question" onclick="goToQuestion(<?=$seq-1?>)"/>
			 <?php 
			 } 
			 ?>
			 
			 <?php
			 if ($seq < $len_question-1) {
				 ?>
			 <input type="button" value="next question >>" onclick="goToQuestion(<?=$seq+1?>)"/>
			 <?php 
			 } 
			 ?>
			 
			 <?php
			 if ($seq == $len_question-1) {
			 ?>
			 <input type="button" value=">> finish <<" onclick="goToQuestion(<?=$seq+1?>)"/>
			 <?php
			 }
			 ?>
		 </form>
      </div>
	<?php
		}
	?>		
			
		
   </div>
</div>
</body>
</html>