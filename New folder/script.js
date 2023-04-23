var quiz = {
	JS: [
		{
			id: 1,
			question: "How many bones does a human adult have?",
			options: [
				{
					a: "206",
					b: "202",
					c: "196",
					d: "200",
				},
			],
			answer: "206",
			score: 0,
			status: "",
		},
		{
			id: 2,
			question: "Who was the Prime Minister of India?",
			options: [
				{
					a: "Jawaharlal Nehru",
					b: "Indira Gandhi",
					c: "Manmohan Singh",
					d: "Narendra Modi",
				},
			],
			answer: "Narendra Modi",
			score: 0,
			status: "",
		},
		{
			id: 3,
			question: "What is the Capital of India?",
			options: [
				{
					a: "Hyderabad",
					b: "Delhi",
					c: "Mumbai",
					d: "Bangalore",
				},
			],
			answer: "Delhi",
			score: 0,
			status: "",
		},
		{
			id: 4,
			question: "What is the name of the tallest mountain?",
			options: [
				{
					a: "Makalu",
					b: "Mount Everest",
					c: "Kangchenjunga",
					d: "K2",
				},
			],
			answer: "Mount Everest",
			score: 0,
			status: "",
		},
		{
			id: 5,
			question: "What is the largest continent?",
			options: [
				{
					a: "Africa",
					b: "Australia",
					c: "Asia",
					d: "Europe",
				},
			],
			answer: "Asia",
			score: 0,
			status: "",
		},
		{
			id: 6,
			question: "In which city Char Minar is located?",
			options: [
				{
					a: "Bangalore",
					b: "Delhi",
					c: "Mumbai",
					d: "Hyderabad",
				},
			],
			answer: "Hyderabad",
			score: 0,
			status: "",
		},
		{
			id: 7,
			question: "Which is the national fruit of India?",
			options: [
				{
					a: "Mango",
					b: "Apple",
					c: "Banana",
					d: "Watermelon",
				},
			],
			answer: "Mango",
			score: 0,
			status: "",
		},
		{
			id: 8,
			question: "Which is the biggest animal on earth?",
			options: [
				{
					a: "Giraffe",
					b: "Dinosaur",
					c: "Blue Whale",
					d: "Shark",
				},
			],
			answer: "Blue Whale",
			score: 0,
			status: "",
		},
		{
			id: 9,
			question: "Who is the founder of Facebook?",
			options: [
				{
					a: "Elon Mask",
					b: "Sundar Pichai",
					c: "Steve Jobs",
					d: "Mark Zuckerberg",
				},
			],
			answer: "Mark Zuckerberg",
			score: 0,
			status: "",
		},
		{
			id: 10,
			question: "Who has the authority to issue currency in India?",
			options: [
				{
					a: "Reserve Bank of India (RBI)",
					b: "Punjab National Bank(PNB)",
					c: "Axis Bank",
					d: "State Bank of India(SBI)",
				},
			],
			answer: "Reserve Bank of India (RBI)",
			score: 0,
			status: "",
		},
	],
};

