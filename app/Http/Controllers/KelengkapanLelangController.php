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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function kelolaBerkas($proyek_id)
    {
        $proyek = Proyek::select('proyeks.*')->where('id', $proyek_id)->first();
        $berkass = KelengkapanLelang::select('kelengkapan_lelangs.*')->where('proyek_id', $proyek_id)->where('flag_active', '1')->get();

        $temp = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $temp;

        $statusNum = $proyek-> approvalStatus;
        if($statusNum == 1){
            $status = "DISETUJUI";
        }elseif($statusNum == 2){
            $status = "MENUNGGU LELANG";
        }else{
            $status = "DITOLAK";
        }
//        $templates = ListTemplateSurat::select('list_template_surats.*')->get();
//
//        $files = Files::orderBy('created_at', 'DESC')->paginate(30);
        return view('kelolaLelang', compact('proyek', 'berkass', 'status'));
	}
	public function form($proyek_id){
        $proyek = Proyek::select('proyeks.*')->where('id', $proyek_id)->first();
		return view('file.form', compact('proyek'));
	}
    public function uploadKelengkapanLelang(Request $request){
        $this->validate($request, [
            'title' => 'required|max:100',
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
        session()->flash('flash_message', 'File %s has been uploaded., $file->title');
        DB::table('proyeks')->where('id',$proyek->id)->update([
            'approvalStatus' => 3,
        ]);
        return $this->kelolaBerkas($proyek->id);
    }
    
    public function responseKelengkapanLelang(KelengkapanLelang $file)
    {
        return Storage::response($file->path, $file->filename . '.' . $file->ext);
    }
    /**
     * Download file directly.
     *
     * @param File $file
     * @return void
     */
    public function downloadKelengkapanLelang(KelengkapanLelang $file)
    {
//        dd($file->path);
        return Storage::download($file->path, $file->filename . '.' . $file->ext);
    }
    public function deleteKelengkapanLelang(KelengkapanLelang $file)
    {
        $berkas = KelengkapanLelang::select('kelengkapan_lelangs.*')->where('id', $file->id)->first();
        $proyek = Proyek::select('proyeks.*')->where('id', $file->proyek_id)->first();
        KelengkapanLelang::where('id', $file->id)->update(['flag_active' => 0]);
//        return redirect()->back()->with('flash_message', 'Berkas telah dihapus.');
        return redirect()
            ->back()
            ->withSuccess(sprintf('File %s has been deleted.', $file->filename));
    }
    public function generatePDF($proyek_id)
    {
        $proyek = Proyek::select('proyeks.*')->where('id', $proyek_id)->first();
        $temp = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $temp;
        $data = [
            'projectName' => $proyek->projectName,
            'comp' => $proyek->companyName,
            'addr' => $proyek->projectAddress,
            'val' => $proyek->projectValue,
        ];
        $pdf = PDF::loadView('template-surat/myPDF', $data);

        $dokumenname = 'Surat Penawaran Rekanan';
        
        Storage::put($dokumenname, $pdf->output());
        
        $ext = '.pdf';
        $file = KelengkapanLelang::create([
            'title' => $dokumenname . $ext,
            'filename' => $proyek->projectName . ' - ' . $dokumenname,
            'ext' => '.pdf',
            'path' => $dokumenname,
            'proyek_id' => $proyek->id
        ]);
        
        $pdf->download($proyek->projectName . ' - ' . $dokumenname . '.pdf');

        DB::table('proyeks')->where('id',$proyek->id)->update([
            'approvalStatus' => 3,
        ]);

        return redirect()
            ->back()
            ->withSuccess(sprintf('File %s has been generated.', $file->filename));
    }
    public function generatePDF2($proyek_id)
    {
        $proyek = Proyek::select('proyeks.*')->where('id', $proyek_id)->first();

        $temp = number_format($proyek->projectValue, 2, ',','.');
        $proyek->projectValue = $temp;

        $data = [
            'projectName' => $proyek->projectName,
            'comp' => $proyek->companyName,
            'addr' => $proyek->projectAddress,
            'val' => $proyek->projectValue,
        ];

        $pdf = PDF::loadView('template-surat/myPDF-2', $data);

        $dokumenname = 'Surat Permohonan Jaminan Bank';

        Storage::put($dokumenname, $pdf->output());
        $ext = '.pdf';
        $file = KelengkapanLelang::create([
            'title' => $dokumenname,
            'filename' => $proyek->projectName . ' - ' . $dokumenname,
            'ext' => '.pdf',
            'path' => $dokumenname,
            'proyek_id' => $proyek->id
        ]);

        $pdf->download($proyek->projectName . ' - ' . $dokumenname . '.pdf');

        DB::table('proyeks')->where('id',$proyek->id)->update([
            'approvalStatus' => 3,
        ]);

        return redirect()
            ->back()
            ->withSuccess(sprintf('File %s has been generated.', $file->filename));
    }

}
