<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $datas = DB::table('menu_modul')->orderBy('key', 'asc')->get();

        // Fungsi untuk menyusun data menjadi array tree
        function buildMenuTree($elements, $parent = null)
        {
            $branch = [];

            foreach ($elements as $element) {
                if ($element->parent == $parent) {
                    $children = buildMenuTree($elements, $element->key);
                    if ($children) {
                        $element->children = $children;
                    }
                    $branch[] = $element;
                }
            }

            return $branch;
        }

        // Menyusun tree menu dari data
        $menuTree = buildMenuTree($datas);

        // dd($menuTree);
        View::composer('components.aside', function ($view) use ($menuTree) {
            $view->with('menus', $menuTree);
        });
    }
}
