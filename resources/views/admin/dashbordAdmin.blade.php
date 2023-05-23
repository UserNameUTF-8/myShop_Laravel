@extends('layout')

@section('title', 'dashboard')


@section('content')



<div class="container">
    <x-navbar page='dashboard'/>
    
    <h3 class="text-primary mt-5 mb-5">
        Name {{ Auth::user()->name }}
    </h3>
    <hr>


<table class="table">

        <tr>
            <th>User id</th>
            <th>Name</th>
            <th>Custom name</th>
            <th>Phone Number</th>
            <th>Products</th>
            <th>delete</th>
        </tr>    

    @foreach ($users as $user)

            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->ourCustomName }}</td>
                <td>{{ $user->tel_num }}</td>
                <td><a href="{{route('showUserProducts', ['ourCustomName' => $user->ourCustomName])}}" class="btn btn-outline-primary">show</a></td>
                <td><a href="{{ route('conf', ['id' => $user->id]) }}" class="btn btn-primary">delete</a></td>
            </tr>

        
    @endforeach
</table>    


</div>









@endsection

