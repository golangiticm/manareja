<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Jadwal Ibadah Raya</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: "Poppins", sans-serif;
            font-size: 12px;
            color: #000;
            background: #fff;
            padding: 0;
            margin: 0;
        }

        .header-image {
            width: 100%;
            max-width: 700px;
            display: block;
            margin: 0 auto 10px;
        }

        .page {
            page-break-after: always;
            padding: 20px;
            max-width: 700px;
            margin: 0 auto;
        }

        .invoice-box {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .info {
            margin: 10px 0;
        }

        .info p {
            margin: 4px 0;
        }

        .info strong {
            width: 120px;
            display: inline-block;
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #aaa;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #777;
        }

        .separator {
            margin: 12px 0 20px;
            height: 6px;
            border: 0;
            border-top: 3px solid #ebda84;
            border-bottom: 1px solid #2a50cd;
        }

        @media print {
            .page {
                page-break-after: always;
            }
        }
    </style>
</head>

<body>

    <img src="{{ public_path('images/cop.png') }}" class="header-image">
    <h2>{{ $type }}</h2>
    <br>
    {{-- <div class="separator"></div> --}}
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="text-align: center">Title</th>
                <th rowspan="2" style="text-align: center">Tanggal</th>
                <th rowspan="2" style="text-align: center">Waktu</th>
                <th rowspan="2" style="text-align: center">Tempat</th>
                @if ($type == 'FA')
                    <th rowspan="2" style="text-align: center">Family Altar</th>
                @endif
                <th colspan="2" style="text-align: center">Daftar Petugas</th>
            </tr>
            <tr>
                <th style="text-align: center">Petugas</th>
                <th style="text-align: center">Nama</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services as $service)
                @php
                    $assignments = $service->officer_service_assigments;
                    $rowspan = $assignments->count() > 0 ? $assignments->count() : 1;
                @endphp

                @if ($assignments->count())
                    @foreach ($assignments as $index => $assignment)
                        <tr>
                            @if ($index === 0)
                                <td rowspan="{{ $rowspan }}">{{ $service->title }}</td>
                                <td rowspan="{{ $rowspan }}">
                                    {{ \Carbon\Carbon::parse($service->held_at)->translatedFormat('l, d F Y') }}</td>
                                <td rowspan="{{ $rowspan }}">{{ $service->start_time }} - {{ $service->end_time }}
                                </td>
                                <td rowspan="{{ $rowspan }}">{{ $service->location ?? '-' }}</td>
                                @if ($type == 'FA')
                                    @foreach ($service->officer_service_fas as $fas)
                                        <td rowspan="{{ $rowspan }}">{{ $fas->group->name ?? '-' }}</td>
                                    @endforeach
                                @endif
                            @endif
                            <td>{{ $assignment->officer->title ?? '-' }}</td>
                            <td>{{ $assignment->user->name ?? '-' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>{{ $service->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($service->held_at)->translatedFormat('l, d F Y') }}</td>
                        <td>{{ $service->start_time }} - {{ $service->end_time }}</td>
                        <td>{{ $service->location ?? '-' }}</td>
                        <td colspan="2" style="text-align: center;">Belum ada petugas</td>
                    </tr>
                @endif
            @empty
                <td colspan="6" style="text-align: center">Belum Ada Jadwal</td>
            @endforelse
        </tbody>
    </table>


    <div class="footer">
        Dicetak otomatis oleh sistem jadwal ibadah.<br>
        {{ now()->format('d-m-Y H:i') }}
    </div>
</body>

</html>
