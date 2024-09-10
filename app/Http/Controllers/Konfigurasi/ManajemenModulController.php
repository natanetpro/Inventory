<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Fomatter\ResponseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenModulController extends Controller
{
    public $title = 'Manajemen Modul';

    public function index(Request $request)
    {
        $moduls = DB::table('menu_modul')->orderBy('key')->paginate(10);
        // if ($request->ajax()) {
        //     return datatables()->of($moduls)
        //         ->addColumn('action', function ($data) {
        //             $button = '<button type="button" name="edit" id="module-' . $data->id . '" class="edit btn btn-primary btn-sm" tabindex="3" onclick="openModal(' . "'edit'" . ', ' . $data->id . ')">Edit</button>';
        //             $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="module-' . $data->id . '" class="delete btn btn-danger btn-sm" tabindex="4" onclick="deleteModule(' . $data->id . ')">Delete</button>';
        //             return $button;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }

        return view('pages.konfigurasi.moduls.index', [
            'title' => $this->title,
            'moduls' => $moduls,
        ]);
    }

    public function find($id)
    {
        $modul = DB::table('menu_modul')->where('id', $id)->first();
        if ($modul) {
            return ResponseController::success($modul, 'Data ditemukan');
        } else {
            return ResponseController::error('Data tidak ditemukan', 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'grup' => 'required',
            'nama_modul' => 'required',
            'nama_url' => 'nullable',
            // 'file_path' => 'nullable',
        ]);
        DB::beginTransaction();
        try {
            // data modul
            $data = explode('-', $request->grup);

            // set parent
            $parent = $data[0] . '_';

            // set key by checking last child of its parent for example the parent is 1, the last child will be 1.01 use dots to separate the parent and the child and add _ at the end
            $key = DB::table('menu_modul')
                ->where('parent', $parent)
                ->orderBy(DB::raw('LENGTH(`key`)'), 'desc') // Backticks around `key`
                ->orderBy('key', 'desc')
                ->first();

            if ($key) {
                $keyParts = explode('.', rtrim($key->key, '_'));
                $lastPart = array_pop($keyParts);
                $newLastPart = str_pad((int) $lastPart + 1, 2, '0', STR_PAD_LEFT);
                $key = implode('.', $keyParts) . '.' . $newLastPart . '_';
            } else {
                $key = str_replace('_', '.', $parent) . '01_';
            }

            // set kode key from parent but without _
            $kode_key = str_replace('_', '', $parent);

            // set kode modul from key but without _
            $kode_modul = str_replace('_', '', $key);

            // set kode grup
            $kode_grup = $data[0];

            // set nama modul
            $nama_modul = $request->nama_modul;

            // set nama grup
            $nama_grup = $data[1];

            // set nama url
            $nama_url = $request->nama_url ?? '#';

            // insert data
            DB::table('menu_modul')->insert([
                'key' => $key,
                'parent' => $parent,
                'kode_modul' => $kode_modul,
                'kode_key' => $kode_key,
                'nama_modul' => $nama_modul,
                'kode_grup' => $kode_grup,
                'nama_grup' => $nama_grup,
                'nama_url' => $nama_url ?? '#',
                // 'file_path' => $request->file_path ?? null,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'grup' => 'required',
            'nama_modul' => 'required',
            'nama_url' => 'nullable',
            // 'file_path' => 'nullable',
        ]);
        DB::beginTransaction();
        try {
            // update data
            DB::table('menu_modul')->where('id', $id)->update([
                'nama_modul' => $request->nama_modul,
                'nama_url' => $request->nama_url,
                // 'file_path' => $request->file_path ?? null,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            DB::table('menu_modul')->where('id', $id)->delete();
            DB::commit();
            return ResponseController::success(null, 'Data berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseController::error($e->getMessage(), 500);
        }
    }
}
