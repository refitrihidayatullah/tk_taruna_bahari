<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_sekolah = DB::table('users')->crossJoin('tb_user', 'users.id', '=', 'tb_user.user_id')->select('users.id', 'users.name', 'users.email', 'tb_user.username', 'tb_user.role', 'users.image_user', 'tb_user.updated_at')->get();

        return view('backend.management_sekolah.user_sekolah', ['user_sekolah' => $user_sekolah]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image_user')) {
            // jika ada file image
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required:unique',
                'password' => 'required',
                'password1' => 'required|same:password',
                'image_user' => 'mimes:jpg,jpeg,png,gif'
            ], [
                'name.required' => 'Nama Guru harus diisi',
                'username.required' => 'Username Harus diisi',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'password harus diisi',
                'password1.required' => 'password harus diisi',
                'password1.same' => 'password tidak sama',
                'image_user.mimes' => 'image harus berformat jpg,jpeg,png,gif'
            ]);
            $image_file = $request->file('image_user');
            $image_extension = $image_file->extension();
            $image_rename = "Guru_Taruna" . "_" . date('d_m_y_h_i_s') . "_" . Str::random(10) . "." . $image_extension;
            $image_file->move(public_path('guru_images'), $image_rename);
            try {
                // memulai tansaksi database => jika salah satu insert tabel gagal maka semua transaksi di rollback
                DB::beginTransaction();

                // insert data users dan mengambil generate id_user untuk di gunakan di table tb_user
                $UserId = DB::table('users')->insertGetId([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => 1,
                    'image_user' => $image_rename,
                    'password' => Hash::make($request->password),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                DB::table('tb_user')->insert([
                    'user_id' => $UserId,
                    'username' => $request->username,
                    'role' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                DB::commit();
                return redirect('user-sekolah')->with('success', 'Data berhasil ditambahkan');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('user-sekolah')->withErrors($validator)->with('failed', 'Terjadi kesalahan' . $e->getMessage());
            }
        } else {
            // jika tidak ada file image
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required:unique',
                'password' => 'required',
                'password1' => 'required|same:password',
            ], [
                'name.required' => 'Nama Guru harus diisi',
                'username.required' => 'Username Harus diisi',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'password harus diisi',
                'password1.required' => 'password harus diisi',
                'password1.same' => 'password tidak sama'
            ]);
            try {
                // memulai tansaksi database => jika salah satu insert tabel gagal maka semua transaksi di rollback
                DB::beginTransaction();

                // insert data users dan mengambil generate id_user untuk di gunakan di table tb_user
                $UserId = DB::table('users')->insertGetId([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => 1,
                    'password' => Hash::make($request->password),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                DB::table('tb_user')->insert([
                    'user_id' => $UserId,
                    'username' => $request->username,
                    'role' => 1,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                DB::commit();
                return redirect('user-sekolah')->with('success', 'Data berhasil ditambahkan');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('user-sekolah')->withErrors($validator)->with('failed', 'Terjadi kesalahan' . $e->getMessage());
            }
        }




        // if ($validator->fails()) {
        //     return redirect('user-sekolah')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        // } else {

        //     return redirect('user-sekolah')->with('success', 'Data Berhasil Ditambahkan');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // jika ada file image upload
        if ($request->hasFile('image_user')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required',
                'image_user' => 'mimes:jpg,jpeg,png,gif'
            ], [
                'name.required' => 'Nama Guru harus diisi',
                'username.required' => 'Username Harus diisi',
                'email.required' => 'Email harus diisi',
                'image_user.mimes' => 'image harus berformat jpg,jpeg,png,gif'
            ]);
            $image_file = $request->file('image_user');
            $image_extension = $image_file->extension();
            $image_rename = "Guru_Taruna" . "_" . date('d_m_y_h_i_s') . "_" . Str::random(10) . "." . $image_extension;
            $image_file->move(public_path('guru_images'), $image_rename);
            // lalu cek jika ada file image lama maka hapus file tersebut
            $data_image_lama = DB::table('users')->crossJoin('tb_user', 'users.id', '=', 'tb_user.user_id')->where('users.id', $id)->first();
            FILE::delete(public_path('guru_images') . '/' . $data_image_lama->image_user);

            try {
                // memulai tansaksi database => jika salah satu updated tabel gagal maka semua transaksi di rollback
                DB::beginTransaction();

                DB::table('users')->where('users.id', $id)->update([
                    'name' => $request->name,
                    'image_user' => $image_rename,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
                DB::table('tb_user')->where('tb_user.user_id', $id)->update([
                    'user_id' => $id,
                    'username' => $request->username,
                    'role' => $request->role,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                DB::commit();
                return redirect('user-sekolah')->with('success', 'Data Berhasil  DiUpdate');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('user-sekolah')->withErrors($validator)->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
            }
        } else {
            // jika tidak ada file image upload
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required',

            ], [
                'name.required' => 'Nama Guru harus diisi',
                'username.required' => 'Username Harus diisi',
                'email.required' => 'Email harus diisi',

            ]);
            if ($validator->fails()) {
                return redirect('user-sekolah')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
            } else {
                try {
                    // memulai tansaksi database => jika salah satu updated tabel gagal maka semua transaksi di rollback
                    DB::beginTransaction();

                    DB::table('users')->where('users.id', $id)->update([
                        'name' => $request->name,
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                    DB::table('tb_user')->where('tb_user.user_id', $id)->update([
                        'user_id' => $id,
                        'username' => $request->username,
                        'role' => $request->role,
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);

                    DB::commit();
                    return redirect('user-sekolah')->with('success', 'Data Berhasil  DiUpdate');
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect('user-sekolah')->withErrors($validator)->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
                }
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // try {
        //     DB::statement('SET FOREIGN_KEY_CHECKS=0'); // Nonaktifkan konstrain referensial
        //     DB::table('users')->truncate(); // Melakukan truncate pada tabel
        //     DB::table('tb_user')->truncate(); // Melakukan truncate pada tabel
        //     DB::statement('SET FOREIGN_KEY_CHECKS=1'); // Aktifkan kembali konstrain referensial

        //     return redirect('user-sekolah')->with('success', 'data berhasil dikosongkan');
        // } catch (\Exception $e) {
        //     return redirect('user-sekolah')->with('failed', 'Terjadi kesalahan' . $e->getMessage());
        // }
        try {
            // lalu cek jika ada file image lama maka hapus file tersebut
            $data_image_lama = DB::table('users')->crossJoin('tb_user', 'users.id', '=', 'tb_user.user_id')->where('users.id', $id)->first();
            FILE::delete(public_path('guru_images') . '/' . $data_image_lama->image_user);
            DB::table('users')->where('users.id', $id)->delete();
            return redirect('user-sekolah')->with('success', 'Data Berhasil Didelete');
        } catch (\Exception $e) {
            return redirect('user-sekolah')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }
    public function login()
    {
        $data['title'] = 'Login';
        return view('backend.login', $data);
    }
    public function loginAction(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'username harus diisi',
            'password.required' => 'password harus diisi'
        ]);

        $credensial = $request->only('email', 'password');

        if (Auth::attempt($credensial)) {
            return redirect()->intended('/dashboard');
        } else {
            return redirect('login')->with('password', 'wrong password or username');
        }
        // $result = DB::table('users')->crossJoin('tb_user', 'users.id', '=', 'tb_user.user_id')
        //     ->select('users.id', 'users.password', 'tb_user.username', 'tb_user.user_id')
        //     ->where('tb_user.username', $username)
        //     ->first();

        // if ($result && Hash::check($password, $result->password)) {
        //     if (Auth::check()) {
        //         $user = Auth::user();
        //         return redirect('/', ['user' => $user])->intended('/')->with('success', 'berhasil login');
        //     } else {
        //         return redirect('login');
        //     }
        // } else {
        //     return redirect('login')->with('password', 'wrong password or username');
        // }
    }
    public function logoutAction(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            return redirect('login');
        }
    }
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'new_password1' => 'required|same:new_password'
        ], [
            'old_password.required' => 'Old Password Harus diisi',
            'new_password.required' => 'New Password Harus diisi',
            'new_password1.required' => 'Password confirm Harus diisi',
            'new_password1.same' => 'Password tidak sama'
        ]);
        if ($validator->fails()) {
            return redirect('/dashboard')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            $user = Auth::user();
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect('/dashboard')->with('failed', 'Terjadi Kesalahan Password Lama Tidak sama');
            }
            // $users = new User;
            $update = Hash::make($request->new_password);
            DB::table('users')->update([
                'password' => $update
            ]);
            return redirect('/dashboard')->with('success', 'Password berhasil di ubah');
        }
    }
}
