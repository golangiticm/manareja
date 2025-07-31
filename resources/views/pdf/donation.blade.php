<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice Donasi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
            color: #000;
        }

        .header-image {
            width: 100%;
            max-width: 700px;
            height: auto;
            display: block;
        }

        .invoice-box {
            max-width: 700px;
            margin: -10px auto;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .info-table td {
            padding: 8px 4px;
            vertical-align: top;
        }

        .info-table td.label {
            width: 140px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #777;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .invoice-box {
                box-shadow: none;
                border: none;
                margin-top: 0;
                padding-top: 0;
            }

            .header-image {
                margin-bottom: -10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ public_path('images/cop.png') }}" class="header-image">

        <div class="invoice-box">
            <h1>Bukti Donasi</h1>
            <p style="text-align:center;">Terima kasih atas donasi Anda</p>

            <table class="info-table">
                <tr>
                    <td class="label">Nama Donatur</td>
                    <td class="label">:</td>
                    <td>{{ $donation->donor_name }}</td>
                </tr>
                <tr>
                    <td class="label">Jumlah</td>
                    <td class="label">:</td>
                    <td>Rp{{ number_format($donation->amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Tujuan</td>
                    <td class="label">:</td>
                    <td>{{ $purposeLabel }}</td>
                </tr>
                <tr>
                    <td class="label">Pesan</td>
                    <td class="label">:</td>
                    <td>{{ $donation->message }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal</td>
                    <td class="label">:</td>
                    <td>{{ $donation->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            </table>

            <div class="footer">
                Dicetak secara otomatis oleh sistem donasi.<br>
                {{ now()->format('d-m-Y H:i') }}
            </div>
        </div>
    </div>
</body>

</html>



{{-- <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dokumen Resmi</title>

  <!-- Font (opsional) -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">

  <style>
    :root{
      --text:#111;
      --muted:#444;
    }

    *{
      box-sizing:border-box;
      margin:0;
      padding:0;
      font-family:"Poppins",system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
    }

    body{
      color:var(--text);
      background:#fff;
      line-height:1.6;
    }

    /* Lebar dokumen agar enak dibaca & mudah diekspor ke PDF */
    .document{
      max-width: 800px;          /* ~ A4 di layar */
      margin: 24px auto;
      padding: 0 24px 48px;
    }

    header.letterhead{
      text-align:center;
      padding-top:12px;
    }

    .letterhead .logo{
      width: 90px;               /* atur sesuai logo Anda */
      height: 90px;
      object-fit: contain;
      margin: 0 auto 8px;
      display:block;
    }

    .letterhead .instansi{
      font-weight:700;
      font-size: 20px;
      letter-spacing: .5px;
      text-transform: uppercase;
    }

    .letterhead .sub-instansi{
      font-weight:600;
      font-size: 16px;
      margin-top:2px;
    }

    .letterhead .alamat,
    .letterhead .kontak{
      font-size: 12.5px;
      color: var(--muted);
    }

    .letterhead .alamat{ margin-top:6px; }
    .letterhead .kontak{ margin-top:2px; }

    /* Garis di bawah header: tebal + tipis (double line) */
    .separator{
      margin: 12px 0 20px;
      height: 6px;
      border: 0;
      border-top: 3px solid #000;
      border-bottom: 1px solid #000;
    }

    main.content{
      font-size: 14px;
    }

    main.content h2{
      font-size: 18px;
      margin: 8px 0 6px;
    }

    main.content p,
    main.content ul,
    main.content ol{
      margin: 8px 0;
    }

    /* Tabel standar dokumen */
    table{
      width:100%;
      border-collapse: collapse;
      margin: 8px 0 16px;
      font-size: 14px;
    }
    th, td{
      border: 1px solid #999;
      padding: 6px 8px;
      vertical-align: top;
    }
    th{
      text-align: left;
      font-weight: 600;
    }

    footer{
      margin-top: 32px;
      font-size: 12px;
      color: var(--muted);
    }

    /* Style cetak A4 */
    @page{
      size: A4;
      margin: 20mm;
    }
    @media print{
      body{ -webkit-print-color-adjust: exact; print-color-adjust: exact; }
      .document{ max-width: none; margin:0; padding:0; }
      .separator{ margin: 10px 0 18px; }
    }
  </style>
</head>
<body>
  <div class="document">
    <header class="letterhead">
      <!-- Ganti src di bawah dengan file logo Anda -->
      <img src="logo.png" alt="Logo Instansi" class="logo">

      <div class="instansi">Nama Instansi / Universitas / Perusahaan</div>
      <div class="sub-instansi">Fakultas/Departemen/Unit (opsional)</div>

      <div class="alamat">Jl. Contoh No. 123, Kota, Provinsi 12345</div>
      <div class="kontak">Telp: (021) 123456 | Email: info@instansi.ac.id | Website: www.instansi.ac.id</div>
    </header>

    <div class="separator"></div>

    <main class="content">
      <!-- Mulai isi konten dokumen Anda di bawah ini -->
      <h2>Judul Dokumen</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium culpa sequi sint voluptatem,
        alias, beatae illum maxime itaque, provident similique.
      </p>

      <h2>Subjudul</h2>
      <p>
        Contoh paragraf isi dokumen. Anda bisa menambahkan tabel, daftar, dan elemen lain seperti pada
        dokumen formal.
      </p>

      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Uraian</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1.</td>
            <td>Item pertama</td>
            <td>Keterangan tambahan</td>
          </tr>
          <tr>
            <td>2.</td>
            <td>Item kedua</td>
            <td>Keterangan tambahan</td>
          </tr>
        </tbody>
      </table>

      <p>
        Demikian dokumen ini dibuat untuk digunakan sebagaimana mestinya.
      </p>
    </main>

    <footer>
      <!-- Catatan kaki opsional -->
      <p>Catatan: Informasi pada dokumen ini bersifat contoh dan dapat disesuaikan.</p>
    </footer>
  </div>
</body>
</html> --}}
