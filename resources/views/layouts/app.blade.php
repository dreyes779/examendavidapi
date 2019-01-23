<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style type="text/css">
        [v-cloak]{
            display: none;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7st8c06ULBiLYRTyXyMyHBWHo4gK3yA8&libraries=places" type="text/javascript" ></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Registrar</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="http://code.jquery.com/jquery-1.7.1.js" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
      
    new Vue({
    el: '#crud',
    created: function() {
        this.getKeeps();
    },
    data: {
        keeps: [],
        
        newKeep:  {'id': '', 'nombre': '', 'email': '', 'puesto': '', 'fecha_nacimiento': '', 'domicilio': ''},
        fillKeep: {'id': '', 'nombre': '', 'email': '', 'puesto': '', 'fecha_nacimiento': '', 'domicilio': ''},
        newRow:  {'id': '', 'habilidades': ''},
        fillRow: {'id': '', 'habilidades': ''},
        habilidades: '',
        rows: [],
        newClient: {'nombre': '', 'departamento': '', 'telefono': '', 'email': '', 'nombre_comercial': '', 'razon_social': '', 'rfc_receptor': '','calle': '', 'colonia': '', 'municipio': '', 'cp': '', 'edo': '', 'giro': ''},
        fillClient: {'nombre': '', 'departamento': '', 'telefono': '', 'email': '', 'nombre_comercial': '', 'razon_social': '', 'rfc_receptor': '','calle': '', 'colonia': '', 'municipio': '', 'cp': '', 'edo': '', 'giro': ''},
        apiC: {'nomapi': '', 'corrapi': ''},
        apiLim: {'nomapi': '', 'corrapi': ''},
        errors: {'rfc': '', 'correo': '', 'razon_social': ''},
        //errors: {},
        offset: 3,
    },
    
    methods: {
        getKeeps: function() {
            var urlKeeps = 'http://localhost/ExamenDavid/api/empleados/';
            axios.get(urlKeeps).then(response => {
                this.keeps = response.data,
                console.log(response.data);
            });
        },
        editKeep: function(datos) {

            this.fillKeep.id        = datos.id;
            this.fillKeep.nombre    = datos.nombre;
            this.fillKeep.email     = datos.email;
            this.fillKeep.puesto    = datos.puesto;
            this.fillKeep.fecha_nacimiento  = datos.fecha_nacimiento;
            this.fillKeep.domicilio  = datos.domicilio;
            $('#edit').modal('show');
        },
            
        deleteKeep: function(datos) {
            var url = 'tasks/' + datos.id;
            axios.delete(url).then(response => { //eliminamos
                this.getKeeps(); //listamos
                toastr.success('Eliminado correctamente'); //mensaje
            });
        },    
        

    }
});
</script>
 <script>
    var geocoder = new google.maps.Geocoder();
    var marker = null;
    var map = null;
    function initialize() {
      var $latitude = document.getElementById('latitude');
      var $longitude = document.getElementById('longitude');
      var latitude = 19.4326077
      var longitude = -99.13320799999997;
      var zoom = 16;

      var LatLng = new google.maps.LatLng(latitude, longitude);

      var mapOptions = {
        zoom: zoom,
        center: LatLng,
        panControl: false,
        zoomControl: true,
        scaleControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }

      map = new google.maps.Map(document.getElementById('map'), mapOptions);
      if (marker && marker.getMap) marker.setMap(map);
      marker = new google.maps.Marker({
        position: LatLng,
        map: map,
        title: 'Arrástrame!',
        draggable: true
      });

      google.maps.event.addListener(marker, 'dragend', function(marker) {
        var latLng = marker.latLng;
        $latitude.value = latLng.lat();
        $longitude.value = latLng.lng();
      });


    }
    initialize();
    $('#findbutton').click(function (e) {
      var address = $("#Postcode").val();
      geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
          marker.setPosition(results[0].geometry.location);
          $(latitude).val(marker.getPosition().lat());
          $(longitude).val(marker.getPosition().lng());
        } else {
          alert("El geocódigo no tuvo éxito por la siguiente razón:" + status);
        }
      });
      e.preventDefault();
    });
  </script>
</body>
</html>
