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
            <h4 class="mb-sm-0 font-size-18">Modifier l'utilisateur</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Modifier l'utilisateur</a></li>
                    <li class="breadcrumb-item active">Acceuil</li>
                </ol>
            </div>
        </div>
    </div>
    <div>
        
    </div>
</div>

<div class="row">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Modifier un utilisateur</h4>

            <form method="POST" action="{{ route('users-update') }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">Nom Complet</label>
                    <input type="text" class="form-control" id="formrow-firstname-input" name="name" placeholder="Entrer Le Nom Complet" value="{{ $user->name }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="formrow-email-input" class="form-label">Email</label>
                            <input type="email" class="form-control" id="formrow-email-input" name="email" placeholder="Enter Your Email ID" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="formrow-password-input" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="formrow-password-input" name="password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="color" class="form-label">Couleur de RDV</label>
                            <input type="color" name="color" id="color" value="{{ $user->color }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-6">
                            <label for="textColor" class="form-label">Couleur de Texte sur RDV</label>
                            <input type="color" name="textColor" id="textColor" value="{{ $user->textColor }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-6">
                            <label for="role" class="form-label">Role</label>
                            <input type="hidden" value="{{ Auth::user()->role == 'admin' ? 'admin' : '' }}" name="role" >
                            <select name="role" id="role" class="form-control" {{ $user->role == 'admin' ? 'disabled' : '' }}>
                                <option {{$user->role == 'admin' ? 'selected' : ''}} value="admin">Administrateur</option>
                                <option {{$user->role == 'vendeur' ? 'selected' : ''}} value="vendeur">Vendeur</option>
                                <option {{$user->role == 'assistant' ? 'selected' : ''}} value="assistant">Assistant(e)</option>
                                <option {{$user->role == 'superviseur' ? 'selected' : ''}} value="superviseur">Superviseur</option>
                                <option {{$user->role == 'webmaster' ? 'selected' : ''}} value="webmaster">Webmaster</option>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-md">Modifier</button>
                </div>
            </form>
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>
<!-- end row -->
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