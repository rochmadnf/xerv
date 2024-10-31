<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\Console\Files\Akip;

class UploadFileController extends Controller
{
    protected function getLastYear(): int
    {
        return (int) Akip::latest()->first()?->document_year;
    }

    public function index(string $fileType)
    {
        $initYear = request()->has('year') ? request()->year : (($this->getLastYear() !== 0) ? $this->getLastYear() : now()->format('Y'));
        $files =  $fileType === 'akip' ? Akip::where('document_year', $initYear)->get() : [];
        return view("pages.console.files.$fileType.index", compact('files', 'initYear'));
    }

    public function create(string $fileType)
    {
        return view("pages.console.files.$fileType.create");
    }
}
