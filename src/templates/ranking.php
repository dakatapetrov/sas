<?php
function generateOptions($options, $selectedOption) {
    echo "<option value=\"0\">---</option>";
    foreach ($options as $key => $option) {
        if ($option == $selectedOption) {
            echo "<option value=\"$key\" selected=\"selected\">" . $option . "</option>";
        } else {
            echo "<option value=\"$key\">" . $option . "</option>";
        }
    }
}
?>

<h1>Вашата класация, господарю!</h1>

<form name="search" action="/sas/ranking" method="POST">
<img src="/sas/src/public/img/glyphicons/glyphicons_263_bank.png">
Випуск:
<select name="class">
<?php
generateOptions($locals['classes'], $locals['selectedClass']);
?>
</select>
<img src="/sas/src/public/img/glyphicons/glyphicons_030_pencil.png">
Специалност:
<select name="speciality">
<?php
generateOptions($locals['specialities'], $locals['selectedSpeciality']);
?>
</select>
<img src="/sas/src/public/img/glyphicons/glyphicons_045_calendar.png">
Период:
<select name="interval">
    <option value="0">---</option>
    <option value="day">За деня</option>
    <option value="week">За седмицата</option>
    <option value="month">За месеца</option>
<?php
/* generateOptions($locals['intervals'], $locals['selectedIntervals']); */
?>
</select>
<input type="submit" value="Покажи">
</form>

<table id="ranking">
  <tr>
    <th>№</th>
    <th>Име</th>
    <th>Факултетен номер</th>
    <th>Точки</th>
  </tr>
<?php
if (isset($locals['students'])) {
  foreach ($locals['students'] as $key => $student) {
    echo "<tr>";
    /* if ($key + 1 == 1) { */
    /*     echo "<td>" . ($key+1) . "<img src=\"/sas/src/public/img/glyphicons/glyphicons_049_star.png\"></td>"; */
    /* } else { */
    echo "<td>" . ($key+1) . "</td>";
    /* } */
    echo "<td>" .
      "<img src=\"/sas/src/public/img/glyphicons/glyphicons_223_chevron-down.png\" class=\"expandable\"><a href='/sas/user/" . $student['id'] . "'>".
      $student['name'] .
      "</a></td>";
    echo "<td>" . $student['fn'] . "</td>";
    echo "<td>" . $student['points'] . "</td>";
    echo "</tr>";
    echo "<tr class=\"info\">";
    echo "<td></td>";
    echo "<td colspan=\"3\">";
    echo "<p>" . $student['name'] . ' - спец. ' . $student['speciality'] . ', поток ' .
         $student['flow'] . ', група ' . $student['group'] . ', випуск ' . $student['class'] . "</p>";

    $place = $locals['results'][$student['id']]['class'];
    echo "<p>На " . ($place['before'] + 1) . " място във випуска от общо " .$place['all'] . " студенти.</p>";
    $place = $locals['results'][$student['id']]['flow'];
    echo "<p>На " . ($place['before'] + 1) . " място в потока от общо " .$place['all'] . " студенти.</p>";


    echo "</td>";
    echo "</tr>";
  }
}
?>
  <tr>
</table>
