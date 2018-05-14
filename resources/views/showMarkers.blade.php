<link rel="stylesheet" type="text/css" href="{{ asset('css/leaflet.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
<script type="text/javascript" src="{{asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/leaflet.js') }}"></script>
<script type="text/javascript" src="{{asset('js/angular.min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/show-markers.js') }}"></script>
<script type="text/javascript" src="{{asset('js/leaflet.geometryutil.js') }}"></script>

<div ng-app="app">
        <div ng-controller="TableController">
            <div id="map" data-coordinates="{{ json_encode($coordinates) }}" class="panel panel-default panel-success">
            </div>
          </div>
</div>
