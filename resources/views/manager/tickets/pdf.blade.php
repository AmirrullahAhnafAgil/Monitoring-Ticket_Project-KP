<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Tiket</title>

  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 11px;
      color: #000;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header h2 {
      margin: 0;
      font-size: 18px;
    }

    .header p {
      margin: 4px 0 0;
      font-size: 12px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #000;
      padding: 6px;
      vertical-align: middle;
    }

    th {
      background-color: #f2f2f2;
      text-align: center;
      font-weight: bold;
    }

    td {
      text-align: left;
    }

    .text-center {
      text-align: center;
    }

    .footer {
      margin-top: 30px;
      font-size: 11px;
    }

    .signature {
      margin-top: 50px;
      text-align: right;
    }
  </style>
</head>
<body>

  {{-- HEADER --}}
  <div class="header">
    <h2>LAPORAN DATA TIKET</h2>
    <p>Sistem Monitoring Tiket</p>
    <p>Tanggal Cetak: {{ now()->format('d M Y H:i') }}</p>
  </div>

  {{-- TABEL DATA --}}
  <table>
    <thead>
      <tr>
        <th style="width: 4%;">No</th>
        <th style="width: 14%;">No Tiket</th>
        <th style="width: 28%;">Aktivitas</th>
        <th style="width: 18%;">Pemohon</th>
        <th style="width: 12%;">Status</th>
        <th style="width: 14%;">Dibuat</th>
      </tr>
    </thead>
    <tbody>
      @forelse($tickets as $i => $t)
        <tr>
          <td class="text-center">{{ $i + 1 }}</td>
          <td class="text-center">{{ $t->no_tiket }}</td>
          <td>{{ $t->aktivitas }}</td>
          <td>{{ $t->user->name ?? '-' }}</td>
          <td class="text-center">
            {{ ucfirst(str_replace('_', ' ', $t->status)) }}
          </td>
          <td class="text-center">
            {{ $t->created_at->format('d M Y H:i') }}
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="text-center">
            Tidak ada data tiket
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>

  {{-- FOOTER --}}
  <div class="footer">
    <div class="signature">
      <p>Mengetahui,</p>
      <p><strong>Manager</strong></p>
      <br><br>
      <p>( _______________________ )</p>
    </div>
  </div>

</body>
</html>