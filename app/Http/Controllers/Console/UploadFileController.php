<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Models\Console\File\Iki;
use App\Models\Console\Files\Akip;
use Illuminate\Support\Facades\Storage;

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

    protected function previewFile(string $id, string $docType): array
    {
        $res = null;

        if ($docType === 'akip') {
            $file = Akip::where('uuid', $id)->first();
            $res = [
                'message' => 'Dokumen Tersedia',
                'status' => 'success',
                'filename' => $file?->title,
                'url_path' => asset("assets/{$file?->document_path}"),
            ];
        } else if ($docType === 'iki') {
            $file = Iki::with('user', 'user.user_detail')->where('uuid', $id)->first();
            $res = [
                'message' => 'Dokumen tersedia',
                'status' => 'success',
                'filename' => trim("Indeks Kinerja Individu - {$file?->user?->user_detail?->front_title} {$file?->user?->name} {$file?->user?->user_detail?->back_title}"),
                'url_path' => asset("assets/{$file?->document_path}")
            ];
        }

        if (is_null($file)) {
            $res = ['message' => 'Dokumen tidak dapat ditemukan', 'status' => 'error'];
            $statusCode = 404;
        }

        return [$res, $statusCode ?? 200];
    }

    public function actionToFile(string $type, string $id, string $action)
    {
        if ($action === 'download') {
            if ($type === 'iki') {
                $file = Iki::with('user', 'user.user_detail')->where('uuid', $id)->first();
                $res = [
                    'message' => 'Dokumen Tersedia',
                    'status' => 'success',
                    'filename' => trim("Indikator Kinerja Individu - {$file->user->user_detail?->front_title} {$file->user->name} {$file?->user?->user_detail?->back_title}"),
                    'filepath' => asset('assets/' . $file->document_path),
                ];
            } else {
                $file = Akip::where('uuid', $id)->first();
                $res = [
                    'message' => 'Dokumen Tersedia',
                    'status' => 'success',
                    'filename' => $file?->title,
                    'filepath' => asset('assets/' . $file->document_path),
                ];
            }

            if (is_null($file)) {
                $res = ['message' => 'Dokumen tidak dapat ditemukan', 'status' => 'error'];
                $statusCode = 404;
            }

            return response()->json($res, $statusCode ?? 200);
        } else if ($action === 'preview') {
            $data = $this->previewFile($id, $type);

            return response()->json($data[0], $data[1]);
        }
    }
}
