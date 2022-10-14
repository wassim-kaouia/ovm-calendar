@extends('layout.master')

@section('jscss-urls')
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/fr.js"></script>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" defer></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" defer crossorigin="anonymous"></script> --}}
<script src="https://npmcdn.com/flatpickr@4.6.13/dist/l10n/fr.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>

@endsection

@section('content')
<div class="container">

    <div id="calendar"></div>
</div>


<div id="calendarModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('event-post') }}" method="POST">
                @csrf
                <div id="modalBody" class="modal-body">
                    <div>
                        <label for="title">Titre:</label>
                        <input id="title" class="form-control" type="text" name="title" value="" placeholder="">
                        <label for="title">Assigné par:</label>
                        <input class="form-control" type="text" name="assignedBy" value="" placeholder="">
                        <label for="title">Date de Rendez-vous:</label>
                        <input class="form-control datepicker" type="text" name="rdv" data-provide="datepicker">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="4" cols="50"></textarea>
                        <label for="statut">Statut:</label>
                        <select id="statut" class="form-control" name="" id="">
                            <option value="closed">Fermé</option>
                            <option value="pending">En cours</option>
                            <option value="waiting">En attente</option>
                            <option value="canceled">Annulé</option>
                        </select>
                        <label for="description">Accès:</label>
                        <select class="form-control" name="" id="">
                            <option value="public">Public</option>
                            <option value="readonly">Lecture seulement</option>
                            <option value="private">Privé</option>
                        </select>
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Prioritaire
                            </label>
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Créer</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('js')
    <script>
        
        $(document).ready(function(){
            $.ajaxSetup(
                {
                    headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
                }
            );
            //activate fullcalendar and edit its attributes
            var calendar = $('#calendar').fullCalendar({
                locale: 'pt',
                editable:true,
                header:{
                    left:'prev,next,today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay',
                },

                events:'/calendar',
                selectHelper:false,
                dayClick:function(rdv,allDay){
                    console.log('clicked');
                    var rdv = $.fullCalendar.formatDate(rdv,'Y-MM-DD HH:mm:ss');
                    $('#calendarModal').modal("show");
                    console.log();
                },
            });

            $(".datepicker").flatpickr({
                locale:{
                    firstDayOfWeek: 1,
                    weekdays: {
                    shorthand: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                    longhand: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],         
                }, 
                    months: {
                    shorthand: ['Jan', 'Fev', 'Маr', 'Аvr', 'Мai', 'Jui', 'Jul', 'Aou', 'Sep', 'Оct', 'Nov', 'Dec'],
                    longhand: ['Janvier', 'Fevrier', 'Mars', 'Аvril', 'Маi', 'Juin', 'Juillet', 'Аout', 'Septembre', 'Оctobre', 'Novembre', 'Decembre'],
                },
                },
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
            });

        });

    </script>
@endsection