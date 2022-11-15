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
            <h4 class="mb-sm-0 font-size-18">Detail Sur Les changements</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Detail Sur Les changements</a></li>
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
                <h5 class="fw-semibold">DETAIL </h5>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="col">Nom Complet</th>
                                <td scope="col">{{ $log->getCauser($log->causer_id)->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">ID Utilisateur</th>
                                <td>{{$log->getCauser($log->causer_id)->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>{{ $log->getCauser($log->causer_id)->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Role du Modificateur</th>
                                <td>
                                    @if ($log->getCauser($log->causer_id)->role == 'vendor')
                                    <span class="badge badge-soft-danger">Vendeur</span>
                                    @endif

                                    @if ($log->getCauser($log->causer_id)->role == 'admin')
                                    <span class="badge badge-soft-success">Administrateur</span>
                                    @endif

                                    @if ($log->getCauser($log->causer_id)->role == 'assistant')
                                    <span class="badge badge-soft-primary">Assistance</span>
                                    @endif

                                    @if ($log->getCauser($log->causer_id)->role == 'superviseur')
                                    <span class="badge badge-soft-primary">Superviseur</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Date de creation de L'historique</th>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Date de Modification</th>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Module Modifié</th>
                                <td>
                                    @if ($log->subject_type == 'App\Models\User')
                                        Utilisateur
                                    @endif
                                    @if ($log->subject_type == 'App\Models\Event')
                                        Calendrier
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Type de Modification</th>
                                <td>{{ $log->description }}</td>
                            </tr>
                            <tr>
                                <?php $myarray = json_decode($log->properties,true); 
                                ?>
                                <th scope="row">Propriétés modifiées (Nouvelle Informations) :</th>
                            </tr>
                            @if ($log->subject_type == 'App\Models\User')
                            <tr>
                                <th scope="row">ID</th>
                                <td>{{ $myarray['attributes']['id'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nom</th>
                                <td>{{ $myarray['attributes']['name'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>{{ $myarray['attributes']['email'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Mot de Passe</th>
                                <td>{{ $myarray['attributes']['password'] == $myarray['old']['password'] ? 'Mot de passe non changé '.$myarray['attributes']['created_at'] 
                                : 'Mot de passe changé le '. date('d-M-Y   h:i:s', strtotime($myarray['attributes']['created_at'])). ' par : '.$log->getCauser($log->causer_id)->name }}
                                </td> 
                            </tr>
                            <tr>
                                <th scope="row">Couleur</th>
                                <td><input type="color" name="color" id="color" value="{{ $myarray['attributes']['color'] }}" disabled></td>
                            </tr>
                            <tr>
                                <th scope="row">Texte Coleur</th>
                                <td><input type="color" name="textColor" id="textColor" value="{{ $myarray['attributes']['textColor'] }}" disabled></td>
                            </tr>
                            <tr>
                                <th scope="row">Role</th>
                                <td>
                                    @if ( $myarray['attributes']['role'] == 'vendor')
                                        Vendeur
                                    @endif
                                    @if ( $myarray['attributes']['role'] == 'admin')
                                        Administrateur
                                    @endif
                                    @if ( $myarray['attributes']['role'] == 'assistant')
                                        Assistant(e)
                                    @endif
                                    @if ( $myarray['attributes']['role'] == 'superviseur')
                                        Superviseur
                                    @endif
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <?php $myarray = json_decode($log->properties,true); 
                                ?>
                                <th scope="row">Propriétés modifiées (Anciennes informations) :</th>
                            </tr>
                            @if ($log->subject_type == 'App\Models\User')
                            <tr>
                                <th scope="row">ID</th>
                                <td>{{ $myarray['old']['id'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nom</th>
                                <td>{{ $myarray['old']['name'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>{{ $myarray['old']['email'] }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Mot de Passe</th>
                                <td>{{ $myarray['attributes']['password'] == $myarray['old']['password'] ? 'Mot de passe non changé '.date('d-M-Y   h:i:s', strtotime($myarray['old']['created_at'])). ' par : '.$log->getCauser($log->causer_id)->name
                                : 'Mot de passe changé le '. date('d-M-Y   h:i:s', strtotime($myarray['old']['created_at'])). ' par : '.$log->getCauser($log->causer_id)->name }}
                                </td> 
                            </tr>
                            <tr>
                                <th scope="row">Couleur</th>
                                <td><input type="color" name="color" id="color" value="{{ $myarray['old']['color'] }}" disabled></td>
                            </tr>
                            <tr>
                                <th scope="row">Texte Coleur</th>
                                <td><input type="color" name="textColor" id="textColor" value="{{ $myarray['old']['textColor'] }}" disabled></td>
                            </tr>
                            <tr>
                                <th scope="row">Role</th>
                                <td>
                                    @if ( $myarray['old']['role'] == 'vendor')
                                        Vendeur
                                    @endif
                                    @if ( $myarray['old']['role'] == 'admin')
                                        Administrateur
                                    @endif
                                    @if ( $myarray['old']['role'] == 'assistant')
                                        Assistant(e)
                                    @endif
                                    @if ( $myarray['old']['role'] == 'superviseur')
                                        Superviseur
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @if ($log->subject_type == 'App\Models\Event')
                           <tr>
                            <?php $myarray = json_decode($log->properties,true); 
                            ?>
                            <th scope="row">Propriétés modifiées (Nouvelle Informations) :</th>
                        </tr>
                        @if ($log->subject_type == 'App\Models\User')
                        <tr>
                            <th scope="row">ID</th>
                            <td>{{ $myarray['attributes']['id'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nom</th>
                            <td>{{ $myarray['attributes']['name'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $myarray['attributes']['email'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Mot de Passe</th>
                            <td>{{ $myarray['attributes']['password'] == $myarray['old']['password'] ? 'Mot de passe non changé '.$myarray['attributes']['created_at'] 
                            : 'Mot de passe changé le '. date('d-M-Y   h:i:s', strtotime($myarray['attributes']['created_at'])). ' par : '.$log->getCauser($log->causer_id)->name }}
                            </td> 
                        </tr>
                        <tr>
                            <th scope="row">Couleur</th>
                            <td><input type="color" name="color" id="color" value="{{ $myarray['attributes']['color'] }}" disabled></td>
                        </tr>
                        <tr>
                            <th scope="row">Texte Coleur</th>
                            <td><input type="color" name="textColor" id="textColor" value="{{ $myarray['attributes']['textColor'] }}" disabled></td>
                        </tr>
                        <tr>
                            <th scope="row">Role</th>
                            <td>
                                @if ( $myarray['attributes']['role'] == 'vendor')
                                    Vendeur
                                @endif
                                @if ( $myarray['attributes']['role'] == 'admin')
                                    Administrateur
                                @endif
                                @if ( $myarray['attributes']['role'] == 'assistant')
                                    Assistant(e)
                                @endif
                                @if ( $myarray['attributes']['role'] == 'superviseur')
                                    Superviseur
                                @endif
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <?php $myarray = json_decode($log->properties,true); 
                            ?>
                            <th scope="row">Propriétés modifiées (Anciennes informations) :</th>
                        </tr>
                        @if ($log->subject_type == 'App\Models\User')
                        <tr>
                            <th scope="row">ID</th>
                            <td>{{ $myarray['old']['id'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nom</th>
                            <td>{{ $myarray['old']['name'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $myarray['old']['email'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Mot de Passe</th>
                            <td>{{ $myarray['attributes']['password'] == $myarray['old']['password'] ? 'Mot de passe non changé '.date('d-M-Y   h:i:s', strtotime($myarray['old']['created_at'])). ' par : '.$log->getCauser($log->causer_id)->name
                            : 'Mot de passe changé le '. date('d-M-Y   h:i:s', strtotime($myarray['old']['created_at'])). ' par : '.$log->getCauser($log->causer_id)->name }}
                            </td> 
                        </tr>
                        <tr>
                            <th scope="row">Couleur</th>
                            <td><input type="color" name="color" id="color" value="{{ $myarray['old']['color'] }}" disabled></td>
                        </tr>
                        <tr>
                            <th scope="row">Texte Coleur</th>
                            <td><input type="color" name="textColor" id="textColor" value="{{ $myarray['old']['textColor'] }}" disabled></td>
                        </tr>
                        <tr>
                            <th scope="row">Role</th>
                            <td>
                                @if ( $myarray['old']['role'] == 'vendor')
                                    Vendeur
                                @endif
                                @if ( $myarray['old']['role'] == 'admin')
                                    Administrateur
                                @endif
                                @if ( $myarray['old']['role'] == 'assistant')
                                    Assistant(e)
                                @endif
                                @if ( $myarray['old']['role'] == 'superviseur')
                                    Superviseur
                                @endif
                            </td>
                        </tr>
                        @endif
                           @endif
                        </tbody>
                    </table>
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