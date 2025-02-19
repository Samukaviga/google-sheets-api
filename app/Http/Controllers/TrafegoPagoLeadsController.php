<?php

namespace App\Http\Controllers;

use App\Models\TrafegoPagoLeads;
use Illuminate\Http\Request;
use App\Services\GoogleSheetService;


class TrafegoPagoLeadsController extends Controller
{

    protected $googleSheetService;

    public function __construct()
    {
        $this->googleSheetService = new GoogleSheetService();
    }

    public function extractSheetData()
    {

        //Nome da folha localizado no canto inferior esquedo da folha
        //+ range que deseja percorrer
        $range = "TrafegoPago e Leads!A1:P952";

        //O id da folha fica localizado na url logo após o caminho,
        //https://docs.google.com/spreadsheets/d/spreadsheetId/edit#gid=0
        $spreadsheetId = "1SDQ1xsPdA-ijMilvaMiFyiqv6WSrqJZcUTb6MuIiA9Y";

        $values = $this->googleSheetService->getSheetValues($spreadsheetId, $range);


        $headers = $values[0];
        $data = [];

        foreach (array_slice($values, 1) as $row) {
            if (count($row) === count($headers)) {
                // Criação do array associativo
                $data[] = array_combine($headers, $row);
            } else {
                $data[] = ['erro' => 'Número de colunas não corresponde ao número de cabeçalhos'];
            }
        }

        //dd($data[0]);


        // Inserindo ou atualizando os dados no banco
        foreach ($data as $dado) {

        

            // Aqui você pode verificar se já existe um registro com a mesma 'unidade' e 'data'
            $existingRecord = TrafegoPagoLeads::where('unidade', $dado['Unidade'])
                ->where('data', $dado['Data'])
                ->first();

   

            if ($existingRecord) {


                $existingRecord->update(
                    [
                        'unidade' => $dado['Unidade'],
                        'data' => $dado['Data'],
                        'semana' => $dado['Semana'],
                        'meta_gasto_original' => $dado['Meta Gasto Original'],
                        'meta_gasto' => $dado['Meta Gasto'],
                        'valor_gasto' => $dado['Valor Usado'],
                        'status' => $dado['STATUS'],
                        'impressoes' => $dado['Impressões'],
                        'clique_no_link' => $dado['Cliques no Link'],
                        'leads' => $dado['Leads'],
                        'valor_do_lead' => $dado['Valor do Lead'],
                        'acumulado_meta' => $dado['Acumulado Meta'],
                        'acumulado_gasto' => $dado['Acumulado Gasto'],
                        'diferenca' => $dado['Diferença'],
                    ]
                );
            } else {
                // Se não existir, vamos criar um novo registro

                TrafegoPagoLeads::create(
                    [
                        'unidade' => $dado['Unidade'],
                        'data' => $dado['Data'],
                        'semana' => $dado['Semana'],
                        'meta_gasto_original' => $dado['Meta Gasto Original'],
                        'meta_gasto' => $dado['Meta Gasto'],
                        'valor_gasto' => $dado['Valor Usado'],
                        'status' => $dado['STATUS'],
                        'impressoes' => $dado['Impressões'],
                        'clique_no_link' => $dado['Cliques no Link'],
                        'leads' => $dado['Leads'],
                        'valor_do_lead' => $dado['Valor do Lead'],
                        'acumulado_meta' => $dado['Acumulado Meta'],
                        'acumulado_gasto' => $dado['Acumulado Gasto'],
                        'diferenca' => $dado['Diferença'],
                    ]
                );
            }
        }

        return response()->json(['success' => true, 'message' => 'Dados inseridos/atualizados com sucesso!']);
    }
}
