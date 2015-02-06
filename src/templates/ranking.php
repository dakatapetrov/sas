<?php
function generateOptions($options, $selectedOption) {
    foreach ($options as $option) {
        if ($option == $selectedOption) {
            echo "<option selected=\"selected\">" . $option . "</option>";
        } else {
            echo "<option>" . $option . "</option>";
        }
    }
}
?>

<h1>Your rankings, sir!</h1>

<form name="search" action="">
<img src="/sas/src/public/img/glyphicons/glyphicons_263_bank.png">
Випуск:
<select name="class">
<?php
generateOptions($locals['classes'], $locals['selectedClass']);
?>
</select>
<img src="/sas/src/public/img/glyphicons/glyphicons_030_pencil.png">
Специалност:
<select name="specialities">
<?php
generateOptions($locals['specialities'], $locals['selectedSpeciality']);
?>
</select>
<img src="/sas/src/public/img/glyphicons/glyphicons_045_calendar.png">
Период:
<select name="interval">
<?php
generateOptions($locals['intervals'], $locals['selectedIntervals']);
?>
</select>
<input type="submit" value="Submit">
</form>

<table id="ranking">
  <tr>
    <th>№</th>
    <th>Име</th>
    <th>Факултетен номер</th>
    <th>Точки</th>
  </tr>
<?php
foreach ($locals['students'] as $key => $student) {
    echo "<tr>";
    echo "<td>" . ($key+1) . "</td>";
    echo "<td>" . "" . "</td>";
    echo "<td>" . "" . "</td>";
    echo "<td>" . "" . "</td>";
    echo "</tr>";
    echo "<tr class=\"hidden\">";
    echo "<td collspan=\"4\">" . "He's tyhe ebst" . "</td>";
    echo "</tr>";
}
?>
  <tr>
</table>
