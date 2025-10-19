@extends('layouts.main')

@section('title', 'Detail Catatan - Admin')

@section('content')
<div class="card-custom">
  <h3 class="mb-3">Detail Catatan</h3>

  <table class="table table-dark table-bordered">
    <tr>
      <th>No Tiket</th>
      <td>{{ $catatan->ticket->no_tiket ?? $catatan->ticket->id }}</td>
    </tr>
    <tr>
      <th>Aktivitas</th>
      <td>{{ $catatan->ticket->aktivitas }}</td>
    </tr>
    <tr>
      <th>User</th>
      <td>{{ $catatan->ticket->user->name ?? '—' }}</td>
    </tr>
    <tr>
      <th>Isi Catatan</th>
      <td>{{ $catatan->isi_catatan }}</td>
    </tr>
    <tr>
      <th>Dibuat Oleh</th>
      <td>{{ $catatan->admin->name ?? '—' }}</td>
    </tr>
    <tr>
      <th>Dibuat Pada</th>
      <td>{{ $catatan->created_at->format('d M Y H:i') }}</td>
    </tr>
  </table>

  <a href="{{ route('catatan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection