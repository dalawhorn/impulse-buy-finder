@extends('layouts.base')

@section('body')
    <div class="container mx-auto bg-white h-screen">
        <div class="container mx-auto py-4" id="header">
            <h1>Impulse Buy Finder</h1>
        </div>
        <div class="container mx-auto">
            @yield('content')
        </div>
    </div>
    {{--<div class="container mx-auto text-center text-sm bg-white">--}}
        {{--Copyright &copy; {{ date('Y') }} Daniel Lawhorn--}}
    {{--</div>--}}
@endsection
