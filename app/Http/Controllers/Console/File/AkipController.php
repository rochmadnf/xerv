<?php

namespace App\Http\Controllers\Console\File;

use App\Http\Controllers\Controller;
use App\Models\Console\Files\Akip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AkipController extends Controller
{
    public function store(Request $request)
    {
        $validData = $request->validate(
            [
                'title' => ['required', 'string', 'min:3', 'max:150'],
                'doc' => ['required', 'file', 'mimetypes:application/pdf', 'max:76800'],
                'doc_year' => ['required', 'date_format:Y'],
                'pic' => ['required', 'string', 'min:3'],
            ],
            [
                'doc.max' => 'File maksimal 75MB',
            ],
            [
                'title' => 'Nama Dokumen',
                'doc' => 'Dokumen',
                'doc_year' => 'Tahun',
                'pic' => 'Penanggung Jawab'
            ]
        );

        $docPath = $request->file('doc')->store("docs/akip/{$validData['doc_year']}", ['disk' => 'asset_public']);

        // store to DB
        Akip::create([
            'title' => $validData['title'],
            'document_path' => $docPath,
            'document_year' => $validData['doc_year'],
            'pic' => $validData['pic'],
        ]);

        return back()->with('success', 'Berkas berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $file = Akip::where('uuid', $id)->firstOrFail();
        return view('pages.console.files.akip.edit', compact('file'));
    }

    public function editFile(string $id)
    {
        $file = Akip::where('uuid', $id)->firstOrFail();
        return view('pages.console.files.akip.edit-file', compact('file'));
    }

    public function update(string $id, Request $request)
    {
        $validData = $request->validate(
            [
                'title' => ['required', 'string', 'min:3', 'max:150'],
                'doc_year' => ['required', 'date_format:Y'],
                'pic' => ['required', 'string', 'min:3'],
            ],
            [],
            [
                'title' => 'Nama Dokumen',
                'doc_year' => 'Tahun',
                'pic' => 'Penanggung Jawab'
            ]
        );

        $file = Akip::where('uuid', $id)->firstOrFail();
        $file->update($validData);

        return back()->with('success', 'Berkas berhasil diubah.')->withInput();
    }

    public function updateFile(string $id, Request $request)
    {
        $validData = $request->validate(
            [
                'doc' => ['required', 'file', 'mimetypes:application/pdf', 'max:76800'],
            ],
            [
                'doc.max' => 'File maksimal 75MB',
            ],
            [
                'doc' => 'Dokumen',
            ]
        );


        $file = Akip::where('uuid', $id)->firstOrFail();
        $this->deleteFile($file->document_path);

        $docPath = $request->file('doc')->store("docs/akip/{$file->document_year}", ['disk' => 'asset_public']);

        $file->update([
            'document_path' => $docPath,
        ]);

        return back()->with('success', 'Dokumen berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $file = Akip::where('uuid', $id)->firstOrFail();
        $this->deleteFile($file->document_path);
        $file->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }

    protected function deleteFile($path): void
    {
        Storage::disk('asset_public')->delete($path);
    }
}
