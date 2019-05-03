<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelaksanaan;
use App\Proyek;
use App\Review;

class PelaksanaanController extends Controller
{
    public function viewLapjusik($id, $idLapjusik){
        $proyek = Proyek::where('id', $id)->first();
        $lapjusik = Pelaksanaan::where('proyek_id', $id)->where('id', $idLapjusik)->first();
        $review = Review::where('pelaksanaan_id', $idLapjusik)->first();
        $lapjusikStatus = $lapjusik->approvalStatus;
        $displayText;

        if($proyek == null  || $lapjusik == null){
            return redirect('/error');
        }
        elseif($lapjusikStatus != 1){
            $displayText = "Tidak dapat menambahkan review karena persetujuan tidak sesuai.";
            return view('detail-lapjusik', ["displayText" => $displayText, "lapjusik" => $lapjusik, "proyek" => $proyek, "id" => $id, 'idLapjusik'=>$idLapjusik]);
        }
        elseif($review == null){
            $displayText = "Belum ada review";
            return view('detail-lapjusik', ["displayText" => $displayText, "lapjusik" => $lapjusik, "proyek" => $proyek, "id" => $id, 'idLapjusik'=>$idLapjusik]);
        }
        else{
            $rating = $review->rating;
            $displayText = $review->description;
            $createdDate = $review->created_at;

            //tambahin pel
            return view('detail-lapjusik', ["displayText" => $displayText, "rating" => $rating, "lapjusik" => $lapjusik, "proyek" => $proyek, "id" => $id, 'idLapjusik'=>$idLapjusik, 'review' => $review, 'createdDate' => $createdDate]);
        }
    }

}