let a = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var quizApp = function () {
	this.score = 0;
	this.qno = 1;
	this.currentque = 0;
	var totalque = quiz.JS.length;
	this.displayQuiz = function (cque) {
		this.currentque = cque;
		if (this.currentque < totalque) {
			$("#tque").html(totalque);
			$("#previous").attr("disabled", false);
			$("#next").attr("disabled", false);
			$("#qid").html(quiz.JS[this.currentque].id + ".");
			$("#question").html(quiz.JS[this.currentque].question);
			$("#question-options").html("");
			for (var key in quiz.JS[this.currentque].options[0]) {
				if (quiz.JS[this.currentque].options[0].hasOwnProperty(key)) {
					$("#question-options").append(
						"<div class='form-check option-block'>" +
							"<label class='form-check-label'>" +
							"<input type='radio' class='form-check-input' name='option' id='q" +
							key +
							"' value='" +
							quiz.JS[this.currentque].options[0][key] +
							"'><span id='optionval'>" +
							quiz.JS[this.currentque].options[0][key] +
							"</span></label>"
					);
				}
			}
		}
		if (this.currentque <= 0) {
			$("#previous").attr("disabled", true);
		}
		if (this.currentque >= totalque) {
			$("#next").attr("disabled", true);
			for (var i = 0; i < totalque; i++) {
				this.score = this.score + quiz.JS[i].score;
			}
			return this.showResult(this.score);
		}
	};
	this.showResult = function (scr) {
		$("#result").addClass("result");
		$("#result").html(
			"<h1 class='res-header'>Total Score: &nbsp;" +
				scr +
				"/" +
				totalque +
				"</h1>"
		);
		for (var j = 0; j < totalque; j++) {
			var res;
			if (quiz.JS[j].score == 0) {
				res =
					'<span class="wrong">' +
					quiz.JS[j].score +
					'</span><i class="fa fa-remove c-wrong"></i>';
			} else {
				a[j] = 1;
				res =
					'<span class="correct">' +
					quiz.JS[j].score +
					'</span><i class="fa fa-check c-correct"></i>';
			}
			$("#result").append(
				'<div class="result-question"><span>Q ' +
					quiz.JS[j].id +
					"</span> &nbsp;" +
					quiz.JS[j].question +
					"</div>" +
					"<div><b>Correct answer:</b> &nbsp;" +
					quiz.JS[j].answer +
					"</div>" +
					'<div class="last-row"><b>Score:</b> &nbsp;' +
					res +
					"</div>"
			);
		}
		console.log(a);
		console.log(scr);
		$.ajax({
			type: "POST",
			url: "login_2.php", // Replace with the URL of your PHP script
			data: {
				submit_answers: 1,
				answer1: a[0],
				answer2: a[1],
				answer3: a[2],
				answer4: a[3],
				answer5: a[4],
				answer6: a[5],
				answer7: a[6],
				answer8: a[7],
                answer9: a[8],
                answer10:a[9],
				score: scr,
			},
			success: function () {
				console.log("Response saved to database");
			},
			error: function () {
				console.log("Error saving response to database");
			},
		});

		$("#submit_answers").submit(function (event) {
			// Prevent the form from submitting normally
			event.preventDefault();

			// Get the user's quiz answers and score from the form
			var answers = $("#quiz-form input[type='radio']:checked")
				.map(function () {
					return $(this).val();
				})
				.get();
			var score = $("#quiz-score").val();

			// Send a POST request to the PHP script to save the user's quiz answers
			$.post(
				"save_quiz_answers.php",
				{ answers: answers, score: score },
				function (data) {
					// Handle the response from the server (if needed)
					console.log(data);
				}
			);
		});
	};
	this.checkAnswer = function (option) {
		var answer = quiz.JS[this.currentque].answer;
		option = option.replace(/</g, "&lt;"); //for <
		option = option.replace(/>/g, "&gt;"); //for >
		option = option.replace(/"/g, "&quot;");
		if (option == quiz.JS[this.currentque].answer) {
			if (quiz.JS[this.currentque].score == "") {
				quiz.JS[this.currentque].score = 1;
				quiz.JS[this.currentque].status = "correct";
			}
		} else {
			quiz.JS[this.currentque].status = "wrong";
		}
	};
	this.changeQuestion = function (cque) {
		this.currentque = this.currentque + cque;
		this.displayQuiz(this.currentque);
	};
};
var jsq = new quizApp();
var selectedopt;
$(document).ready(function () {
	jsq.displayQuiz(0);
	$("#question-options").on(
		"change",
		"input[type=radio][name=option]",
		function (e) {
			//var radio = $(this).find('input:radio');
			$(this).prop("checked", true);
			selectedopt = $(this).val();
		}
	);
});
$("#next").click(function (e) {
	e.preventDefault();
	if (selectedopt) {
		jsq.checkAnswer(selectedopt);
	}
	jsq.changeQuestion(1);
});
$("#previous").click(function (e) {
	e.preventDefault();
	if (selectedopt) {
		jsq.checkAnswer(selectedopt);
	}
	jsq.changeQuestion(-1);
});
