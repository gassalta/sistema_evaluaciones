<?php
/*
 * spanish.php : application and module titles
 * Andres Velasco Gordillo <phantomimo@gmail.com> 
 * <c> 2004 SEL-0.1beta
 */
 
//Nombre de la Aplicacion y Modulos
define ("Institute","Instituto Tecnológico de Comitán");
define ("AppTitle", "Sistema de Evaluaciones en L&iacute;nea");
define ("AdminModule","M&oacute;dulo de Administraci&oacute;n");
define ("ExamModule","M&oacute;dulo de Examen");
define ("StudentsModule","M&oacute;dulo de Alumnos");

//Etiquetas
define ("Home","Inicio");
define ("AddQuestions","Agregar preguntas a la base de datos");
define ("AddQuestionsForm","Agregar preguntas (form)");
define ("AddQuestionsCSV","Agregar preguntas (CSV)");
define ("ManUsers","Usuarios");
define ("MakeQP","Evaluaciones");
define ("Method1","1er. M&eacute;todo");
define ("Method1Desc","Agregar una pregunta a la vez a traves del formulario");
define ("Method2","2do. M&eacute;todo");
define ("Method2Desc","Agregar un conjunto de preguntas a trav&eacute;s de un archivo csv (variables separadas por comas), con el siguiente formato (CSV):<br>idmateria(integer), pregunta(cadena 255), opcion1(50), opcion2(50), opcion3(50), opcion4(50), respuesta(integer entre 1 y 4)<br><br>");
define ("MakeQPDesc","1.- Seleccione una materia de la lista desplegable y presione el boton Aceptar<br>
2.- El marco de la izquierda contiene las preguntas disponibles de la materia seleccionada (se muestran los campos de clave de pregunta, pregunta, opciones de respuesta y respuesta correcta)<br>
Seleccione el id de la pregunta (mostrado en negrita) que desea agregar al examen creado y escribala en el marco de la derecha en el n&uacute;mero de pregunta que ud. prefiera.<br>
3.- Finalmente complete los dem&aacute;s campos (nombre de evaluador, fecha y clave/n&uacute;mero de la evaluaci&oacute;n), este &uacute;ltimo se usar&aacute; para asignar evaluaciones a los estudiantes.<br>");

define("user","usuario");
define("password","contrase&ntilde;a");

define ("txtsessionid","id sesion: ");
define ("txtstudentid","numero de control: ");
define ("txtquestionpaperid","clave de examen: ");

//mensajes de error/ayuda/advertencia
define ("FirstForm","Por favor, completa el formulario con todos los datos que se piden");
define ("ThankYou","gracias por contestar la evaluacion");
define ("WelcomeExam", "Bienvenido al m&oacute;dulo de Examen");
define ("WelcomeAdmin", "Bienvenido al m&oacute;dulo de Administraci&oacute;n");
define ("Instructions","por favor completa la siguiente forma para iniciar tu examen");
define ("SelSub","selecccione una Materia...");
define ("Subjects","Materias");
define ("NotRegistered", "Aun no est&aacute;s registrado, por favor contacta con tu profesor");
define ("QPNotRegistered","Verifica tu clave de evaluaci&oacute;n y vuelve a intentarlo");
define ("FILE_NOT_FOUND","El archivo de idioma no existe");
define ("Results","Tus resultados estan siendo procesados...");
define ("Logout","Pulsa aqui para terminar el proceso");
define ("ExamProcessed","Tu evaluacion ya ha sido registrada...");
define ("ChoiceOption","Elige al menos una opcion");

define ("LOGIN_ERROR","usuario o contraseña incorrectos");
define ("LOGIN_DATA","Ingrese su nombre de usuario y contraseña");
define ("FORM_DATA","Ingresa la clave de examen y tu numero de control");
define ("FORM_ERROR","num de control o clave de examen incorrectos");

// etiquetas en botones
define ("txtsubmit","Aceptar");
define ("txtreset","Limpiar");

define ("already_registered", "el alumno ya fue registrado en esta evaluación")

?>