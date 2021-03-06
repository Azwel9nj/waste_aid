@extends('layouts.app')

@section('content')


    <table class="table table-hover">
        <tbody>
            <div class="card">
                <div class="card-header">
                    <h1>This one Zones</h1>
                </div>
                @if (count($zones) > 0)
                    
                        @foreach ($zones as $zone)
                        <div class="card-body">
                            <tr>
                                <td>
                                    <div class="well">
                                        <h3 class="text-primary">{{ $zone->zone }}</h3>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('userZones.storeZone') }}">
                                        @csrf
                                        <!-- {{ csrf_field() }} -->
                                        <div class="form-group row">                                            
                                            <input type="hidden" value={{ $zone->id }} id="zoneId" class="form-control"
                                                name="zoneId">
                                            <button type="submit" class="btn btn-primary btn-block">SELECT</button>
                                        </div>
                                    </form>



                                </td>
                            </tr>
                        </div>
                        @endforeach
                    

                        {{ $zones->links() }}
                    @else
                        <div class="card-body">
                            <p>No Zones Available</p>
                        </div>
                @endif
            </div>
        </tbody>
    </table>
    

@endsection
