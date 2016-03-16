<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link rel="stylesheet" href="/css/ethna.css" type="text/css" /> -->
<link rel="stylesheet" href="/css/test.css" type="text/css" />
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<title>Sample</title>
</head>
<body>

<nav class="navbar navbar-inverse">
<div class="container-fluid">
<div class="navbar-header"><a class="navbar-brand">
TEST HOMEPAGE     Powered By Ethnam - {$smarty.const.ETHNA_VERSION}.</a></div>
<ul class="nav navbar-nav"><li><a href="/">HOME</a></li></ul>
</div>
</nav>
<!--
<div id="header">
    <h1>Sample</h1>
</div>

<div id="main">
-->
<div class="container">
<div class="panel-panel-default">
{$content}
</div>
</div>

</body>
</html>
