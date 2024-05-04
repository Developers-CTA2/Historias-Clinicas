@extends('admin.layouts.main')

@section('title', 'Citas')

@section('viteConfig')
@vite(['resources/sass/sideBar.scss','resources/sass/loadingScreen.scss', 'resources/sass/StyleForm.scss','resources/sass/colorButtons.scss', 'resources/sass/bar.scss','resources/js/app.js'])
@endsection

<!-- Esto no se que hace pero lo puse jsjsjsj -->
@section('breadCrumb')
<nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Agenda</li>
    </ol>
</nav>
@endsection



@section('content')
<div id="calendar"></div>

    <!-- Modal -->
    <div class="modal fade" id="horaModal" tabindex="-1" aria-labelledby="horaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="horaModalLabel">Horas Disponibles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="horasDisponibles"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@vite(['resources/js/loading-screen.js','resources/js/SideBar.js', 'resources/js/agenda.js'])

@endsection