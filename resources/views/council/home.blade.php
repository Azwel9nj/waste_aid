@extends('layouts.appCouncil')
@section('content')
<div class="container">
    <div class="row justify-content-center">
    <!--<div class="col-md-8">-->
        <div class="card">
            <div class="card-header"><h3>ADMIN DASHBOARD</h3></div>

                <div class="card-body">
                    <img style="width: 100%" src="/img/seljalandsfoss_waterfall_iceland_4k.jpg" />

                <!---@if (session('status'))
                <div class="alert alert-success">
                {{ session('status') }}
                </div>-->
                @endif
                @component('components.usage')
                @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection