//question and answer object constructor
function qAndA(question,answer)
{
	this.question = question;
	this.answer = answer;
}

var questions =
[
	new qAndA("A society whose processes/function can continue forever","Sustainable Society"),
	new qAndA("Resources that can be replenished at rate greater than or equal to the rate at which they are used","Renewable"),
	new qAndA("Development of communities in a previously lifeless area without soil","Primary Succession"),
	new qAndA("Organization of living things that consists of all living and nonliving things in the area as well as interactions between them","Ecosystem"),
	new qAndA("Breaking down the original product by some physical or chemical means, retrieving the materials, and using them as raw materials to make new products","Recycle"),
	new qAndA("The amount of resources that can be removed/harvested with out compromising ecosystem","Sustainable Yield")
];

var currentIndex;
var score = 0;
var totalQuestions;
var remainingQuestions = totalQuestions = questions.length;
var questionsAnswered = 0;
var selected;
//randomly chooses a question that has not been chosen before
function selectQuestion()
{
	//end case
	if(remainingQuestions == 0)
	{
		$("#question").text("You have finished this quiz! Your total score is " + score + "/"+ totalQuestions+ ".You can refresh the page to try again.")
		return;
	}
	var randomIndex = Math.floor(Math.random() * remainingQuestions);
	currentIndex = randomIndex;
	var randomQuestion = questions[randomIndex].question;

	//fill in the value on the page
	$("#question").text(randomQuestion);
}
//check the provided answer with the correct one
function checkAnswer(item)
{
	var enteredAnswer = item.text();
	var correctAnswer = questions[currentIndex].answer;

	questionsAnswered +=1;

	if(enteredAnswer == correctAnswer)
	{
		$("#score").text(++score);
		$("#question-container-body").css("background-color", "lightgreen");
		item.css("visibility", "hidden"); // 'Delete' the answer (without affecting DOM)
	}else
	{
		$("#question-container-body").css("background-color", "lightcoral");
	}
	//remove current question from the array so it is not repeated
	questions.splice(currentIndex,1);
	remainingQuestions-=1;
}

$(document).ready(function(){
	// Set date
	var date = new Date();
	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();
	$("#date").text(month+"/"+day+"/"+year);

	selectQuestion();
	// Stop Quiz
	$("#stop").on("click", function(){
		remainingQuestions = 0;
		selectQuestion();
		$( ".choice" ).draggable( "disable" );
	});
	// Next question
	$("#next").on("click", function(){
		selectQuestion();
		$( ".choice" ).draggable( "enable" );
		$("#question-container-body").css("background-color", "initial");
	});
	// Drag
	$(".choice").draggable({
		snap: "#target-container",
		snapMode: "inner",
		snapTolerance: 50,
		opacity: .5,
		revert: "valid"
	});
	// Drop
	$( "#target-container" ).droppable({
  	accept: ".choice",
		tolerance: "fit",
		drop: function(e, ui){
			checkAnswer(ui.draggable);
			$( ".choice" ).draggable( "disable" ); // Don't allow dragging more answers until new question
		}
	});
});
