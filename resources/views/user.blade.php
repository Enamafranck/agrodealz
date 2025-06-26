@extends("layouts.master")

@section("contenu")
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($showForm)
        @include("livewire.create")
    @else
        <!-- Votre contenu ici -->
        @include("livewire.liste")
    @endif

</div>
@endsection
