@extends('layouts.main') 

@section('title', 'Tentang Aplikasi')

@section('content')
<div class="card-custom d-flex flex-lg-row flex-column align-items-center justify-content-between gap-4 p-4">

  {{-- Kiri: Penjelasan --}}
  <div class="text-start flex-fill pe-lg-5">
    <h2 class="fw-bold mb-3 text-info">
      <i class="fas fa-info-circle me-2"></i>Tentang Aplikasi
    </h2>

    <p class="mb-3">
      <strong>Sistem Monitoring Ticket</strong> adalah aplikasi berbasis web yang dirancang untuk membantu proses
      pelaporan, penanganan, dan pengawasan tiket layanan secara efisien di lingkungan 
      <strong>Kantor Pertanahan Kota Semarang</strong>.
    </p>

    <p class="mb-3">
      Aplikasi ini memudahkan pengguna (User) dalam membuat tiket layanan, memungkinkan Admin untuk menindaklanjuti
      laporan dengan cepat, serta membantu Manager dalam memonitor performa dan progres penyelesaian tiket secara
      <em>real-time</em>.
    </p>

    <p class="mb-0">
      Dibangun menggunakan framework <strong>Laravel</strong> dan tampilan modern.
      Sistem ini mengedepankan <span class="text-success fw-semibold">transparansi, kecepatan, dan akurasi</span> 
      dalam pengelolaan layanan pertanahan.
    </p>
  </div>

  {{-- Kanan: Logo --}}
  <div class="logo-section text-center flex-shrink-0">
    <div class="logo-wrapper">
      <img src="{{ asset('images/logo-bpn.jpg') }}" 
           alt="Logo BPN Kota Semarang" 
           class="img-fluid">
    </div>
  </div>
</div>

{{-- CSS tambahan khusus halaman About --}}
<style>
  .card-custom {
    background: rgba(42, 42, 42, 0.9);
    border-radius: 16px;
    padding: 50px 60px;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.6);
  }

  .card-custom p {
    line-height: 1.7;
    text-align: justify;
  }

  /* ==== LOGO AREA ==== */
  .logo-section {
    flex: 0 0 260px; /* area tetap di kanan */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    text-align: center;
    padding-left: 10px;
  }

  .logo-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 230px;
    height: 230px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.05);
    box-shadow: 0 0 20px rgba(0, 255, 136, 0.2);
    margin-bottom: 10px;
  }

  .logo-wrapper img {
    width: 160px;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 255, 136, 0.3);
  }

  .logo-caption {
    font-size: 1rem;
    letter-spacing: 0.3px;
    text-shadow: 0 0 6px rgba(255, 255, 255, 0.15);
  }

  /* ==== RESPONSIVE ==== */
  @media (max-width: 991.98px) {
    .card-custom {
      padding: 30px;
      text-align: center;
    }

    .logo-section {
      flex: none;
      width: 100%;
      margin-top: 20px;
      padding-left: 0;
    }

    .logo-wrapper {
      width: 180px;
      height: 180px;
      margin: 0 auto 15px;
    }

    .logo-wrapper img {
      width: 130px;
    }

    .logo-caption {
      font-size: 0.95rem;
    }
  }
</style>
@endsection