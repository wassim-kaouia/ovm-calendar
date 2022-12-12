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
            <h4 class="mb-sm-0 font-size-18 text-danger">Calendrier Webmaster</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Calendrier</a></li>
                    <li class="breadcrumb-item active">Acceuil</li>
                </ol>
            </div>
        </div>
    </div>
    <div>
    </div>
</div>
<div class="row">
            <div class="col-lg-9">
                <div id="calendar"></div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                      Controle
                    </div>
                    <div class="card-body">
                        <div>
                            <label>RDV Prioritaire : <b class="priorityRDV"></b> </label><br>
                            <label>Date de RDV : <b class="dateRDV"></b> </label><br>
                            <label>Nom d'employé : <b class="nameOfEmployee"></b></label><br>
                            <label>Nom Client : <b class="nameClient"></b></label><br>
                            <label>Telephone Client  : <b class="phoneClient"></b></label><br>
                            <label>Site de Client : <b class="siteClient" id="siteClient"></b></label><br>
                            <label>Description : <p class="description"></p></label><br>
                            <label>Assigné par : <b class="createdBy"></b> </label><br>
                            <label>Assigné à : <b class="assignedTo"></b> </label><br>
                            <label>Role d'employé : <b class="roleEmployee"></b> </label><br>
                            <label>Date de création : <b class="createdAt"></b></label><br><br>
                            <label>Date de Mise à jour : <b class="updatedAt"></b></label><br><br>
                        </div>
                        <form action="{{ route('event-update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="title">Titre:</label>
                                <input id="title" class="form-control" type="text" name="title" value="" placeholder="">
                                <label for="assignedBy">Assigné par:</label>
                                <input class="form-control" type="text" name="assignedBy" value="" id="assignedByInput" disabled>
                                <label for="assignedTo">Assigné à:</label>
                                <select class="form-control" name="assignedTo" id="assignedTo">
                                    <option value="0">Choisisez un utilisateur</option>
                                </select>
                                <label for="title">Date de Rendez-vous:</label>
                                <input class="form-control datepicker" type="text" name="start" id="start" data-provide="datepicker">
                                <label for="title">Coleur de Rendez-vous:</label>
                                <input class="form-control" type="color" name="color" id="color" disabled>
                                <label for="title">Coleur de Texte de Rendez-vous:</label>
                                <input class="form-control" type="color" name="textColor" id="textColor" disabled>
                                <label for="name">Nom Client:</label>
                                <input id="name" class="form-control" type="text" name="name" value="" placeholder="">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description" rows="4" cols="50"></textarea>
                                <label for="statut">Statut:</label>
                                <select id="statut" class="form-control" name="status" id="">
                                    <option value="closed">Fermé</option>
                                    <option value="pending">En cours</option>
                                    <option value="waiting">En attente</option>
                                    <option value="canceled">Annulé</option>
                                </select>
                                <input type="hidden" name="event_id" id="event_id">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" name="priority" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Prioritaire 
                                    </label>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-success" id="updateBtn" data-dismiss="modal">Mettre a jour</button>
                                    </div>
                                    {{-- <div class="col-md-6 col-sm-6">
                                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Supprimer</button>
                                    </div> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('event-post') }}" method="POST">
                    @csrf
                    <div id="modalBody" class="modal-body">
                        <div>
                            <label for="title">Titre: <b class="text-danger" >*</b></label>
                            <input id="title" class="form-control" type="text" name="title" value="" placeholder="">
                            <label for="assignedBy">Assigné par:</label>
                            <input class="form-control" type="text" name="assignedBy" value="{{ Auth::user()->name }}" disabled>
                            <label for="assignedTo">Assigné à:</label>
                            <select class="form-control" name="assignedTo" id="assignedToCreate">
                                <option value="0">Choisisez un utilisateur</option>
                            </select>
                            <label for="siteweb">Site Web:</label>
                            <input class="form-control" type="text" name="siteweb" value="" placeholder="">
                            <label for="start">Date de Rendez-vous: <b class="text-danger" >*</b></label>
                            <input class="form-control datepicker" type="text" name="start" id="start" data-provide="datepicker">
                            <label for="description">Description: <b class="text-danger" >*</b></label>
                            <textarea class="form-control" id="description" name="description" rows="4" cols="50"></textarea>
                            <label for="name_client">Nom De Client: <b class="text-danger" >**</b></label>
                            <input id="name_client" class="form-control" type="text" name="name_client">
                            <label for="phone_client">Telephone Client:</label>
                            <input id="title" class="form-control" type="number" name="phone_client" value="">
                            <label for="statut">Statut:</label>
                            <select id="statut" class="form-control" name="status" id="status">
                                <option value="closed">Fermé</option>
                                <option value="pending">En cours</option>
                                <option value="waiting">En attente</option>
                                <option value="canceled">Annulé</option>
                            </select>
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" name="priority" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  Prioritaire
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" data-dismiss="modal">Créer</button>
                    </div>
                </form>
            </div>
        </div>
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
        //activate fullcalendar and edit its attributes
        var calendar = $('#calendar').fullCalendar({
            editable:true,
            selectable: true,   
            //new lines of code : to block previous days in the past
            selectConstraint: {
            start: moment().format('Y-MM-DD HH:mm'),
            end: '2200-01-01'
            },
            header:{
                left:'prev,next,today',
                center:'title',
                right:'month,agendaWeek,agendaDay',
            },
            events:'{{ route('full.calendar.webmaster') }}',
            selectHelper:false,
            dayClick:function(date,event,view){
                
                var start = $.fullCalendar.formatDate(date,'Y-MM-DD HH:mm');
                var currectDate = moment().format('Y-MM-DD');
                var selectedDay = moment(date).format('Y-MM-DD');
                document.getElementById('start').value = start;
                
                console.log(moment().format('Y-MM-DD'));
                console.log(moment(date).format('Y-MM-DD'));

                if( selectedDay < currectDate ){
                    console.log('clicked on date in the past');
                }else{
                    console.log('good to go !');
                    $('#calendarModal').modal("show");
                    console.log('prompted');
                }
            },
            eventClick:function(event){
                console.log('event opened!'+event.id);
                var dataFromDB;
                $.ajax({       
                    url:'{{ url("/getEventById") }}'+"/"+event.id,
                    type:'GET',
                    success: function(data){
                        $.get('{{ url("/checkVendorUpdatability") }}'+"/"+data.user_id,function(userData,status){
                            console.log('data from api: '+userData);
                            console.log('user id of event: '+data.user_id);
                            if(userData == 'vendorCanUpdate'){
                                $('#updateBtn').attr('disabled',false);
                            }else if(userData == 'vendorCantUpdate'){
                            $('#updateBtn').attr('disabled',true);
                            }else{
                            $('#updateBtn').attr('disabled',false);
                            }
                        });
                        var userid = data.user_id;
                        console.log(data);
                        $('#title').val(data.title);
                        $('#event_id').val(data.id);
                        $('#color').val(data.color);
                        $('#textColor').val(data.textColor);
                        $('#description').val(data.description);
                        $('.description').text(data.description);
                        $('#status').val(data.status);
                        $('#name').val(data.name_client);
                        $('.nameOfEmployee').text(data.user.name);
                        $('.roleEmployee').text(data.user.role);
                        $('.createdBy').text(data.assignedBy);
                        $('.nameClient').text(data.name_client);
                        if(data.priority == '1'){
                            $('.priorityRDV').text('Priotitaire !! 🚨');
                            $('#flexCheckDefault').prop( "checked", true );
                        }else{
                            $('.priorityRDV').text('Non Priotitaire ⏰');
                        }
                        $('.phoneClient').text(data.phone_client);
                        $('#assignedByInput').val(data.assignedBy);
                        $.get('{{ url("/getAssignedToName") }}'+"/"+data.user_id,function(newData,status){
                            console.log('hey:'+newData);
                            console.log(data.assignedBy == newData);
                            $('.assignedTo').text(newData);
                            // if(data.assignedBy != newData){
                            //     $('#updateBtn').attr('disabled',true);
                            // }
                        });
                        $('.createdAt').text(moment(data.created_at).format('Y-MM-DD HH:mm'));
                        $('.updatedAt').text(moment(data.updated_at).format('Y-MM-DD HH:mm'));
                        $('#start').val( $.fullCalendar.formatDate(event.start,'Y-MM-DD HH:mm'));
                        $('.dateRDV').text( $.fullCalendar.formatDate(event.start,'Y-MM-DD HH:mm'));
                        $('.siteClient').text(data.siteweb);
                    },
                    error:function(error){
                        console.log(error);
                    },
                }
                );
            },
        });
        $(".datepicker").flatpickr({
            disable: ['2022-12-24','2022-12-25','2022-12-26','2022-12-27','2022-12-28','2022-12-29','2022-12-30','2022-12-31','2023-01-01'], 
            //set past dates disabled
            minDate: "today",
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
        $.get("{{ route('get-users')}}",function(data,status){
                console.log(data);
                data.forEach(element => {
                    console.log(element.id);
                    $('#assignedTo').append(new Option(element.name, element.id));
                    $('#assignedToCreate').append(new Option(element.name, element.id));
                });
        });
    });
</script>
@endsection