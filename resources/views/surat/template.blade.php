<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Peminjaman</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.4;
            margin: 2cm;
        }
        .kop {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .kop h2 {
            margin: 0;
            font-size: 18pt;
            font-weight: bold;
        }
        .kop p {
            margin: 0;
            font-size: 12pt;
        }
        .content {
            margin-top: 30px;
        }
        .content h3 {
            text-align: center;
            text-decoration: underline;
            font-size: 14pt;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature p {
            margin: 5px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 10pt;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="kop">
        <h2>PINVET</h2>
        <p>Sistem Informasi Peminjaman dan Inventarisasi UKM</p>
        <p>Alamat: {{ $alamat_ukm ?? 'Jl. Kampus No. 1, Gedung Student Center Lt. 3' }}</p>
    </div>

    <div class="content">
        <h3>SURAT PEMINJAMAN BARANG</h3>
        <p><strong>Nomor:</strong> {{ $nomor_surat }}</p>
        <p>Yang bertanda tangan di bawah ini:</p>

        <table style="border: none; width: auto;">
            <tr>
                <td style="border: none; width: 120px;">Nama</td>
                <td style="border: none;">: {{ $nama_peminjam }}</td>
            </tr>
            @if(!empty($nim))
            <tr>
                <td style="border: none;">NIM</td>
                <td style="border: none;">: {{ $nim }}</td>
            </tr>
            @endif
            <tr>
                <td style="border: none;">Instansi/UKM</td>
                <td style="border: none;">: {{ $instansi }}</td>
            </tr>
            <tr>
                <td style="border: none;">Kontak</td>
                <td style="border: none;">: {{ $kontak_peminjam ?? '-' }}</td>
            </tr>
            <tr>
                <td style="border: none;">Email</td>
                <td style="border: none;">: {{ $email_peminjam ?? '-' }}</td>
            </tr>
        </table>

        <p>Dengan ini mengajukan peminjaman barang sebagai berikut:</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($daftar_barang as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->jumlah_barang }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table style="border: none; width: auto; margin-top: 10px;">
            <tr>
                <td style="border: none; width: 120px;">Tanggal Pinjam</td>
                <td style="border: none;">: {{ $tanggal_pinjam }}</td>
            </tr>
            <tr>
                <td style="border: none;">Tanggal Kembali</td>
                <td style="border: none;">: {{ $tanggal_kembali }}</td>
            </tr>
            <tr>
                <td style="border: none;">Total Barang</td>
                <td style="border: none;">: {{ $total_barang }} item</td>
            </tr>
            @if($biaya_sewa > 0)
            <tr>
                <td style="border: none;">Total Biaya Sewa</td>
                <td style="border: none;">: Rp {{ number_format($biaya_sewa, 0, ',', '.') }}</td>
            </tr>
            @endif
        </table>

        <p>Demikian surat peminjaman ini dibuat dengan sebenarnya untuk digunakan sebagaimana mestinya.</p>

        <div class="signature">
            <p>Hormat kami,</p>
            <br><br><br>
            <p><strong>{{ $nama_penandatangan }}</strong></p>
            <p>{{ $jabatan_penandatangan }}</p>
        </div>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>