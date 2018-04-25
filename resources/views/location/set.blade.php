    <html>
    <head>
        <title>locatie</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type="text/javascript" src="{{asset('js/jquery-min.js')}}"></script>
    </head>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <p id="demo">Click the button to get your coordinates.</p>
            <button onclick="getLocation()">Try It</button>
        </div>
    </div>
    <script type="text/javascript">
        var id = "{{$id}}";
    </script>
<script type="text/javascript" src="{{asset('js/locate.js')}}"></script>
    </body>
    </html>