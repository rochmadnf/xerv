<?php

namespace App\Http\Controllers;

use App\Models\Console\Files\Akip;
use Illuminate\Http\Request;

class AkipController extends Controller
{
    protected function getLastYear(): int
    {
        return (int) Akip::latest()->first()?->document_year;
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $initYear = request()->has('year') ? request()->year : (($this->getLastYear() !== 0) ? $this->getLastYear() : now()->format('Y'));
        $files = Akip::where('document_year', $initYear)->get();

        return view('pages.akip', compact('files', 'initYear'));
    }
}
