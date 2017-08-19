<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>hello-vue</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <style type="text/css">body{overflow-x:hidden}main{min-height:83.1vh;padding-bottom:3rem}footer,header,main{padding-left:240px}@media only screen and (max-width:992px){footer,header,main{padding-left:0}}h4{margin-top:6rem}</style>
  </head>
  <body>
    <div id="app"></div>
    <script src="{{ mix('/js/app.js') }}"></script>
    
  </body>
</html>
