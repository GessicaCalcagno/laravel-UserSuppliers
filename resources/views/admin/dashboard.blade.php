@extends('layouts.admin')

@section('content')
 <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col mt-4">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p class="fs-3 m-0">Ciao <span
                                class="fw-semibold text-success">{{ Auth::user()->name }}</span>!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-3">Utenti Registrati</h1>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Aggiungi utente</a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tipo Utente</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->user_type) }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">Modifica</a>
                                {{-- <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"> --}}
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Sei sicuro di voler eliminare questo utente?');">Elimina</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end m-3">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection


