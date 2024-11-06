<?php

namespace App\Http\Controllers\Console\File;

use App\Http\Controllers\Controller;
use App\Models\Console\File\Iki;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class IkiController extends Controller
{
    protected function getLastYear(): int
    {
        return (int) Iki::latest()->first()?->document_year;
    }

    public function index()
    {
        $initYear = request()->has('year') ? request()->year : (($this->getLastYear() !== 0) ? $this->getLastYear() : now()->format('Y'));
        $files =  Iki::with('user')->where('document_year', $initYear)->get();
        return view('pages.console.files.iki.index', compact('initYear', 'files'));
    }

    public function create()
    {
        $employees = User::with('user_detail')->notSuperAdmin()->get();
        return view('pages.console.files.iki.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->request->set('asn', intval(explode('--', $request->asn)[0]));

        $validData = $request->validate(
            [
                'doc' => ['required', 'file', 'mimetypes:application/pdf', 'max:76800'],
                'doc_year' => ['required', 'date_format:Y'],
                'asn' => ['required', Rule::exists('users', 'id')],
            ],
            [
                'doc.max' => 'File maksimal 75MB',
            ],
            [
                'doc' => 'Dokumen',
                'doc_year' => 'Tahun',
                'asn' => 'Aparatur Sipil Negara'
            ]
        );

        $docPath = $request->file('doc')->store("docs/iki/{$validData['doc_year']}", ['disk' => 'asset_public']);

        // store to DB
        Iki::create([
            'document_path' => $docPath,
            'document_year' => $validData['doc_year'],
            'user_id' => $validData['asn'],
        ]);

        return back()->with('success', 'Berkas berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $employees = User::with('user_detail')->notSuperAdmin()->get();
        $file = Iki::where('uuid', $id)->firstOrFail();
        return view('pages.console.files.iki.edit', compact('file', 'employees'));
    }

    public function update(string $id, Request $request)
    {
        $request->request->set('asn', intval(explode('--', $request->asn)[0]));

        $validData = $request->validate(
            [
                'doc' => ['nullable', 'file', 'mimetypes:application/pdf', 'max:76800'],
                'doc_year' => ['required', 'date_format:Y'],
                'asn' => ['required', Rule::exists('users', 'id')],
            ],
            [
                'doc.max' => 'File maksimal 75MB',
            ],
            [
                'doc' => 'Dokumen',
                'doc_year' => 'Tahun',
                'asn' => 'Aparatur Sipil Negara'
            ]
        );

        $file = Iki::where('uuid', $id)->firstOrFail();

        if ($request->hasFile('doc')) {
            $docPath = $request->file('doc')->store("docs/iki/{$validData['doc_year']}", ['disk' => 'asset_public']);
            $this->deleteFile($file->document_path);
        }
        if ((int) $file->document_year !== (int) $validData['doc_year']) {
            $movePath = str()->of($docPath ?? $file->document_path)->replace($file->document_year, $validData['doc_year']);
            Storage::disk('asset_public')->move($docPath ?? $file->document_path, $movePath);
        }

        // store to DB
        $file->update([
            'document_path' => $docPath ?? $movePath ?? $file->document_path,
            'document_year' => $validData['doc_year'],
            'user_id' => $validData['asn'],
        ]);

        return back()->with('success', 'Berkas berhasil diubah.');
    }


    public function destroy(string $id)
    {
        $file = Iki::where('uuid', $id)->firstOrFail();
        $this->deleteFile($file->document_path);
        $file->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }

    protected function deleteFile($path): void
    {
        Storage::disk('asset_public')->delete($path);
    }
}
