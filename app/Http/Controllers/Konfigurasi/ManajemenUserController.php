<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Fomatter\ResponseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenUserController extends Controller
{
    public $title = 'Manajemen User';

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = DB::select('SELECT * FROM users');
            return datatables()->of($users)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="user-' . $data->id . '" class="edit btn btn-primary btn-sm" tabindex="3" onclick="openModal(' . "'edit'" . ', ' . $data->id . ')">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="user-' . $data->id . '" class="delete btn btn-danger btn-sm" tabindex="4" onclick="deleteUser(' . $data->id . ')">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.konfigurasi.users.index', [
            'title' => $this->title,
        ]);
    }

    public function find($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        if ($user) {
            return ResponseController::success($user, 'Data ditemukan');
        } else {
            return ResponseController::error('Data tidak ditemukan', 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required',
            'jabatan' => 'required|in:Administrator,Supervisor,Staff,Kasir',
            'level' => 'required|in:1,2,3,4,5,6,7,8,9'
        ]);

        DB::beginTransaction();
        try {
            $user = DB::table('users')->insert([
                'nama' => $request->nama,
                'password' => bcrypt($request->password),
                'jabatan' => $request->jabatan,
                'level' => $request->level
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'nullable',
            'jabatan' => 'required|in:Administrator,Supervisor,Staff,Kasir',
            'level' => 'required|in:1,2,3,4,5,6,7,8,9'
        ]);

        DB::beginTransaction();
        try {
            if ($request->password) {
                $user = DB::table('users')->where('id', $id)->update([
                    'nama' => $request->nama,
                    'password' => bcrypt($request->password),
                    'jabatan' => $request->jabatan,
                    'level' => $request->level
                ]);
            } else {
                $user = DB::table('users')->where('id', $id)->update([
                    'nama' => $request->nama,
                    'jabatan' => $request->jabatan,
                    'level' => $request->level
                ]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Data gagal diupdate');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = DB::table('users')->where('id', $id)->delete();
            DB::commit();
            return ResponseController::success(null, 'Data berhasil dihapus');
        } catch (Exception $e) {
            DB::rollback();
            return ResponseController::error('Data gagal dihapus');
        }
    }
}
