<html>

<head>
  <link href="../css/estilo.css" rel="stylesheet">
</head>

<body>
  <?php

  include('db.php');

  if (isset($_REQUEST['idmateria']))
    $idmateria = $_REQUEST['idmateria'];
  else
    $idmateria = 1;

  if (isset($_REQUEST['action']))
    $action = $_REQUEST['action'];
  else
    $action = 'insert';


  echo "<h3>Evaluaciones creadas</h3>";

  $query =  "SELECT e.*, m.nombre AS materia FROM texamenes e LEFT JOIN tmaterias m ON e.idmateria = m.idmateria WHERE e.idmateria = " . $idmateria . " ORDER BY e.idexamen ASC";

  echo "<table width=\"90%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\n";
  echo "<tr><td>Clave de examen</td><td>Fecha</td><td>Materia</td><td>Acciones</td></tr>";

  if ($req = mysqli_query($base_selection,$query)) {
    while ($row = mysqli_fetch_object($req)) {
      echo "<tr><td class=\"bgwhite10\" width=\"30%\"><b> " . $row->claveexamen . " </b></td>
					  <td class=\"bgwhite10\" width=\"20%\">" . $row->fecha . "</td>
					  <td class=\"bgwhite10\" width=\"30%\">" . $row->materia . "</td>
						<td align=\"center\"><input type=\"button\" onclick=\"location='questionpapers_form.php?id=$row->idexamen&action=edit';\" value=\"Editar\"></td></tr>";
    }
    mysqli_free_result($req);
  }

  echo "</table>\n";
  echo "<br>\n";

  $q = array();
  for ($i = 0; $i <= 20; $i++) {
    $q[$i] = "";
  }
  $idexamen = "";
  $claveexamen = "";
  $fecha = "";
  if (isset($_REQUEST['action']))
    if ($_REQUEST['action'] == 'edit') {
      $query =  "SELECT * FROM texamenes WHERE idexamen = " . $_REQUEST['id'];
      if ($req = mysqli_query($base_selection,$query)) {
        if ($row = mysqli_fetch_object($req)) {
          $idexamen = $row->idexamen;
          $claveexamen = $row->claveexamen;
          $fecha = $row->fecha;

          $query =  "SELECT q0,q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,q13,q14,q15,q16,q17,q18,q19 FROM texamenes WHERE idexamen = " . $idexamen;
          $req = mysqli_query($base_selection,$query);
          if ($row = mysqli_fetch_row($req)) {
            for ($i = 0; $i < mysqli_num_fields($req); $i++)
              $q[$i] = $row[$i];
          }
        }
        mysqli_free_result($req);
      }
    }



  ?>

  <form name="formz" method="post" action="questionpapers_<?php echo $action ?>.php">
    <?php if (($action == 'edit')) { ?>
      <h3>Modificar Evaluaci&oacute;n </h3>
    <?php } else { ?>
      <h3>Crear Evaluaci&oacute;n </h3>
    <?php } ?>

    <table border="1" width="80%">
      <tr>
        <td class="bgblue" width="30%">Clave Examen</td>
        <td class="bgblue" width="50%">Fecha</td>
      </tr>
      <tr>
        <td width="19%"><input type="text" name="claveexamen" size="18" value="<?php echo $claveexamen; ?>" /></td>
        <td width="19%"><input type="text" name="fecha" size="10" value="<?php echo $fecha; ?>" /> (yyyy-mm-dd)</td>
      </tr>
    </table>
    <br>

    <table title="Preguntas" width="45%" border="1" cellspacing="0" cellpadding="1">
      <tr>
        <td>1</td>
        <td><input type="text" name="q0" size="11" value="<?php echo $q[0]; ?>" /></td>
        <td>2</td>
        <td><input type="text" name="q1" size="11" value="<?php echo $q[1]; ?>" /></td>
      </tr>
      <tr>
        <td>3</td>
        <td><input type="text" name="q2" size="11" value="<?php echo $q[2]; ?>" /></td>
        <td>4</td>
        <td><input type="text" name="q3" size="11" value="<?php echo $q[3]; ?>" /></td>
      </tr>
      <tr>
        <td>5</td>
        <td><input type="text" name="q4" size="11" value="<?php echo $q[4]; ?>" /></td>
        <td>6</td>
        <td><input type="text" name="q5" size="11" value="<?php echo $q[5]; ?>" /></td>
      </tr>
      <tr>
        <td>7</td>
        <td><input type="text" name="q6" size="11" value="<?php echo $q[6]; ?>" /></td>
        <td>8</td>
        <td><input type="text" name="q7" size="11" value="<?php echo $q[7]; ?>" /></td>
      </tr>
      <tr>
        <td>9</td>
        <td><input type="text" name="q8" size="11" value="<?php echo $q[8]; ?>" /></td>
        <td>10</td>
        <td><input type="text" name="q9" size="11" value="<?php echo $q[9]; ?>" /></td>
      </tr>
      <tr>
        <td>11</td>
        <td> <input type="text" name="q10" size="11" value="<?php echo $q[10]; ?>" /></td>
        <td>12</td>
        <td><input type="text" name="q11" size="11" value="<?php echo $q[11]; ?>" /></td>
      </tr>
      <tr>
        <td>13</td>
        <td><input type="text" name="q12" size="11" value="<?php echo $q[12]; ?>" /></td>
        <td>14</td>
        <td><input type="text" name="q13" size="11" value="<?php echo $q[13]; ?>" /></td>
      </tr>
      <tr>
        <td>15</td>
        <td><input type="text" name="q14" size="11" value="<?php echo $q[14]; ?>" /></td>
        <td>16</td>
        <td><input type="text" name="q15" size="11" value="<?php echo $q[15]; ?>" /></td>
      </tr>
      <tr>
        <td>17</td>
        <td><input type="text" name="q16" size="11" value="<?php echo $q[16]; ?>" /></td>
        <td>18</td>
        <td><input type="text" name="q17" size="11" value="<?php echo $q[17]; ?>" /></td>
      </tr>
      <tr>
        <td>19</td>
        <td><input type="text" name="q18" size="11" value="<?php echo $q[18]; ?>" /></td>
        <td>20</td>
        <td><input type="text" name="q19" size="11" value="<?php echo $q[19]; ?>" /></td>
      </tr>
    </table>
    <p>
      <input type="hidden" name="idmateria" value="<?php echo $idmateria; ?>" />
      <input type="hidden" name="idexamen" value="<?php echo $idexamen; ?>" />
      <?php if (($action == 'edit')) { ?>
        <input type="submit" name="Submit" value="Guardar" />
      <?php } else { ?>
        <input type="submit" name="Submit" value="Crear" />
      <?php } ?>

      <input type="reset" name="Reset" value="Limpiar" />

      <?php if (($action == 'edit')) { ?>
        <input type="button" onclick="location='questionpapers_form.php';" value="Cancelar" />
      <?php } else { ?>
        <input type="button" onclick="top.frames.location='createexam.php';" value="Cancelar" />
      <?php } ?>
    </p>
  </form>
</body>

</html>