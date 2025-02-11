<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // método utilizado para exibir o status da API em formato JSON
    public function status()
    {
        return response()->json(
            [
                'status' => 'OK',
                'message' => 'API is running OK',
            ],
            200
        );
    }

    // método utilizado para exibir todos os clientes
    public function clients()
    {
        // $clients = Client::all(); -> método uzado para exibir todos os dados dos clientes do BD de uma só vez
        $clients = Client::paginate(10); // método uzado para criar paginação, neste caso 10 páginas com com dez registros (total 100 registros no BD)
        return response()->json(
            [
                'status' => 'OK',
                'message' => 'Sucsses!',
                'data' => $clients
            ],
            200
        );
    }

    // método utilizado para exibir cliente pelo ID
    public function clientById($id)
    {
        $client = Client::find($id);

        return response()->json(
            [
                'status' => 'OK',
                'message' => 'Sucsses!',
                'data' => $client
            ],
            200
        );
    }

    // método para certificar se o ID foi fornecido para fazer a busca do cliente pelo ID
    public function client(Request $request)
    {
        // checa se o ID foi fornecido
        if (!$request->id) {
            return response()->json(
                [
                    'status' => 'error',
                    'messege' => 'Client ID is required'
                ],
                400
            );
        }

        $client = Client::find($request->id);

        return  response()->json(
            [
                'status' => 'OK',
                'message' => 'Sucsses!',
                'data' => $client
            ],
            200
        );
    }

    // método utilizado para criar novo cliente
    public function addClient(Request $request)
    {
        $client = new Client();
        $client->nome = $request->nome;
        $client->email = $request->email;
        $client->save();

        return response()->json(
            [
                'status' => 'ok',
                'messege' => 'Sucsses',
                'data' => $client
            ],
            200
        );
    }

    // método utilizado para atualizar informações do cliente
    public function updateClient(Request $request)
    {
        // checa se o ID foi fornecido
        if (!$request->id) {
            return response()->json(
                [
                    "status" => "ok",
                    "message" => "Client ID is required"
                ],
                400
            );
        }

        // atualização do cliente
        $client = Client::find($request->id);
        $client->nome = $request->nome;
        $client->email = $request->email;
        $client->save();

        return response()->json(
            [
                'status' => 'ok',
                'messege' => 'Sucsses',
                'data' => $client
            ],
            200
        );
    }

    // método utilizado para deletar registro de clinte pelo ID
    public function deleteClient($id)
    {
        // busca do cliente pelo ID
        $client = Client::find($id);
        $client->delete();

        return response()->json(
            [
                'status' => 'ok',
                'messege' => 'Cliente removido',
            ],
            200
        );
    }
}
