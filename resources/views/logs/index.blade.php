@extends('layout.masterV2')

@section('mycss')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/fr.js"></script>
<script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/fr.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
@endsection
@section('mytitle')
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Historiques De L'application</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Historiques De L'application</a></li>
                    <li class="breadcrumb-item active">Acceuil</li>
                </ol>
            </div>
        </div>
    </div>
    <div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <h4 class="card-title">Tous les movement des Utilisateurs seront enregistres</h4>                    
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom du modificateur</th>
                                    <th>Module Modifier</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                <tr>
                                    <?php $causerId = $log->id; ?>
                                    <th scope="row">{{ $log->id }}</th>
                                    <td>{{ $log->getCauser($log->causer_id)->name }}</td>
                                    <td>
                                        @if ($log->subject_type == 'App\Models\User')
                                            Utilisateur
                                        @endif
                                        @if ($log->subject_type == 'App\Models\Event')
                                            Calendrier
                                        @endif
                                    </td>
                                    <td>{{ $log->description }}</td>
                                    <td>
                                        <form action="{{ route('logs.show',['id' => $log->id]) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-light btn-sm">Regarder en détail</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end col-->
@endsection
@section('myjs')
<script>
    $(document).ready(function(){
        $.ajaxSetup(
            {
                headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
            }
        );
    });
</script>
@endsection