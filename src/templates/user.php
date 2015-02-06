<h1>Потребител</h1>
<h2>Име: [@firstName] [@lastName]</h2>

<table id="achievements">
  <tr>
    <th>Дата</th>
    <th>Описание</th>
    <th>Точки</th>
  </tr>
<?php
foreach ($locals['achievements'] as $achievement) {
    echo "<tr>";
    echo "<td>" . $achievement['date'] . "</td>";
    echo "<td>" . $achievement['name'] . "</td>";
    echo "<td>" . $achievement['points'] . "</td>";
    echo "</tr>";
}
?>
  <tr>
</table>
