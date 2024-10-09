<?php
//Nombre de la Aplicacion y Modulos;1
define ("AppTitle", "SEL-0.1 - ");
//Modulo de Administración
define ("AdminModule"," ta  sventa c'uchaal lecuc xbat a bu'un");
//Modulo de Exámen
define ("ExamModule","lecuc'no o'x li a pruebá");

//Etiquetas  // señail
define ("Home","sliquev'al"); //Inicio
define ("AddQuestions","xac'be  c'usi  ta sjac' li ta s'quejubile");//Agregar preguntas a la base de datos
define ("AddQuestionsForm","xac'be c'usi  ta sjac'");//Agregar preguntas (form)
define ("AddQuestionsCSV","xac'be c'usi  ta sjac' (CSV)"); //Agregar preguntas (CSV)
define ("ManUsers","vuch'u tas st'unes");//Usuarios
define ("MakeQP","prueb'aetics");//Evaluaciones
define ("Method1","va'yuc  pasoe");//1er. Metodo
//Agregar una pregunta a la vez a traves del formulario
define ("Method1Desc","xac'be c'usi  ta sjac' j'un no osh ta tique'l  ja  ta bu meltsan bil shae'.");
//2do. Método
define ("Method2","schi'bal  pasoe"); 
//Agregar un grupo preguntas a traves de un archivo csv  (variables separadas por comas), con el siguiente formato
//Es facil generar Reportes a partir de archivos CSV mediante programas como phpMyAdmin o gmyclient, etc.
define ("Method2Desc","xac'be jun tso'p vu que'jel c'usi ta sjac' ta tique'l ti bu que'gel (tash ge'l cha'cal ta jun comae), buch t'al   señaile(CSV):<br>
idmateria(integer), pregunta jac'o (cadena 255), opcion1vayu'c na ca cha t'u(50), opcion2 schi'bal na ca cha t'u  (50), opcion3  yoshibal na ca cha t'u (50), opcion4 schanibal na ca cha t'u (50), respuesta stac'obil (integer entre 1 y 4)
<br>
<br>c'uno ox ta pasel li listaetik&eacute;  CSV  ja li bu k'ejajtiké  ja  taj  p`programaetiké  c'ucha'al phpMyAdmin o gmyclient");
//1.- Selecciona una materia de la lista desplegable y presiona el boton submit
//2.- El marco de la izquierda contiene las preguntas disponibles de la materia seleccionada (se muestran los campos de clave de pregunta, respuesta correcta, pregunta, opciones)
//Por favor selecciona el id de la pregunta (mostrado en negrita) que desees agregar al examen y pegala en el marco de la derecha en el numero de pregunta que tu quieras.
//3.- Finalmente completa los demas campos (nombre de evaluador, fecha y clave/numero de la evaluacion), este ultimo se usara para asignar evaluaciones a los estudiantes.
define ("MakeQPDesc","t'ujoj jun materia li bu cholol a v'ilojé i n'et'o li botoné submit<br>
<br> li sti'ilé ta ts'et yich'oj li c'usi ta sjac' te oy ta materia t'ujó (cha'c sba ta ilel li vu sventa señail li c'usi ta sjac')
<br> a bocoluc' t'ujo li n'acal  c'usi  ta sjac'( cha'j ta ilel ta ik'e) c'usi cha k'an ta ts'acumtase a li a prueba'e schu'uc pac'o stas sti'il ta batsi' c'om li numereo c'usi ta sh'a c'an.
<br> sl'ajeval  ts'ac'umtasó yantic' campoé (sb'i lij k'elbanejé, sc'ac'alil xchiu'c  señail / snumeroal li pruebaetik  ), li sl'ajevalé chi'ch tunesel sventa  chi'ch a'c vel pruebaetic' li  chanunetiké");

define("user","vuch'u tas st'unes: ");//usuario
define("password","contrase&ntilde;a");
define ("txtsessionid","id sesion: ");
define ("txtstudentid","li numeroe  sventa ta k'elel");//numero de control:
define ("txtquestionpaperid","snumeroal li prueb'ae");//clave de examen:

//mensajes de error/ayuda/advertencia   // smantalil  li  ch'abal  leke / coltael /  ch kalbot
//Por favor, completa el formulario con todos los datos que se piden
define ("FirstForm"," a bocoluc', ts'acu'mtaso li ja chic c'u cha'al ste'quel li c'usi taxa c'anbate.");

//gracias por contestar la evaluacion
define ("ThankYou","colabal la ts'acumtas li prueba'e");

//Bienvenido al modulo de Examen
define ("WelcomeExam", "lecuc' no' ox  a julel  ta  sventa li pruebaé");

//Bienvenido al modulo de Administración
define ("WelcomeAdmin", "lecuc no' ox  a julel  ta  sventa c'uchaal lecuc xbat a bu'un");

//Por favor completa la siguiente forma para iniciar tu examen
define ("Instructions","a bocoluc', ts'acumt'aso  li c'usi tash xt'ale c'ochal  shu clic li a pruebaé");

//seleccciona una Materia...
define ("SelSub","t'ujo junuc' materiaetic...");

//Materias
define ("Subjects","materiaetics");

//Aun no estas registrado, por favor contacta con tu profesor
define ("NotRegistered", "mu yut to ojtiqui'nbilot, a bocoluc'    jac'bo a va maestroe.");

//Verifica tu clave de evaluacion y vuelve a intentarlo
define ("QPNotRegistered","k'elo ti a señail li a prueb'a xchi'uc cha' no pasó.");

//El archivo de idioma no existe
define ("FileNotFound","li co'p  vu que'jel  muyuc' te' oy.");

//Tus resultados estan siendo procesados...
define ("Results","li a  resultadotak'e ta  xa  tsu'ts b'al.");

//Pulsa aqui para terminar el proceso
define ("Logout"," net'o li'e sventa tsu'ts li c'usi schi'ch pasele'");

//Tu evaluacion ya ha sido procesada...
define ("ExamProcessed","li a prueb'ae tsu'tsa");

//usuario o password incorrectos
define ("login_error","vuch'u tas st'unes o li nac'al ch'abal lec'.");

//Ingresa tu nombre de usuario y password
define("login_data","tik'o   li a bie c'ochal ti vuch'u tas st'unes schu'uc li a  nac'al");

//Ingresa tu numero de control y la clave de examen
define("form_data","tik'o li  numeroe  sventa ta k'elel schu'uc li señailé li prueba'e");

// Etiquetas en botones: Aceptar &  Limpiar
define ("txtsubmit","ta xich'");
define ("txtreset","ta scu's");
?>
