<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GIS Astra</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    
    
     <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        @stack('scripts')
</head>
<body>






@yield('content')





</body>
</html>