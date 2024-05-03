<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\ActivityLog;
use App\Models\MasterDriver;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        $activity_log = ActivityLog::whereDate('created_at', Carbon::now()->toDateString())->get();
        if(Auth::user()->roles->first()->name == 'Driver'){
            $supir = MasterDriver::find(Auth::user()->supir->id);
        }
        return view('users.profile.profile', [
            'user' => $request->user(),
            'activity_log' => $activity_log,
            'supir' => $supir ?? '-'
        ]);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $activity_log = ActivityLog::whereDate('created_at', Carbon::now()->toDateString())->get();
        $supir = MasterDriver::find(Auth::user()->supir->id);
        return view('users.profile.edit', [
            'user' => $request->user(),
            'activity_log' => $activity_log,
            'supir' => $supir
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('users.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request, $id)
    {
        $master_driver = MasterDriver::find($id);
        $message = [
            'nomor_hp.required' => 'nomor hp harus diisi',
            'jk' => 'jenis kelamin harus dipilih',
            'tempat' => 'tempat harus diisi',
            'ttl' => 'tanggal lahir harus diisi',
            'sim' => 'sim harus diisi',
            'jenis_sim' => 'jenis sim harus diisi',
            'habis_sim' => 'masa berlaku sim harus diisi',
            'alamat' => 'alamat harus diisi',
            
        ];
        $validatedData = $request->validate([
            'nomor_hp' => 'required',
            'jk' => 'required',
            'tempat' => 'required',
            'sim' => 'required|array|min:1',
            'ttl' => 'required|date',
            'jenis_sim' => 'required',
            'habis_sim' => 'required|date',
            'alamat' => 'required',
        ], $message);
        $master_driver->update($request->all());
        activity()->log('Melakukan Pembaruan Data Supir: ' . $master_driver->nama);
        toast('Memperbarui Data ' . $master_driver->nama . ' Berhasil!', 'success')->timerProgressBar();

        return redirect(url('profile'))->withInput();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
