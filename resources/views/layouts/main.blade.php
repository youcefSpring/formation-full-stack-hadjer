@extends('layouts.head')
@extends('layouts.header')


@yield('main-content')
<center>
<span class="text-center text-danger" style="color: red;">
    @if(session('error'))
        {{ session('error') }}
    @endif
</span>
<span class="text-center text-success" style="color: green;">
    @if(session('success'))
        {{ session('success') }}
    @endif
</span>
</center>


@extends('layouts.footer')