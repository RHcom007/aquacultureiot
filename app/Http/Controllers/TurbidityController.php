<?php

namespace App\Http\Controllers;

use App\Models\Turbidity;
use App\Models\TurbidityTreshold;
use Illuminate\Http\Request;

class TurbidityController extends Controller
{
    public function getTreshold(Request $req) {
        $request = $req->json()->all();
        // Log::info($request);
        if ($request['turbidity']) {
            Turbidity::create([
                'data' => $request['turbidity'],
                'token' => $request['token']
            ]);
            $datat = TurbidityTreshold::where('token',82323)->first();
            $data = [
                'tturbidity' => $datat->ttreshold
            ];
            return response()->json($data);
        } else {
            return abort(400, 'Data Invalid');
        }
    }

    public function setTreshold(Request $req) {
        $validate = $req->validate([
            'setTreshold'=>'required|boolean'
        ]);
        $lastturbidity = Turbidity::latest()->first();
        TurbidityTreshold::where('token',82323)->update([
            'tturbidity' => 700
        ]);
        return response('Berhasil set turbidity',200);
    }
}
