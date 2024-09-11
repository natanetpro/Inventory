<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenMenuController extends Controller
{
    public $title = 'Manajemen Menu';

    public function index()
    {
        $menus = DB::table('menu_modul')
            ->orderBy(DB::raw('CAST(regexp_replace(key, \'[^0-9\.]\', \'\', \'g\') AS FLOAT)'), 'ASC')
            ->get();
        // dd($menus);
        return view('pages.konfigurasi.menus.index', [
            'title' => $this->title,
            'menus' => $menus
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'level' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->level as $key => $value) {
                $textLevel = '';

                // delete all level checklist
                DB::table('menu_modul')->where('id', $key)->update([
                    'level1' => false,
                    'level2' => false,
                    'level3' => false,
                    'level4' => false,
                    'level5' => false,
                    'level6' => false,
                    'level7' => false,
                    'level8' => false,
                    'level9' => false,
                ]);

                // update level checklist
                foreach ($value as $level) {
                    DB::table('menu_modul')->where('id', $key)->update([
                        'level' . $level => true,
                    ]);
                    // increment text level
                    $textLevel .= $level;
                }

                // update text level
                DB::table('menu_modul')->where('id', $key)->update([
                    'textlevel' => $textLevel,
                ]);

                // reset text level
                $textLevel = '';
            }
            DB::commit();
            return redirect()->back()->with('success', 'Menu berhasil diupdate');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
