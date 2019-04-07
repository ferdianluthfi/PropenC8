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
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;
use PDF;

class KelengkapanLelangController extends Controller
{
    public function kelolaBerkas($proyek_id)
    {
        $proyek = Proyek::select('proyeks.*')->where('id', $proyek_id)->first();
        $berkass = KelengkapanLelang::select('kelengkapan_lelangs.*')->where('proyek_id', $proyek_id)->where('flag_active', '1')->get();

        $templates = ListTemplateSurat::select('list_template_surats.*')->get();

        $files = Files::orderBy('created_at', 'DESC')->paginate(30);
        return view('kelolaLelang', compact('proyek', 'berkass', 'templates', 'files'));
	}

	public function form($proyek_id){
        $proyek = Proyek::select('proyeks.*')->where('id', $proyek_id)->first();
		return view('file.form', compact('proyek'));
	}

    public function uploadKelengkapanLelang(Request $request): RedirectResponse {
        $this->validate($request, [
            'title' => 'nullable|max:100',
            'file' => 'required|file|max:2000'
        ]);

        $uploadedFile = $request->file('file');        

        $path = $uploadedFile->store('files');

        $proyek = Proyek::select('proyeks.*')->where('id', $request->proyekId)->first();
        $proyek_id = $proyek->id;
        $filename = $proyek->projectName . ' - ' . $request->title;

        $file = KelengkapanLelang::create([
            'title' => $request->title ?? $uploadedFile->getClientOriginalName(),
            'filename' => $filename,
            'ext' => $uploadedFile->getClientOriginalExtension(),
            'path' => $path,
            'proyek_id' => $request->proyekId
        ]);

        return redirect()
            ->back()
            ->withSuccess(sprintf('File %s has been uploaded.', $file->title));     
    }
    
    public function responseKelengkapanLelang(KelengkapanLelang $file)
    {
        return Storage::response($file->path);
    }

    /**
     * Download file directly.
     *
     * @param File $file
     * @return void
     */
    public function downloadKelengkapanLelang(KelengkapanLelang $file)
    {
        return Storage::download($file->path, $file->filename . '.' . $file->ext);
    }

    public function deleteKelengkapanLelang(KelengkapanLelang $file)
    {
        $berkas = KelengkapanLelang::select('kelengkapan_lelangs.*')->where('id', $file->id)->first();
        $proyek = Proyek::select('proyeks.*')->where('id', $file->proyek_id)->first();

        KelengkapanLelang::where('id', $file->id)->update(['flag_active' => 0]);
        return $this->kelolaBerkas($proyek->id);
    }

    public function generatePDF($proyek_id)
    {
        $proyek = Proyek::select('proyeks.*')->where('id', $proyek_id)->first();

        $data = [
            'title' => $proyek->name,
            'projectName' => 'Propensi ',
            'desc' => 'Kopek terus aja bibirnya sampe copot semua ok'
        ];

        $pdf = PDF::loadView('template-surat/myPDF', $data);

        $dokumenname = 'Dokumen 1';
        
        Storage::put($dokumenname, $pdf->output());
        
        $ext = '.pdf';

        $file = KelengkapanLelang::create([
            'title' => 'Dokumen 1',
            'filename' => $proyek->name . ' - ' . $dokumenname,
            'ext' => '.pdf',
            'path' => 'public/files/' . $dokumenname . $ext,
            'proyek_id' => $proyek->id
        ]);

        return $pdf->download('hehehehe.pdf');
    }

    public function generatePDF2($proyek_id)
    {
        $proyek = Proyek::select('proyeks.*')->where('id', $proyek_id)->first();

        $data = [
            'title' => $proyek->namaProyek,
            'projectName' => 'Propensi ',
            'desc' => 'Kopek terus aja bibirnya sampe copot semua ok'
        ];

        $pdf = PDF::loadView('template-surat/myPDF', $data);

        $dokumenname = 'Dokumen 2';

        Storage::put($dokumenname, $pdf->output());

        $ext = '.pdf';

        $file = KelengkapanLelang::create([
            'title' => 'Dokumen 2',
            'filename' => $proyek->name . ' - ' . $dokumenname,
            'ext' => '.pdf',
            'path' => 'public/files/' . $dokumenname . $ext,
            'proyek_id' => $proyek->id
        ]);

        return $pdf->download('hehehehe.pdf');
    }
}
