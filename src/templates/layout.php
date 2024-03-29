<!DOCTYPE html>
<html>
<head>
    <title>Students Achievements System</title>
    <meta charset='utf-8'>

    <link rel="stylesheet" type="text/css" href="/sas/src/public/css/style.css" />
</head>

<body>
    <div id="header">
      <ul class="nav-fade">
      <li><a href="/sas/ranking"><img src="/sas/src/public/img/glyphicons/glyphicons_043_group_white.png">Класация</a></li>
      <li><a href=""><img src="/sas/src/public/img/glyphicons/glyphicons_041_charts_white.png">Сравни</a></li>
<?php
if (isset( $_SESSION['userId'])) {
  $id = $_SESSION['userId'];
  echo '<li><a href="/sas/user/' . $id . '"><img src="/sas/src/public/img/glyphicons/glyphicons_003_user_white.png">Профил</a></li>';
  echo '<li><a href="/sas/logout"><img src="/sas/src/public/img/glyphicons/glyphicons_063_power_white.png">Изход</a></li>';
} else {
  echo '<li><a href="/sas/login"><img src="/sas/src/public/img/glyphicons/glyphicons_044_keys_white.png">Влез</a></li>';
}
?>
      </ul>
    </div>

    <div id="content">
        [@content]
    </div>

    <div id="footer">
    </div>

    <script src="/sas/src/public/js/jquery-1.11.2.min.js"></script>
    <script src="/sas/src/public/js/custom.js"></script>
</body>
</html>
