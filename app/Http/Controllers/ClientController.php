<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Client;
use App\Models\Queue1;
use App\Models\Queue2;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function index()
    {
        // Obtencion de datos para la tabla general
        $clients = Client::latest()->paginate(5);
        //

        // ============================================================
        // CONSULTAS PARA LA COLA 1
        // ============================================================

            // Consulta para traer el primer registro de la cola
            $query1first = DB::table('clients')
                        ->join('queue1s', 'queue1s.client_id', '=', 'clients.id')
                        ->select('clients.name as name', 'queue1s.client_id as id')
                        ->get()
                        ->first();
            //
            // Consulta para el total de registros de la cola 1
            $count1 = DB::table('queue1s')->count()-1;
            //

            // Consulta para traer el ultimo registro de la cola
            $query1last = DB::table('clients')
                        ->join('queue1s', 'queue1s.client_id', '=', 'clients.id')
                        ->select('clients.name as name', 'queue1s.client_id as id')
                        ->get()
                        ->last();
            //
        // ============================================================

        // ============================================================
        // CONSULTAS PARA LA COLA 2
        // ============================================================

            // Consulta para traer el primer registro de la cola
            $query2first = DB::table('clients')
                        ->join('queue2s', 'queue2s.client_id', '=', 'clients.id')
                        ->select('clients.name as name', 'queue2s.client_id as id')
                        ->get()
                        ->first();
            //
            // Consulta para el total de registros de la cola 1
            $count2 = DB::table('queue2s')->count()-1;
            //

            // Consulta para traer el ultimo registro de la cola
            $query2last = DB::table('clients')
                        ->join('queue2s', 'queue2s.client_id', '=', 'clients.id')
                        ->select('clients.name as name', 'queue2s.client_id as id')
                        ->get()
                        ->last();
            //
        // ============================================================

        return view('clients.index',compact('clients','query1first','count1','query1last','query2first','count2','query2last'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);


            Client::create([
               'name' => $request->name,
               'status' => 'En Espera'
            ]);
            // Consulta para seleccionar el id del ultimo registro y enviarlo a una de las condiciones
            $temp = DB::select('SELECT max(id) AS id FROM clients');

            $count1 = DB::table('queue1s')->count()*2;
            $count2 = DB::table('queue2s')->count()*3;

            if($count1>$count2){
                Queue2::create([
                    'client_id'     => $temp[0]->id,
                ]);
            }elseif($count1=$count2){
                Queue1::create([
                    'client_id'     => $temp[0]->id,
                ]);
            }else{
                Queue1::create([
                    'client_id'     => $temp[0]->id,
                ]);
            }


        return redirect()->route('clients.index')
                        ->with('success','Client created successfully.');
    }

    public function destroy(Client $client)
    {
        //
        $client->delete();

        return redirect()->route('clients.index')
                        ->with('success','Client deleted successfully');
    }
}
