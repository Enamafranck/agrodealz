{{--@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection--}}

@extends("layouts.master")

@section("contenu")
<div class="row">
    <div class="col-12 p-4">
        <div class="jumbotron ">
            <h1 class="disply-3">Bienvenu, <strong>{{ auth()->user()->nom_complet}}</strong></h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling
            <hr class="my-4">
            </p>It uses utility classes for typography and spacing to space content out within the larg
            <p class="lead">
            <a class="btn btn-primary btn-lg"href="#"  role="button">Learn more</a>
            </p>
        </div>

    </div>
</div>
@endsection
