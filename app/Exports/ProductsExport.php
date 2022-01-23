<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductsExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listProductos = [];
    public function setGenerarExcel($listProductos)

    {
        $this->listProductos = $listProductos;

        return  $this;


    }

    public function view(): View
    {
        return view('excel.productos', [
            'productos' => $this->listProductos
        ]);
    }
}
