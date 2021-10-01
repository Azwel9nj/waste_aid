@extends('layouts.app')

@section('content')
    
    @if(count($franshisesInGivenZone) > 0)
      
      <div class="card">
            <div class="card-header">
        <h1>Franchises</h1>
            </div>
            <div class="card-body">
        <table  class="table table-hover">
                <tbody>
        @foreach($franshisesInGivenZone as $franchise)
            <div class="well">
                <tr>
                    <form method="GET" action="{{ route('showUserFranchiseInZone.show') }}">
                        @csrf
                        <!-- {{ csrf_field() }} -->
                        <div class="form-group row">                                            
                            <input type="hidden" value={{ $franchise->id }} id="franchiseId" class="form-control"
                                name="franchiseid">
                            <button type="submit" class="btn btn-primary btn-block">SELECT</button>
                        </div>
                    </form>
                </tr>
            </div>
        @endforeach
        {{$franshisesInGivenZone->links()}}

    @else
    
 
    <br>
    <h1>Franchises</h1>
    
        <h4>No Franchise has been registered in this Selected Zone</h4>
    @endif

                </tbody>
        </table>
@endsection