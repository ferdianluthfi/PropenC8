<?php

namespace App\Http\Controllers;

use App\Proyek;
use Illuminate\Http\Request;
use App\KelengkapanLelang;
use App\Files;
use App\ListTemplateSurat;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Storage;

class KelengkapanLelangController extends Controller
{
    public function kelolaBerkas($proyek_id){
        $proyek = Proyek::select('proyeks.*')->where('id', $proyek_id)->first();

        $berkass = KelengkapanLelang::select('kelengkapan_lelangs.*')->where('proyek_id', $proyek_id)->get();

        $templates = ListTemplateSurat::select('list_template_surats.*')->get();

        $files = Files::orderBy('created_at', 'DESC')->paginate(30);
        return view('kelolaLelang', compact('proyek', 'berkass', 'templates', 'files'));
	}

	public function form(): View {
		return view('file.form');
	}

	public function upload(Request $request): RedirectResponse {
		$this->validate($request, [
            'title' => 'nullable|max:100',
            'file' => 'required|file|max:2000'
        ]);

        $uploadedFile = $request->file('file');        

        $path = $uploadedFile->store('public/files');

        $file = Files::create([
            'title' => $request->title ?? $uploadedFile->getClientOriginalName(),
            'filename' => $path
        ]);

        return redirect()
            ->back()
            ->withSuccess(sprintf('File %s has been uploaded.', $file->title));     
	}
	
	public function response(File $file)
    {
        return Storage::response($file->filename);
    }

    /**
     * Download file directly.
     *
     * @param File $file
     * @return void
     */
    public function download(File $file)
    {
        return Storage::download($file->filename, $file->title);
    }
}
