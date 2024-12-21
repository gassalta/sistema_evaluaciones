<?php
require_once 'config.inc.php';
require_once BASE_URL_ADMIN . '/db.php';
$db = Database::getInstance();

require_once BASE_URL_ADMIN . '/funciones.php';

// Archivo de idioma
$langfile = BASE_URL . "/lang/" . $language . ".php";
require_once($langfile);

if (!file_exists($langfile)) {
  rep_error(FILE_NOT_FOUND);
  exit;
}
?>
<html>

<head>
  <title><?= AppTitle ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/estilo.css">

  <style>
    /* Diseño de contenedor padre usando Flexbox */
    .container {
      display: flex;
      /* Activa Flexbox */
      width: 100%;
      /* Toma el ancho completo */
      height: 100vh;
      /* Toma el alto completo */
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Estilos para cada iframe */
    .left-frame,
    .right-frame {
      flex: 1;
      /* Divide el espacio en partes iguales */
      border: none;
      /* Elimina los bordes del iframe */
    }

    /* Opcional: Ajusta márgenes en el iframe derecho */
    .right-frame {
      margin-left: 10px;
      /* Espaciado entre frames */
    }
  </style>

</head>

<body>
  <?php
  include BASE_URL_ADMIN.'/class/menu.php';
  ?>
  <div class="container">
    <!-- Iframe izquierdo -->
    <iframe
      class="left-frame"
      name="leftFrame"
      src="listquestion_by_subject.php?idmateria=<?php echo htmlspecialchars($_REQUEST['idmateria']); ?>"
      scrolling="yes">
    </iframe>

    <!-- Iframe derecho -->
    <iframe
      class="right-frame"
      name="rightFrame"
      src="questionpapers_form.php?idmateria=<?php echo htmlspecialchars($_REQUEST['idmateria']); ?>">
    </iframe>
  </div>
</body>

</html>