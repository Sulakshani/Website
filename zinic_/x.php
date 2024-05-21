<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="bootstrap.css">
    <style>
  div {
    display: none;
    width: 100px;
    height: 100px;
    background: #ccc;
    border: 1px solid #000;
  }
  </style>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
<button>show the div</button>
<div></div>
 
<script>
$( "button" ).click(function() {
  $( "div" ).show( "fold", 1000 );
});
</script>
<!-- <script src="jQuery 3.6.1.js"></script> -->
</body>

</html>