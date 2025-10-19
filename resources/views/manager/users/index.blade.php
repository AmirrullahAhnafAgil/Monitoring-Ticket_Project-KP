@extends('layouts.main')

@section('title', 'Kelola User - Manager')

@section('content')
<div class="card-custom">
  <h3 class="mb-3">Daftar Admin</h3>

  <table class="table table-dark table-striped align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($admins as $i => $admin)
        <tr>
          <td>{{ $i + 1 }}</td>
          <td>{{ $admin->name }}</td>
          <td>{{ $admin->email }}</td>
          <td>{{ ucfirst($admin->role) }}</td>
          <td>
            @if($admin->role === 'admin')
              <form action="{{ route('users.promote', $admin->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">
                  Jadikan Manager
                </button>
              </form>
            @else
              <span class="badge bg-secondary">Manager</span>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection