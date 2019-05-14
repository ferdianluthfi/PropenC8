<?php
namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Review;
class ReviewController extends Controller
{
    public function edit($id, Request $request) {
       
        $validator = Validator::make($request->all(), [
            'rating_star' => 'required',
            'komentar' => 'required',
            'idReview' => 'required'
        ]);   
        // return $request->all();
        
        if($validator->fails()) {
            return response()->json([
                'error' => 'Belum mengisi review'
            ],400);
        //    return $request->all();
        } else {
            $review = Review::find($request->idReview);
            $review->rating = $request->rating_star;
            $review->description = $request->komentar;
            $review->updated_at = now('GMT+7');
            $review->save(); 
            // error_log($review);
            return response()->json([], 200);
        }
    }

    public function add(Request $request){

        $validator = Validator::make($request->all(), [
            'rating_star' => 'required',
		    'komentar' => 'required'
        ]);   
        // return $request->all();
        
        if($validator->fails()) {
            return response()->json([
                'error' => 'Belum mengisi review'
            ],400);
        //    return $request->all();
        } else {
            Review::insert([
                'rating' => $request->rating_star,
                'description' => $request->komentar,
                'pelaksanaan_id' => $request->pelaksanaan_id,
                'pengguna_id' => \Auth::user()->id,
                'created_at' => now('GMT+7'),
                'updated_at' => now('GMT+7'),
            ]); 
            
            return response()->json([], 200);
        }
        
    }
}
