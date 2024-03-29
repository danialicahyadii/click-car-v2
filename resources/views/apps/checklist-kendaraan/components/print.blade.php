<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 10px; /* Adjust the font size */
            overflow: hidden;
            padding: 4px 2px; /* Adjust the padding */
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 10px; /* Adjust the font size */
            font-weight: normal;
            overflow: hidden;
            padding: 4px 2px; /* Adjust the padding */
            word-break: normal;
        }

        .tg .tg-0pky {
            border-color: inherit;
            text-align: left;
            vertical-align: top;
        }
    </style>
    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 10px; /* Adjust the font size */
            overflow: hidden;
            padding: 4px 2px; /* Adjust the padding */
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 10px; /* Adjust the font size */
            font-weight: normal;
            overflow: hidden;
            padding: 4px 2px; /* Adjust the padding */
            word-break: normal;
        }

        .tg .tg-baqh {
            text-align: center;
            vertical-align: top;
        }

        .tg .tg-0lax {
            text-align: left;
            vertical-align: top;
        }

        .tg .tg-nrix {
            text-align: center;
            vertical-align: middle;
        }
    </style>
    <title>{{ $checklistKendaraan->kode_form }}</title>
</head>

<body>
  <!-- Kimia Farma logo -->
  <div style="float: right; margin-right: 10px;">
      <img src="assets/img/kf.png" width="190" height="90">
  </div>
  <table class="tg" id="table-1">
      <thead>
          <tr>
              <th class="tg-0pky">Kode Form</th>
              <th class="tg-0pky">{{ $checklistKendaraan->kode_form }}</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td class="tg-0pky">Tgl Revisi</td>
              <td class="tg-0pky">{{ $checklistKendaraan->tgl_revisi }}</td>
          </tr>
          <tr>
              <td class="tg-0pky">Tgl Berlaku</td>
              <td class="tg-0pky">{{ $checklistKendaraan->tgl_berlaku }}</td>
          </tr>
      </tbody>
  </table>
  <br>
  <div class="container">
    <table class="tg" style="undefined;table-layout: fixed; width: 100%" id="table-2">
        <colgroup>
            <col style="width: 25%">
            <col style="width: 25%">
            <col style="width: 25%">
            <col style="width: 25%">
        </colgroup>
        <thead>
        </thead>
        <tbody>
          <tr>
            <td class="tg-0lax" style="font-weight: bold;">Nama Driver</td>
            <td class="tg-0lax">{{ $supir->nama }}</td>
            <td class="tg-0lax" style="font-weight: bold;">Nomor Polisi</td>
            <td class="tg-0lax">{{ $mobil->nomor_polisi }}</td>
          </tr>
          <tr>
            <td class="tg-0lax" style="font-weight: bold;">Jenis SIM</td>
            <td class="tg-0lax">@if ($supir->jenis_sim == 1) Perorangan @else Umum @endif</td>
            <td class="tg-0lax" style="font-weight: bold;">Nomor STNK</td>
            <td class="tg-0lax">{{ $mobil->nomor_stnk ?? '-' }}</td>
          </tr>
          <tr>
            <td class="tg-0lax" style="font-weight: bold;">Tanggal Habis SIM</td>
            <td class="tg-0lax">{{ Carbon::parse($supir->habis_sim)->locale('id')->format('d M Y') ?? '-' }}</td>
            <td class="tg-0lax" style="font-weight: bold;">Tanggal Habis STNK</td>
            <td class="tg-0lax">{{ Carbon::parse($mobil->habis_stnk)->locale('id')->format('d M Y') ?? '-' }}</td>
          </tr>
          <tr>
            <td class="tg-0lax" style="font-weight: bold;">Type Kendaraan</td>
            <td class="tg-0lax">{{ $mobil->JenisKendaraan->nama ?? '-' }}</td>
            <td class="tg-0lax" style="font-weight: bold;">Tahun Pembuatan Kendaraan</td>
            <td class="tg-0lax">{{ $mobil->tahun_pembuatan ?? '-' }}</td>
          </tr>
          <tr>
            <td class="tg-0lax" style="font-weight: bold;">Load Maksimum</td>
            <td class="tg-0lax">{{ $mobil->load_maksimum ?? '-' }}</td>
            <td class="tg-0lax" style="font-weight: bold;">No. Kabin</td>
            <td class="tg-0lax">{{ $mobil->no_kabin ?? '-' }}</td>
          </tr>
          <tr>
            <td class="tg-0lax" style="font-weight: bold;">KM Saat Inspeksi</td>
            <td class="tg-0lax">{{ $checklistKendaraan->km_saat_inspeksi ?? '-' }}</td>
            <td class="tg-0lax" style="font-weight: bold;">Tanggal Terakhir Service</td>
            <td class="tg-0lax">{{ Carbon::parse($mobil->terakhir_service)->locale('id')->format('d M Y') ?? '-' }}</td>
          </tr>
          <tr>
            <td class="tg-0lax" style="font-weight: bold;">Tanggal Inspeksi</td>
            <td class="tg-0lax">{{ Carbon::parse($checklistKendaraan->tgl_inspeksi)->locale('id')->format('d M Y') ?? '-' }}</td>
            <td class="tg-0lax" style="font-weight: bold;">Kontraktor Angkutan</td>
            <td class="tg-0lax">{{ $mobil->kontraktor_angkutan ?? '-' }}</td>
          </tr>
        </tbody>
    </table>
    <div style="margin-top: 10px;"><center>
      <h5>INSPEKSI KENDARAAN</h5>
    </center></div>
    <table class="tg" style="undefined;table-layout: fixed; width: 100%" id="table-3">
        <colgroup>
            <col style="width: 25%">
            <col style="width: 25%">
            <col style="width: 25%">
            <col style="width: 25%">
        </colgroup>
        <thead>
          <tr>
            <th class="tg-0lax" style="font-weight: bold;" colspan="4">{{ $mobil->nama }}</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="tg-nrix" rowspan="2">Item</td>
            <td class="tg-baqh" colspan="2">Kondisi</td>
            <td class="tg-nrix" rowspan="2">Keterangan</td>
          </tr>
          <tr>
            <td class="tg-nrix">Baik</td>
            <td class="tg-nrix">Cacat</td>
          </tr>
          <tr>
            <td class="tg-nrix" colspan="4">General</td>
          </tr>
          @foreach ($i['General'] as $row)   
          <tr>
            <td class="tg-0lax">{{ $row->ItemInspeksi->item }}</td>
            <td class="tg-0lax" class="text-center">@if ($row->value == 'baik')
                <img src="assets/img/checklist-11.png" alt="" width="10%">
            @endif</td>
            <td class="tg-0lax" class="text-center">@if ($row->value == 'cacat')
                <img src="assets/img/checklist-11.png" alt="" width="10%">
            @endif</td>
            <td class="tg-0lax">@if (!empty($row->ket))
                {{ $row->ket }}
            @endif</td>
          </tr>
          @endforeach
          <tr>
            <td class="tg-nrix" colspan="4">Perlengkapan Safety</td>
          </tr>
          @foreach ($i['Perlengkapan Safety'] as $row)
          <tr>
            <td class="tg-0lax">{{ $row->ItemInspeksi->item }}</td>
            <td class="tg-0lax" class="text-center">@if ($row->value == 'baik')
                <img src="assets/img/checklist-11.png" alt="" width="10%">
            @endif</td>
            <td class="tg-0lax" class="text-center">@if ($row->value == 'cacat')
                <img src="assets/img/checklist-11.png" alt="" width="10%">
            @endif</td>
            <td class="tg-0lax">@if (!empty($row->ket))
                {{ $row->ket }}
            @endif</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="3" class="tg-nrix">Kesimpulan</td>
            <td class="text-center">{{ strtoupper($checklistKendaraan->kesimpulan) }}</td>
          </tr>
        </tbody>
    </table>
  </div>
</body>

</html>
