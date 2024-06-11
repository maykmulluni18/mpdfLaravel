<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ReportXlsx implements FromView
{
    protected $data;
    protected $view;

    public function __construct(array $data, string $view)
    {
        $this->data = $data;
        $this->view = $view;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {

        return view('/xlsxReport/' . $this->view, [
            'data' => $this->data
        ]);
    }
}
