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
	new qAndA("A marketing term for practices that suggest sustainability when its not","Greenwashing"),
	new qAndA("Breaking down the original product by some physical or chemical means, retrieving the materials, and using them as raw materials to make new products","Recycle"),
	new qAndA("The amount of resources that can be removed/harvested with out compromising ecosystem","Sustainable Yield")
];

var currentIndex;
var score = 0;
var totalQuestions;
var remainingQuestions = totalQuestions = questions.length;
var questionsAnswered = 0;
		
//randomly chooses a question that has not been chosen before
function selectQuestion()
{
	//end case
	if(remainingQuestions == 0)
	{
		alert("You have finished this quiz! \nYour total score is " + score + "/"+ totalQuestions+ "\nYou can refresh the page to try again.");
		return;
	}	
	var randomIndex = Math.floor(Math.random() * remainingQuestions);
	currentIndex = randomIndex;
	var randomQuestion = questions[randomIndex].question;
	
	//fill in the value on the page
	document.getElementById("question").value = randomQuestion;
}

//check the provided answer with the correct one
function checkAnswer()
{
	var enteredAnswer = document.getElementById("answer").value;	
	var correctAnswer = questions[currentIndex].answer;
			
	//no answer given
	if(enteredAnswer == "")
	{
		alert("Please enter an answer before checking.");
		return;
	}
	questionsAnswered +=1;	
	
	//answer is correct
	if(enteredAnswer == correctAnswer)
	{
		score+=1;
		alert("Correct! Your score is: " + score + "/" + questionsAnswered);
	}
			
	//answer is incorrect
	else
	{
		alert("Incorrect! The answer was " + correctAnswer + " \nYour score is: " + score + "/" + questionsAnswered);
	}
			
	//remove current country from the array so it is not repeated
	questions.splice(currentIndex,1);
	remainingQuestions-=1;
}	