    <html>
    <head>
        <title>locatie</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type="text/javascript" src="{{asset('js/jquery-min.js')}}"></script>
    </head>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <p id="demo">Druk op de knop om uw locatie door te geven</p>
            <button onclick="getLocation()">Locatie doorgeven</button>
        </div>
    </div>
    <script type="text/javascript">
        var id = "{{$id}}";
    </script>
<script type="text/javascript" src="{{asset('js/locate.js')}}"></script>
    </body>
    </html>