<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GIS Astra</title>
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    
    
    
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
            <link rel="stylesheet" href="{{asset('css/side-menu.css')}}">
        <!--<![endif]-->
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




<script src="{{asset('js/ui.js')}}"></script>

</body>
</html>