<?php

namespace App\Http\Controllers;

use App\Models\Console\Field;
use App\Models\Console\File\Iki;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class IkiController extends Controller
{
    protected function getLastYear(): int
    {
        return (int) Iki::latest()->first()?->document_year;
    }

    public function __invoke(Request $request)
    {
        $initYear = request()->has('year') ? request()->year : (($this->getLastYear() !== 0) ? $this->getLastYear() : now()->format('Y'));

        $files = Iki::with(['user'])->where('document_year', $initYear)->join('user_details', 'user_details.user_id', '=', 'ikis.user_id')->select(
            [
                'user_details.field_id',
                'ikis.user_id',
                'ikis.uuid as iki_uuid',
                'ikis.document_path',
                'ikis.document_year',
            ]
        )->get();

        $fields = Field::select('id', 'name')->get();

        return view('pages.iki', compact('files', 'fields', 'initYear'));
    }

    public function previewFile(string $uuid)
    {
        $file = Iki::with('user', 'user.user_detail')->where('uuid', $uuid)->first();
        if (is_null($file)) {
            return response()->json(['message' => 'Dokumen tidak dapat ditemukan', 'status' => 'error'], 404);
        }

        return response()->json(['message' => 'Dokumen tersedia', 'status' => 'success', 'filename' => trim("Indeks Kinerja Individu - {$file->user->user_detail?->front_title} {$file->user->name} {$file?->user?->user_detail?->back_title}"),  'url_path' => asset("assets/{$file->document_path}")], 200);
    }
}
