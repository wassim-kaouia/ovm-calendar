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
            <h4 class="mb-sm-0 font-size-18">Gestion des Utilisateurs</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Gestion des Utilisateurs</a></li>
                    <li class="breadcrumb-item active">Acceuil</li>
                </ol>
            </div>
        </div>
    </div>
    <div>
    </div>
</div>
<div class="row">
  @foreach ($users as $user)
  <div class="col-xl-3 col-sm-6">
    <div class="card text-center" >
        <div class="card-body" style="position: relative">
            <div style="position: absolute; right: 20px; top:20px">
                @if ($user->role != 'admin')
                <form action="{{ route('user-delete',['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn" type="submit"  style="font-size: 30px;"><i class="bx bxs-trash" style="color:rgb(247, 81, 81)"></i></button>
                </form>
                @endif
            </div>
            <div class="mb-4">
                {{-- <img class="rounded-circle avatar-sm" src="{{ URL('storage/'.$user->avatar) }}" alt=""> --}}

                <img class="rounded-circle avatar-sm" src="{{ URL($user->avatar) }}" alt="">
            </div>
            <h5 class="font-size-15 mb-1"><a href="javascript: void(0);" class="text-dark">{{ $user->name }}</a></h5>
            <p class="text-muted">{{ $user->role }}</p>
            {{-- <div>
                <a href="javascript: void(0);" class="badge bg-primary font-size-11 m-1">Html</a>
                <a href="javascript: void(0);" class="badge bg-primary font-size-11 m-1">Css</a>
                <a href="javascript: void(0);" class="badge bg-primary font-size-11 m-1">2 + more</a>
            </div> --}}
        </div>
        <div class="card-footer bg-transparent border-top">
            <div class="contact-links d-flex font-size-20">
                <div class="flex-fill">
                    <a href="javascript: void(0);"><i class="bx bx-message-square-dots"></i></a>
                </div>
                <div class="flex-fill">
                    <a href="javascript: void(0);"><i class="bx bx-pie-chart-alt"></i></a>
                </div>
                <div class="flex-fill">
                    <a href="{{ route('users-edit',['id' => $user->id]) }}"><i class="bx bx-user-circle"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
  @endforeach
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