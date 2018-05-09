<link rel="stylesheet" href="{!!asset('css/leaflet.css')!!}"/>
<link rel="stylesheet" href="{!!asset('css/bootstrap.min.css')!!}">
<link rel="stylesheet" type="text/css" href="{!!asset('css/style.css')!!}">
<script src="{!!asset('js/jquery.min.js')!!}"></script>
<script type="text/javascript" src="{!!asset('js/bootstrap.min.js')!!}"></script>
<script src="{!!asset('js/leaflet.js')!!}"></script>
<script src = "{!!asset('js/angular.min.js')!!}"></script>
<script src = "{!!asset('js/table-directive.js')!!}"></script>
<div ng-app="app">
        <div ng-controller="TableController">
            <div id="map" data-coordinates="{{ json_encode($coordinates) }}" class="panel panel-default panel-success">
            </div>
          </div>
</div>
