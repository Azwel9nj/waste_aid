@extends('layouts.app')

@section('content')


    <table class="table table-hover">
        <tbody>
            <div class="card">
                <div class="card-header">
                    <h1>The Zones</h1>
                </div>

                @if (count($zones) > 0)
                    <div class="card-body">
                        @foreach ($zones as $zone)
                            <tr>
                                <td>
                                    <div class="well">
                                        <h3 class="text-primary">{{ $zone->zone }}</h3>
                                </td>
                                <td>
                                </td>
                            </tr>
                        @endforeach

                        {{ $zones->links() }}
                    @else
                        <div class="card-body">
                            <p>No Zones Available</p>
                        </div>
                @endif
        </tbody>
    </table>
    </div>
    </div>
    </div>

@endsection
