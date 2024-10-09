<?php

//application and module titles
define ("AppTitle","SEL-0.1 - ");
define ("AdminModule","Administration Module");
define ("ExamModule","Exam Module");

//top link labels
define ("Home","Home");
define ("AddQuestions","Add questions to the QuestionBank");
define ("AddQuestionsForm","Add questions per form");
define ("AddQuestionsCSV","Add questions CSV file");
define ("manusers","Manage users");
define ("Method1","1st. Method");
define ("Method1Desc","Add a question per form");
define ("Method2","2nd. Method");
define ("Method2Desc","add lot of question using file upload of csv(comma separated variable) <br>
CSV file format: subjectid(integer),question(255),choice1(50),choice2(50),choice3(50),choice4(50),answer(integer between 1 and 4); <
br> benefits if easrlier question bank is available csv report generation is easy, or more user friendly /GUI programs like Access/Lotus123/Excel etc can be used ");
define ("MakeQP","Making Question Papers");
define ("MakeQPDesc","<br>1. first select the subject from the dropdown list press submit button<br>
left frame denotes questions available in particular subject<br> 
(questionid, correct answer, question, choices are shown)<br>
2. please select questionid(shown in bold) of question you like and paste it<br>
 in the right frame in the question number you want<br>
3. finally fill in your details(questionmakers name, date,and questionpaperid/number)<br>
 questionpaperid/number will be used to allocate test to students");

define("user"," user:");
define("password"," password: ");

define ("txtsessionid","session id: ");
define ("txtstudentid","student id: ");
define ("txtquestionpaperid","questionpaper id: ");

//errors,help,warnings messages
define ("FirstForm","Por favor, completa el formulario con todos los datos que se piden");
define ("ThankYou","gracias por contestar la evaluacion");
define ("WelcomeExam", "Welcome to de Exam Module");
define ("WelcomeAdmin", "Welcome to de Admin Module");
define ("Instructions","please fill the below form for writing your exam");
define ("SelSub","select Subject ....");
define ("Subjects","Subjects: ");
define ("NotRegistered","StudentID not registered, please contact with your teacher");
define ("QPnotregistered","The Questionpaper is not registered, please check it and try again");
define ("FileNotFound","Language File not found");
define ("ExamProcessed","Your exam have been processed...");
define ("ChoiceOption","Choice an option please...");

define ("login_error","bad User or wrong Password");
define("login_data","type your username and password");
define("form_data","type your student and questionpaper ids");

// buttons text
define ("txtsubmit","Submit");
define ("txtreset","Reset");

?>