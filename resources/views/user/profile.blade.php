@extends('layout')

@section('title', 'profile')

@section('content')


    <div class="container">
        <x-navbar page='profile'/>
        <div class="mt-5">

            <h2> {{ Auth::user()->name }}</h2>
            <hr>    
            <table class="table">
                <tr>
                    <th>mail</th>
                    <th>phone number</th>
                    <th>api token</th>
                </tr>
                <tr>
                    <td> {{ Auth::user()->mail }}</td>
                    <td> {{ Auth::user()->tel_num }}</td>
                    <td> {{ Auth::user()->token }} </td>                    
                </tr>
            </table>

            <a href="{{ route('showsetting') }}" class="btn btn-primary mt-2">Edit</a>
        </div>
        
    </div>







@endsection