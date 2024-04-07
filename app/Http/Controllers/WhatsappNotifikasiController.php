<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappNotifikasiController extends Controller
{
    public function sendMessage($reservasi_mobil = null, $user = null){
        $phone = '6281289124536'; // nanti diganti $user->nomor_hp
        if($reservasi_mobil->id_pengantaran == 3){
        $message = 'Hai, *'.ucfirst(strtolower(explode(" ", $reservasi_mobil->user->name)[0])).'!*
Terima kasih sudah menggunakan clickcar.kimiafarma.co.id
Pemesananmu telah *berhasil* dilakukan dengan rincian sebagai berikut:

Order ID: #'.$reservasi_mobil->id.'
Kode Pemesanan: '.$reservasi_mobil->kode_pemesanan.'
Pemesan: '.$reservasi_mobil->user->name.'

Rute: '.$reservasi_mobil->asal.' - '.$reservasi_mobil->tujuan.'
Waktu: '.$reservasi_mobil->waktu_keberangkatan.'
Link Voucher: '.(url('reservasi-mobil/show', $reservasi_mobil->kode_pemesanan)).'

Terima kasih! 🚗✅.
Semoga Sehat Selalu 😊.';
        }else{
        $message = 'Hai, *'.ucfirst(strtolower(explode(" ", $reservasi_mobil->user->name)[0])).'!*
Terima kasih telah menggunakan clickcar.kimiafarma.co.id
Pemesananmu telah *berhasil* dilakukan dengan rincian sebagai berikut:

Order ID: #'.$reservasi_mobil->id.'
Kode Pemesanan: '.$reservasi_mobil->kode_pemesanan.'
Pemesan: '.$reservasi_mobil->user->name.'

Mobil: '.$reservasi_mobil->mobil->nama.'
Rute: '.$reservasi_mobil->asal.' - '.$reservasi_mobil->tujuan.'
Waktu: '.$reservasi_mobil->waktu_keberangkatan.'
Driver: '.$reservasi_mobil->supir->nama.'
WA Driver: wa.me/'.$reservasi_mobil->supir->nomor_hp.'
Link Detail: '.(url('reservasi-mobil/show', $reservasi_mobil->kode_pemesanan)).'

Terima kasih! 🚗✅.
Semoga Sehat Selalu 😊.';
        }
    
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2xhcmF2ZWwtd2Etc2VydmVyLXYyLmtpbWlhZmFybWEuYXBwL2FwaS9yZWdpc3RlciIsImlhdCI6MTcwNzk2ODkwNiwiZXhwIjoxODY1ODIxNzA2LCJuYmYiOjE3MDc5Njg5MDYsImp0aSI6IkJNYXA0eGtDMnZXdmVCRmsiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.SEt7z5H7k1s-WYj_7s7spa1CsXXmQvcplHAs92wIfmg',
            'Cookie' => 'XSRF-TOKEN=eyJpdiI6IklDSmtKMWlEb3EyTTU1MmhWSnpsbnc9PSIsInZhbHVlIjoiMWYrdU9vQ3pSdDFsYWhZa0lPU0dpTjkxbzREeXhFOCtmc3dyTTgwQSt4QWRrZkhsOUllRExXTWEvNFQ3RDlaeVJmRVU4Q1pqYUJlNmlodkozVVNobzU0eXZ0bWJtbGtvcEtMSTVGNlhJK0xxYVZ4UTk5YWVPOExyZkJsKy9uVFIiLCJtYWMiOiJhN2IzZGEzZWQ5MzUzNTA2OThhMTczOTk3MTU4ZmUzMzI3NTZiNDE1MzAyOWIwMmNlODZlZmI3OGFiZTI2NTllIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IjhoK1BkdkV2WGVGMlRlS1hVOHBXVEE9PSIsInZhbHVlIjoiQkt1c094ckVON01sTG8zT25kSm52K1I5aU81NEN1UDl5VnpIRXlYL29nTVEveDBWNWtUL0pqMnpremR3d1FJeGphc05sZzdRS3RFa0JpSW1EMjlXRlo1b1ZGVE80T1AvRmllejdmNnJ5RnhTQllBV0tBWmVtdFZ4NitLaFZ4SW0iLCJtYWMiOiI2MTBiMjVlZTczNWY5N2ZkYTkzYmJmOGFiMmVkMjdjYmIxOGFlMzQyY2Y4NWEwOTE2OTA1NWUyNmYyYWJhYWI0IiwidGFnIjoiIn0%3D'
        ];
        
        $body = [
            'device' => '2',
            'type' => 'Text',
            'number' => $phone,
            'text' => $message
        ];
        
        try {
            $response = Http::withHeaders($headers)->post('https://laravel-wa-server-v2.kimiafarma.app/api/send-message', $body);
            $responseBody = $response->getBody();
            return $responseBody;
        } catch (\Exception $e) {
              return $e->getMessage();
        }
    }
    
    public function sendMessageApprove($reservasi_mobil = null, $user = null){
        if($reservasi_mobil->id_status == 1){
        $phone = '6281289124536'; // -> nanti diganti sama $atasan->nomor_hp
        $message = 'Yth Bpk/Ibu *'.ucfirst(strtolower(explode(" ", $user->name)[0])).'*
Mohon Approval untuk Pemesanan ClickCar:

Order ID: #'.$reservasi_mobil->id.'
Kode Pemesanan: '.$reservasi_mobil->kode_pemesanan.'
Pemesan: '.$reservasi_mobil->user->name.'

Klik link berikut untuk menyetujui pemesanan:
'.(url('reservasi-mobil/show', $reservasi_mobil->kode_pemesanan)).'

Terima kasih! 🚗✅.
Semoga Sehat Selalu 😊.';
        }elseif ($reservasi_mobil->id_status == 2){
        $phone = '6281289124536'; // nanti diganti sama $umum->nomor_hp
        $message = 'Yth Bpk/Ibu *Admin Umum*
Mohon Approval untuk Pemesanan ClickCar:

Order ID: #'.$reservasi_mobil->id.'
Kode Pemesanan: '.$reservasi_mobil->kode_pemesanan.'
Pemesan: '.$reservasi_mobil->user->name.'

Klik link berikut untuk menyetujui pemesanan:
'.(url('reservasi-mobil/show', $reservasi_mobil->kode_pemesanan)).'

Terima kasih! 🚗✅.
Semoga Sehat Selalu 😊.';    
        }elseif ($reservasi_mobil->id_status == 3){
        $phone = '6281289124536'; // nanti diganti sama $pool->nomor_hp
        $message = 'Yth Bpk/Ibu *Admin Driver/Ka Pool*
Mohon Pilihkan Mobil dan Driver untuk Pemesanan ClickCar:

Order ID: #'.$reservasi_mobil->id.'
Kode Pemesanan: '.$reservasi_mobil->kode_pemesanan.'
Pemesan: '.$reservasi_mobil->user->name.'

Silahkan klik tautan berikut untuk memilihkan Mobil dan Driver untuk pemesanan:
'.(url('reservasi-mobil/show', $reservasi_mobil->kode_pemesanan)).'

Terima kasih! 🚗✅
Semoga tetap sehat dan bahagia! 😊';        
        }elseif ($reservasi_mobil->id_status == 4){
        $phone = '6281289124536'; // nanti diganti sama $pool->nomor_hp
        $message = 'Yth Bpk/Ibu *Admin Driver/Ka Pool*
Mohon Berikan Voucher untuk Pemesanan ClickCar:

Order ID: #'.$reservasi_mobil->id.'
Kode Pemesanan: '.$reservasi_mobil->kode_pemesanan.'
Pemesan: '.$reservasi_mobil->user->name.'

Silahkan klik tautan berikut untuk memberikan Voucher untuk pemesanan:
'.(url('reservasi-mobil/show', $reservasi_mobil->kode_pemesanan)).'

Terima kasih! 🚗✅.
Semoga Sehat Selalu 😊.';
        }
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2xhcmF2ZWwtd2Etc2VydmVyLXYyLmtpbWlhZmFybWEuYXBwL2FwaS9yZWdpc3RlciIsImlhdCI6MTcwNzk2ODkwNiwiZXhwIjoxODY1ODIxNzA2LCJuYmYiOjE3MDc5Njg5MDYsImp0aSI6IkJNYXA0eGtDMnZXdmVCRmsiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.SEt7z5H7k1s-WYj_7s7spa1CsXXmQvcplHAs92wIfmg',
            'Cookie' => 'XSRF-TOKEN=eyJpdiI6IklDSmtKMWlEb3EyTTU1MmhWSnpsbnc9PSIsInZhbHVlIjoiMWYrdU9vQ3pSdDFsYWhZa0lPU0dpTjkxbzREeXhFOCtmc3dyTTgwQSt4QWRrZkhsOUllRExXTWEvNFQ3RDlaeVJmRVU4Q1pqYUJlNmlodkozVVNobzU0eXZ0bWJtbGtvcEtMSTVGNlhJK0xxYVZ4UTk5YWVPOExyZkJsKy9uVFIiLCJtYWMiOiJhN2IzZGEzZWQ5MzUzNTA2OThhMTczOTk3MTU4ZmUzMzI3NTZiNDE1MzAyOWIwMmNlODZlZmI3OGFiZTI2NTllIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IjhoK1BkdkV2WGVGMlRlS1hVOHBXVEE9PSIsInZhbHVlIjoiQkt1c094ckVON01sTG8zT25kSm52K1I5aU81NEN1UDl5VnpIRXlYL29nTVEveDBWNWtUL0pqMnpremR3d1FJeGphc05sZzdRS3RFa0JpSW1EMjlXRlo1b1ZGVE80T1AvRmllejdmNnJ5RnhTQllBV0tBWmVtdFZ4NitLaFZ4SW0iLCJtYWMiOiI2MTBiMjVlZTczNWY5N2ZkYTkzYmJmOGFiMmVkMjdjYmIxOGFlMzQyY2Y4NWEwOTE2OTA1NWUyNmYyYWJhYWI0IiwidGFnIjoiIn0%3D'
        ];
        
        $body = [
            'device' => '2',
            'type' => 'Text',
            'number' => $phone,
            'text' => $message
        ];
        
        try {
            $response = Http::withHeaders($headers)->post('https://laravel-wa-server-v2.kimiafarma.app/api/send-message', $body);
            $responseBody = $response->getBody();
            return $responseBody;
        } catch (\Exception $e) {
              return $e->getMessage();
        }
    }

    public function sendMessageDriver($reservasi_mobil = null, $user = null){
        $phone = '6282124535364'; // nanti diganti $user->nomor_hp
        $message = 'Yth Bpk/Ibu *'.ucfirst(strtolower(explode(" ", $reservasi_mobil->user->name)[0])).'*
Ada Pemesanan ClickCar:

Order ID: #'.$reservasi_mobil->id.'
Kode Pemesanan: '.$reservasi_mobil->kode_pemesanan.'
Pemesan: '.$reservasi_mobil->user->name.'
Mobil: '.$reservasi_mobil->mobil->name.'
Tujuan: '.$reservasi_mobil->tujuan.'
Waktu: '.$reservasi_mobil->waktu_keberangkatan.' 
Hub: wa.me/'.$reservasi_mobil->user->nomor_hp.'

Klik link di bawah ini untuk memulai perjalanan:
'.(url('reservasi-mobil/show', $reservasi_mobil->kode_pemesanan)).'

Terima kasih! 🚗✅.
Semoga Sehat Selalu 😊.';
    
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2xhcmF2ZWwtd2Etc2VydmVyLXYyLmtpbWlhZmFybWEuYXBwL2FwaS9yZWdpc3RlciIsImlhdCI6MTcwNzk2ODkwNiwiZXhwIjoxODY1ODIxNzA2LCJuYmYiOjE3MDc5Njg5MDYsImp0aSI6IkJNYXA0eGtDMnZXdmVCRmsiLCJzdWIiOiIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.SEt7z5H7k1s-WYj_7s7spa1CsXXmQvcplHAs92wIfmg',
            'Cookie' => 'XSRF-TOKEN=eyJpdiI6IklDSmtKMWlEb3EyTTU1MmhWSnpsbnc9PSIsInZhbHVlIjoiMWYrdU9vQ3pSdDFsYWhZa0lPU0dpTjkxbzREeXhFOCtmc3dyTTgwQSt4QWRrZkhsOUllRExXTWEvNFQ3RDlaeVJmRVU4Q1pqYUJlNmlodkozVVNobzU0eXZ0bWJtbGtvcEtMSTVGNlhJK0xxYVZ4UTk5YWVPOExyZkJsKy9uVFIiLCJtYWMiOiJhN2IzZGEzZWQ5MzUzNTA2OThhMTczOTk3MTU4ZmUzMzI3NTZiNDE1MzAyOWIwMmNlODZlZmI3OGFiZTI2NTllIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IjhoK1BkdkV2WGVGMlRlS1hVOHBXVEE9PSIsInZhbHVlIjoiQkt1c094ckVON01sTG8zT25kSm52K1I5aU81NEN1UDl5VnpIRXlYL29nTVEveDBWNWtUL0pqMnpremR3d1FJeGphc05sZzdRS3RFa0JpSW1EMjlXRlo1b1ZGVE80T1AvRmllejdmNnJ5RnhTQllBV0tBWmVtdFZ4NitLaFZ4SW0iLCJtYWMiOiI2MTBiMjVlZTczNWY5N2ZkYTkzYmJmOGFiMmVkMjdjYmIxOGFlMzQyY2Y4NWEwOTE2OTA1NWUyNmYyYWJhYWI0IiwidGFnIjoiIn0%3D'
        ];
        
        $body = [
            'device' => '2',
            'type' => 'Text',
            'number' => $phone,
            'text' => $message
        ];
        
        try {
            $response = Http::withHeaders($headers)->post('https://laravel-wa-server-v2.kimiafarma.app/api/send-message', $body);
            $responseBody = $response->getBody();
            return $responseBody;
        } catch (\Exception $e) {
              return $e->getMessage();
        }
    }
}
