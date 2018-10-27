<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/main.min.css">
    <link rel="stylesheet" href="https://code.cdn.mozilla.net/fonts/fira.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src='/script/main.min.js' async></script>
</head>

<body onload="load(window.location.hash.substr(1))">
    <nav class="sidenav" id="sidenav">
        <button class="button" onclick="hide()"><img src='/icon/close.svg'> Close</button>
        <a href="/">Home</a>
        <hr>
<?php
  foreach ( glob("content/*.json") as $filename )
  {
    $x = explode('/', $filename);
    $name = explode('.', $x[sizeof($x)-1])[0];
    printf('<a href="#%s" onclick="load(\'%s\')">%s</a>',$name, $name, ucfirst($name));
  }
?>
    </nav>

    <main>
        <button class="button open" onclick="show()"><img src='/icon/menu.svg'></button>
        <div id='content' class="content"></div>
    </main>
</body>
</html>