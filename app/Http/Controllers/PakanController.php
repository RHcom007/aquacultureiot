<?php

namespace App\Http\Controllers;

use App\Models\PakanTimer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class PakanController extends Controller
{

    public function create()
    {
        return view('timer.add_timer');
    }

    public function insert(Request $request)
    {
        // ddd($request);
        // Validasi request data
        $this->validate($request, [
            'timer' => 'required|date_format:H:i', // Format waktu harus H:i (jam:menit)
            'name' => 'required|string',
        ]);

        // Membuat entri PakanTimer baru dengan data dari request
        $pakanTimer = new PakanTimer;
        $pakanTimer->time = $request->timer;
        $pakanTimer->name = $request->name;
        $pakanTimer->user_id = auth()->user()->id; // Menggunakan ID pengguna yang saat ini terautentikasi
        $pakanTimer->save();
        return redirect()->route('dashboard')->with('success', 'Pakan Timer telah berhasil ditambahkan!');
    }

    public function getTimer(Request $req) {
        $request = $req->json()->all();
        if ($request['getTimer']) {
            $datam = PakanTimer::where('time','>=',Carbon::now()->subMinutes(1))->orderBy('time','ASC')->first();
            $now = Carbon::parse($datam->time);
            $data = [
                'id_feed' => $datam->id,
                'jam' => $now->hour,
                'menit' => $now->minute,
                'detik' => $now->second,
            ];
            return response()->json($data);
        } else {
            return abort(400, 'Data Invalid');
        }
    }
}
