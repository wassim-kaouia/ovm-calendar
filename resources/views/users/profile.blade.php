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
            <h4 class="mb-sm-0 font-size-18">Modification de profile</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Modification de profile</a></li>
                    <li class="breadcrumb-item active">Acceuil</li>
                </ol>
            </div>
        </div>
    </div>
    <div>
        
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile</h4>
                <br>
                <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Nom Complet</label>
                        <div class="col-md-10">
                            <input class="form-control" name="name" type="text" value="{{ $profile->name }}"
                                id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-search-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input class="form-control" type="search" name="email" value="{{ $profile->email }}"
                                id="example-search-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-password-input" class="col-md-2 col-form-label">Password</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" name="password" placeholder="Tapez votre noveau mot de passe"
                                id="example-password-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-password-input" class="col-md-2 col-form-label">Confirmation Password</label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirmez votre mot de passe"
                            id="example-password-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-color-input" class="col-md-2 col-form-label">Couleur</label>
                        <div class="col-md-10">
                            <input class="form-control form-control-color mw-100" disabled value="{{ $profile->color }}" name="color" type="color"
                                id="example-color-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-color-input" class="col-md-2 col-form-label" >Texte Couleur</label>
                        <div class="col-md-10">
                            <input class="form-control form-control-color mw-100" disabled name="textColor" type="color" value="{{ $profile->textColor }}"
                                id="example-color-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-color-input" class="col-md-2 col-form-label">Avatar</label>
                        <div class="col-md-10">
                          <input class="form-control" id="formFileSm" type="file" name="avatar">     
                          <div class="mt-4">
                            <p>{{ Auth::user()->avatar == 'avatar/default/avatar.png' ? asset(Auth::user()->avatar) : URL('storage/'.Auth::user()->avatar) }}</p>
                            <img width="100" src="{{ Auth::user()->avatar == 'avatar/default/avatar.png' ? asset(Auth::user()->avatar) : URL('storage/'.Auth::user()->avatar) }}" alt="Avatar de profile">
                          </div>             
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-color-input" class="col-md-2 col-form-label"></label>
                        <div class="col-md-10">
                            <input type="hidden" value="{{ $profile->id }}" name="user_id">
                            <button type="submit" class="btn btn-primary w-md">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection
@section('myjs')
<script src="assets/js/app.js"></script>  

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