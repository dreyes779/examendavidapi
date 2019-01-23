@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="panel-body">
                <div class="panel-body"></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>cfcf
                    @endif

                    <div id="crud" class="row" v-cloak>
                        <div class="col-sm-12">
                        
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th colspan="2">
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="datos in keeps">
                                        <td width="10px"> @{{ datos.id }}</td>
                                        <td> @{{ datos.nombre }}</td>
                                        <td width="10px"> @{{ datos.email }} </td>
                                        <td> </td>
                                        <td width="10px">
                                            <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editKeep(datos)">Visualizar</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                           
                            

    @include('usuario.edit')
</div>
{{--     <div class="col-sm-5">
    <pre>
        @{{ $data }}
    </pre>
</div> --}}
</div>

</div>
</div>
</div>
</div>
</div>
@endsection
@push('scripts')

@endpush
