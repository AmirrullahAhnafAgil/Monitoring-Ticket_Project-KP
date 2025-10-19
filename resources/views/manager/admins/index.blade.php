@extends('layouts.main')

@section('title', 'Kelola Admin')

@section('content')
<div class="card-custom">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kelola Admin</h3>
    <a href="{{ route('manager.admins.create') }}" class="btn-glow">+ Tambah Admin</a>
  </div>

  <table class="table table-dark table-striped align-middle">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($admins as $i => $admin)
        <tr>
          <td>{{ $i + 1 }}</td>
          <td>{{ $admin->name }}</td>
          <td>{{ $admin->email }}</td>
          <td>
            <a href="{{ route('manager.admins.edit', $admin->id) }}" class="btn btn-sm btn-warning">
              <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('manager.admins.destroy', $admin->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Yakin ingin menghapus admin {{ $admin->name }}?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i> Hapus
              </button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-center">Belum ada admin.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $admins->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection