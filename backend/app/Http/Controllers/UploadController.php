<?php

namespace App\Http\Controllers;

use App\Imports\CsvImport;
use App\Mail\Boletos;
use App\Models\Uploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    static function listUploads(){
        $listAll = Uploads::all();
        $boletosPendentes = Uploads::where('boleto', 0)->orWhere('boleto', null)->count();
        return response()->json( [
            'message' => 'Lista de uploads via CSV',
            'data' => [
                'boletos_pendentes' => $boletosPendentes,
                'list' => $listAll
            ]
        ]);
    }

    public function uploadCsv(Request $request){
        $file = $request->file('file');
        Excel::import(new CsvImport, $file);
        return response()->json([
            'message' => 'Upload realizado com sucesso',
            'data' => []
        ]);

    }

    public function processarBoletos(){
        $boletosPendentes = Uploads::where('boleto', 0)->orWhere('boleto', null)->get()->toArray();
        foreach($boletosPendentes as $boleto){
            $this->gerarBoleto($boleto['debtID']);
            $this->enviarEmail($boleto['name'], $boleto['email']);
        }

        if(count($boletosPendentes) > 0){
            Uploads::where('boleto', 0)->orWhere('boleto', null)->update(['boleto' => 1]);
            $message = 'Foram enviados '.count($boletosPendentes).' boletos com sucesso.';
        } else {
            $message = 'Nenhum boleto para enviar.';
        }

        return response()->json([
            'message' => $message,
            'data' => []
        ]);
    }

    public function gerarBoleto($debtid){
        // Função para gerar boleto com base no $debtID (demanda muito tempo e muitas outras infos para gerar um boleto no nome da pessoa, como CPF, endereço, etc)
    }

    public function enviarEmail(string $name, string $email)
    {
        $details = [
            'subject' => 'Você possui um novo boleto',
            'from' => 'contato@kanastra.com.br',
            'to' => $email,
            'body' => '<p>Olá '.$name.', tudo bem? Você possui um novo boleto para pagamento.</p>'
        ];

        Mail::to($details['to'])->send(new Boletos($details));

        return 'E-mail enviado com sucesso!';
    }
}
