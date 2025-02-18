@extends('layouts.admin')

@section('content')
    <div class="container mt-3">
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
        <h1>Modifica Utente</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="user_type" class="form-label">Tipo di Utente</label>
                <select class="form-select" id="user_type" name="user_type" required>
                    <option value="cliente" @selected($user->user_type == 'cliente')>Cliente</option>
                    <option value="fornitore" @selected($user->user_type == 'fornitore')>Fornitore</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Aggiorna</button>
        </form>
    </div>
@endsection
