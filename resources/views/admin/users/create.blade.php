@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="my-5">Aggiungi un nuovo utente</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="user_type" class="form-label">Tipo Utente</label>
                <select class="form-control" id="user_type" name="user_type" required>
                    <option value="cliente">Cliente</option>
                    <option value="fornitore">Fornitore</option>
                </select>
            </div>


            <div class="mb-3">
                <button class="btn btn-success" type="submit">Salva</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Annulla</a>
            </div>
        </form>
    </div>
@endsection
