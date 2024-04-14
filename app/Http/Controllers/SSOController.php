<?php

namespace App\Http\Controllers;

use App\Models\DataKifest;
use App\Models\MasterEntitas;
use App\Models\Supir;
use App\Models\User;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SSOController extends Controller
{
    public function loginSSO(Request $request)
    {
        // Get public key from local storage
        $publicKey = Storage::disk('local')->get(env('SSO_KIFEST'));

        try {
            $payloads = JWT::decode($request->token, new Key($publicKey, 'RS256'));
        } catch (BeforeValidException|ExpiredException|SignatureInvalidException $e) {
            return $e->getMessage();
        }

        // Clear session and logout user
        Auth::logout();
        Session::flush();

        try {
            // Send API request to get user by NPP
            $client = new Client(['base_uri' => env('API_URL')]);
            $headers = [
                'X-API-KEY' => env('API_KEY') ?? '',
                'Accept' => 'application/json',
            ];

             $response = $client->request('GET', 'employee?npp='.$payloads->employee_npp, [
                // $response = $client->request('GET', '/memo/employee?npp=19900518A', [
                // $response = $client->request('GET', 'employee?npp=19900518A', [
                // $response = $client->request('GET', 'employee?npp=20010202B', [
                // $response = $client->request('GET', 'employee?npp=19911001D', [
                'headers' => $headers,
            ]);

        } catch (RequestException $e) {
            // Handle request exception
            return abort($e->getCode());
        }

        // Get data from response and update session
        $data = json_decode($response->getBody(), true);

        if (!empty($data['data']) && !empty($data['data']['employee'])) {
            $user = $this->createOrUpdateUser($data['data']['employee'], $data['data']);
            Auth::login($user);
        } else {
            return redirect('/login');
        }
        activity()->log('Melakukan Login Aplikasi');
        return redirect('/');
    }

    public function createOrUpdateUser($employeeData, $dataAll)
    {
        // Cari pengguna di tabel DataKifest berdasarkan 'kode_npp'
        $dataKifest = DataKifest::where('npp', $employeeData['kode_npp'])->first();

        // Cari entitas id
        $entitas = MasterEntitas::where('kode_entitas', $dataAll['position']['kode_entitas'] ?? 1000)->first();

        if (! $dataKifest) {
            // Pengguna tidak ada dalam tabel DataKifest, buat entri baru
            $dataKifest = new DataKifest();
            $dataKifest->npp = $employeeData['kode_npp'];
            $dataKifest->data = json_encode($dataAll); // Simpan data dalam format JSON
            $dataKifest->save();
        } else {
            // Pengguna sudah ada dalam tabel DataKifest, perbarui entri yang ada
            $dataKifest->data = json_encode($dataAll); // Perbarui data dalam format JSON
            $dataKifest->save();
        }

        // Cari pengguna di tabel User berdasarkan 'npp'
        $exsiting_user = User::where('npp', $employeeData['kode_npp'])->first();

        // Buat pengguna baru jika tidak ada
        if ($exsiting_user == null) {
            $user = new User();
        } else {
            $user = $exsiting_user;
        }
        $user->name = $employeeData['nama_pegawai'];
        $user->email = $employeeData['email'];
        $user->nomor_hp = $dataAll['employee']['telepon_pegawai'];
        $user->npp = $employeeData['kode_npp'];
        $user->id_status = 1;
        $user->id_entitas = $entitas->id;
        $user->tipe_user = 1;
        $user->kode_jabatan = $dataAll['position']['kode_jabatan'] ?? null;
        $user->nama_jabatan = $dataAll['position']['nama_jabatan'] ?? null;
        $user->approval_1 = $dataAll['position']['approve_1'] ?? null;
        $user->approval_2 = $dataAll['position']['approve_2'] ?? null;
        $user->approval_3 = $dataAll['position']['approve_3'] ?? null;
        $user->approval_4 = $dataAll['position']['approve_4'] ?? null;
        $user->level_jabatan = $dataAll['position']['level_jabatan'] ?? null;
        $user->nama_level_jabatan = $dataAll['position']['nama_level_jabatan'] ?? null;
        $user->kode_entitas = $dataAll['position']['kode_entitas'] ?? null;
        $user->nama_entitas = $dataAll['position']['nama_entitas'] ?? null;
        $user->kode_direktorat = $dataAll['position']['kode_direktorat'] ?? null;
        $user->nama_direktorat = $dataAll['position']['nama_direktorat'] ?? null;
        $user->kode_divisi = $dataAll['position']['kode_divisi'] ?? null;
        $user->nama_divisi = $dataAll['position']['nama_divisi'] ?? null;
        $user->kode_unit = $dataAll['position']['kode_unit'] ?? null;
        $user->nama_unit = $dataAll['position']['nama_unit'] ?? null;
        $user->kodesub_unit = $dataAll['position']['kodesub_unit'] ?? null;
        $user->nama_sub_unit = $dataAll['position']['nama_sub_unit'] ?? null;
        $user->kode_bagian = $dataAll['position']['kode_bagian'] ?? null;
        $user->nama_bagian = $dataAll['position']['nama_bagian'] ?? null;
        $user->nomor_hp = $dataAll['employee']['telepon_pegawai'] ?? null;
        if ($user->nomor_hp !== null && substr($user->nomor_hp, 0, 1) === '0') {
            $user->nomor_hp = '62' . substr($user->nomor_hp, 1);
        }

        if (! $exsiting_user) {
            if ($dataAll['position']['nama_jabatan'] == 'ALIH DAYA DRIVER') {
                // Jika pengguna driver
                $supir = Supir::where('nama', 'LIKE', '%'.$user->name.'%')->first();
                $user->password = bcrypt('kimiafarma'); // Gantilah 'password' dengan kata sandi yang sesuai.
                $user->save();
                $user->assignRole('Driver');
                $supir->id_user = $user->id;
                $supir->update();
            } else {
                // Jika pengguna tidak ada di tabel User, buat entri pengguna baru
                $user->password = bcrypt('kimiafarma'); // Gantilah 'password' dengan kata sandi yang sesuai.
                $user->save();
                $user->assignRole('Requester');
            }
        } else {
            $user->update();
        }

        // Ambil data kifest dari tabel DataKifest
        $dataKifest = json_decode($dataKifest->data);
        // Ambil data approval pada position
        foreach ($dataKifest->approvals as $approval) {
            // jika level jabatan 1 adalah direksi, maka lewati
            if ($approval->position !== null && $approval->position->level_jabatan == 1) {
                continue;
            } elseif ($approval->employee_plt === null && $approval->employee === null) {
                continue;
            }
            // Apakah employee_plt bernilai true?
            if ($approval->employee_plt != null) {
                // Cari pengguna approval di tabel User berdasarkan 'kode_jabatan' atau 'npp'
                $exsiting_user_approval = User::where('kode_jabatan', $approval->position->kode_jabatan)
                    ->orWhere('npp', $approval->employee_plt->employee->kode_npp)
                    ->first();
                // Jika employee_plt bernilai true, maka approval akan diambil dari employee_plt
                $approval = $approval->employee_plt;
            } else {
                // Cari pengguna approval di tabel User berdasarkan 'kode_jabatan' atau 'npp'
                $exsiting_user_approval = User::where('kode_jabatan', $approval->position->kode_jabatan)
                    ->orWhere('npp', $approval->employee->kode_npp)
                    ->first();
            }
            // Buat pengguna baru jika tidak ada
            if ($exsiting_user_approval == null) {
                $user_approval = new User();
            } else {
                $user_approval = $exsiting_user_approval;
            }
            
            // Jika pengguna approval tidak ada di tabel User, buat entri pengguna approval baru
            $user_approval = [
                'name' => $approval->employee->nama_pegawai,
                'email' => $approval->employee->email,
                'npp' => $approval->employee->kode_npp,
                'id_status' => 1,
                'id_entitas' => $entitas->id,
                'tipe_user' => 2,
                'kode_jabatan' => $approval->position->kode_jabatan,
                'nama_jabatan' => $approval->position->nama_jabatan,
                'approval_1' => $approval->position->approve_1,
                'approval_2' => $approval->position->approve_2,
                'approval_3' => $approval->position->approve_3,
                'approval_4' => $approval->position->approve_4,
                'level_jabatan' => $approval->position->level_jabatan,
                'nama_level_jabatan' => $approval->position->nama_level_jabatan,
                'kode_entitas' => $approval->position->kode_entitas,
                'nama_entitas' => $approval->position->nama_entitas,
                'kode_direktorat' => $approval->position->kode_direktorat,
                'nama_direktorat' => $approval->position->nama_direktorat,
                'kode_divisi' => $approval->position->kode_divisi,
                'nama_divisi' => $approval->position->nama_divisi,
                'kode_unit' => $approval->position->kode_unit,
                'nama_unit' => $approval->position->nama_unit,
                'kodesub_unit' => $approval->position->kodesub_unit,
                'nama_sub_unit' => $approval->position->nama_sub_unit,
                'kode_bagian' => $approval->position->kode_bagian,
                'nama_bagian' => $approval->position->nama_bagian,
                'nomor_hp' => $approval->employee->telepon_pegawai !== null && substr($approval->employee->telepon_pegawai, 0, 1) === '0' ? '62' . substr($approval->employee->telepon_pegawai, 1) : $approval->employee->telepon_pegawai,
            ];
            
            if (! $exsiting_user_approval) {
                $password = [
                    'password' => bcrypt('kimiafarma'),
                ];
                $data_user = array_merge($password, $user_approval);
                $user = User::create($data_user);
                $user->assignRole('Requester');
            } else {
                if ($approval->employee->kode_jabatan_plt != null){
                    $existing_user = User::where('kode_jabatan', $approval->employee->kode_jabatanplt ?? $approval->employee->kode_jabatan_plt)->first();        
                    if($existing_user){
                        // Periksa apakah 'PLT. ' sudah ada dalam $existing_user->nama_jabatan
                        if (strpos($existing_user->nama_jabatan, 'PLT. ') !== 0) {
                            // Tambahkan 'PLT. ' hanya jika tidak sudah ada sebelumnya
                            $nama_jabatan = 'PLT. ' . $existing_user->nama_jabatan;
                        } else {
                            // Jika 'PLT. ' sudah ada, gunakan $existing_user->nama_jabatan tanpa perubahan
                            $nama_jabatan = $existing_user->nama_jabatan;
                        }

                        // Periksa apakah 'PLT. ' sudah ada dalam $existing_user->nama_jabatan
                        if (strpos($existing_user->nama_level_jabatan, 'PLT. ') !== 0) {
                            // Tambahkan 'PLT. ' hanya jika tidak sudah ada sebelumnya
                            $nama_level_jabatan = 'PLT. ' . $existing_user->nama_level_jabatan;
                        } else {
                            // Jika 'PLT. ' sudah ada, gunakan $existing_user->nama_jabatan tanpa perubahan
                            $nama_level_jabatan = $existing_user->nama_level_jabatan;
                        }

                        $plt_update = [
                            'name' => $approval->employee->nama_pegawai,
                            'nama_jabatan' => $nama_jabatan,
                            'nama_level_jabatan' => $nama_level_jabatan,
                        ];
                        $exsiting_user_approval->update($plt_update);
                    }
                }else{
                    $exsiting_user_approval->update($user_approval);
                }
            }
        }
        // Kembalikan pengguna yang ada atau baru saja dibuat
        return User::where('npp', $employeeData['kode_npp'])->first();
    }
}
