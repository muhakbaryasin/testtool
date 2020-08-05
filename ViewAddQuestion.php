<?php
include "Question.php";
include "Option.php";


?>
<script>
	var options = [];
	
	function submitQuestion()
	{
		json_string = {"question": document.getElementById("question_text").value, "options": options}
		
		$.ajax({
            type: "POST",
            url: "/AjaxAddQuestion",
            data: json_string,
            success: function (data) {
                alert("success");
				window.location.href = "ViewQuestion";
            },
            failure: function (errMsg) {
                alert(errMsg);
            }
        });
	}
	
	function textPreview()
	{
		document.getElementById("question").innerHTML = document.getElementById("question_text").value;
	}
	
	function addOption()
	{
		optionText = document.getElementById("option_text").value;
		
	if (optionText == null || optionText == undefined || optionText == "")
		return;
		
		isAnswer = document.getElementById("is_answer").checked;
		optionObj = {"text" : optionText, "isAnswer": isAnswer}
		
		if (isAnswer)
		{
			for(var i = 0; i < options.length; i++)
			{
				if (options[i]["isAnswer"])
				{
					alert("You have assign the answer option");
					return;
				}
			}
		}
		
		options.push(optionObj);
		
		document.getElementById("option_text").value = "";
		document.getElementById("is_answer").checked = false;
		
		generateRadios();
		
	}
	
	function generateRadios()
	{
		radio_html = "";
		
		for(var i = 0; i < options.length; i++)
		{
			label = options[i]["text"];
			
			if (options[i]["isAnswer"])
				label += " - <i>the answer </i>"
			
			radio_html += `<input type="radio" name="radio" id="radio${i}"/>
			<label for="radio${i}">${label}</label><br/>`;
		}
		
		document.getElementById("option").innerHTML = radio_html;
	}
	
	function clearForm()
	{
		options = []
		document.getElementById("question").innerHTML = "Have you typed a question?"
		document.getElementById("option").innerHTML = "-- please add the options"
		
		document.getElementById("option_text").value = "";
		document.getElementById("question_text").value = "";
		document.getElementById("is_answer").checked = false;
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
                <h3> Add Question</h3>
                <div class="form-group">
                    <label class="control-label">Question Text</label>
                    <textarea name="text" id="question_text" class="form-control" cols="100" onchange="textPreview()" onkeyup="textPreview()"></textarea>
                </div>
				
                <div class="form-group">
                    <label class="control-label">Option</label>
                    <input id="option_text" name="option_text" maxlength="100" type="text" class="form-control" style="margin-bottom: 10px;"/>
					<input type="checkbox" name="is_answer"  id="is_answer"/>
					<label for="is_answer">is this the Answer?</label>
					<input style="float: right;" type="button" value="add option" onclick="addOption()"/>
                </div>
                <button class="btn btn-default pull-right" id="resetButton" type="button" onclick="clearForm()">Reset</button>
				<button class="btn btn-primary pull-right" id="addButton" type="button" onclick="submitQuestion()">Add Question</button>
            </div>
        </div>
    </div>
</form>
<div class="preview" style="border: 1px solid #000; padding: 10px">
<div >
	<pre id="question">Have you typed a question?</pre>
</div>
<div id="option">
	-- please add the options
</div>
      
</div>