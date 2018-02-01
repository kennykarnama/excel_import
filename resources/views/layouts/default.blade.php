<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GIS Astra</title>
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
            <link rel="stylesheet" href="{{asset('css/side-menu.css')}}">
        <!--<![endif]-->
        <link rel="stylesheet" type="text/css" href="{{asset('css/pure-extras.css')}}">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        @stack('scripts')
</head>
<body>






<div id="layout">

    @include('includes.menu')
   

    <div id="main">

        @include('includes.header')

        @yield('content')
      
    </div>
</div>

<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>

<div class="content w3-container" id="map" style="display: none;">
    
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDct4JdjooCrU0Cb9-KwJyW9_sZ2bv7gHo"
    async defer></script>   


<script src="{{asset('js/ui.js')}}"></script>

</body>
</html>