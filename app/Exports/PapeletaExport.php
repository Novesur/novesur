<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PapeletaExport implements FromView,ShouldAutoSize
{
    use Exportable;
    private $listPapeletaSalida = [];
    private $papeletasalida = [];

    public function setGenerarExcel( $papeletasalida, $listPapeletaSalida)

    {
        $this->listPapeletaSalida = $listPapeletaSalida;
        $this->papeletasalida = $papeletasalida;
        return  $this;
    }

    public function view(): View
    {
        return view('excel.PapeletaSalida', [
            'papeletasalida' => $this->papeletasalida,
            'listPapeletaSalida' => $this->listPapeletaSalida
        ]);
    }
}
