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
Випуск:
<select name="class">
<?php
generateOptions($locals['classes'], $locals['selectedClass']);
?>
</select>
Специалност:
<select name="specialities">
<?php
generateOptions($locals['specialities'], $locals['selectedSpeciality']);
?>
</select>
Период:
<select name="interval">
<?php
generateOptions($locals['intervals'], $locals['selectedIntervals']);
?>
</select>
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
