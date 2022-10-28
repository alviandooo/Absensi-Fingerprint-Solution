<?php

namespace App\Http\Controllers;

use App\Models\LogAbsensi;
use Illuminate\Http\Request;
use Rats\Zkteco\Lib\ZKTeco;


class AbsensiController extends Controller
{
    public function __construct()
    {
        
    }

    // function ambil data absensi dari mesin
    private function getDataAttendance($ip_mesin){
        $zk = new ZKTeco($ip_mesin);

        try {
            $zk->connect(); 
        } catch (\Throwable $th) {
            // dd($th);
            return $th;
        }

        $att = $zk->getAttendance(); 

        $zk->disconnect(); 

        return $att;
    }

    public function tarikAbsensi()
    {
        $attendances = $this->getDataAttendance("192.168.125.21");
        
        // foreach ($attendances as $key => $attendance) {
        //     $datetime = explode(" ", $attendance["timestamp"]);
        //     LogAbsensi::updateOrCreate(
        //         ["nik"=>$attendance["id"],"tanggal"=>$datetime[0],"waktu"=>$datetime[1],"type"=>$attendance["type"]],
        //         ["uid"=>$attendance["uid"],"nik"=>$attendance["id"],"state"=>$attendance["state"],"tanggal"=>$datetime[0],"waktu"=>$datetime[1],"type"=>$attendance["type"],"updated_at"=>date("Y-m-d H:i:s")]
        //     );
        // }

        foreach ($attendances as $key => $attendance) {
            $datetime = explode(" ", $attendance["timestamp"]);
            LogAbsensi::updateOrCreate(
                ["nik"=>$attendance["id"],"tanggal"=>$datetime[0],"waktu"=>$datetime[1],"type"=>$attendance["type"]],
                ["uid"=>$attendance["uid"],"nik"=>$attendance["id"],"state"=>$attendance["state"],"tanggal"=>$datetime[0],"waktu"=>$datetime[1],"type"=>$attendance["type"],"updated_at"=>date("Y-m-d H:i:s")]
            );
        }
        
        dd($attendance);
    }
}
