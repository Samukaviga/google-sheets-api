<?php

namespace App\Console\Commands;

use App\Models\EnviosVisitas;
use App\Services\GoogleSheetService;
use Illuminate\Console\Command;

class UpdateSheetEnviosVisitasCommand extends Command
{
   
    protected $signature = 'app:update-sheet-data';
    protected $description = 'Command description';

    
    protected $googleSheetService;

    // Construtor para injetar dependências
    public function __construct(GoogleSheetService $googleSheetService)
    {
        parent::__construct();
        $this->googleSheetService = $googleSheetService;
    }

    public function handle()
    {
         //Nome da folha localizado no canto inferior esquedo da folha
        //+ range que deseja percorrer
        $range = "Envios e Visitas!A1:K1004";

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

        // Inserindo ou atualizando os dados no banco
        foreach ($data as $dado) {
            // Aqui você pode verificar se já existe um registro com a mesma 'unidade' e 'data'
            $existingRecord = EnviosVisitas::where('unidade', $dado['Unidade'])
                ->where('data', $dado['Data'])
                ->first();

            if ($existingRecord) {

                $existingRecord->update(
                    [
                    'unidade' => $dado['Unidade'],
                    'data' => $dado['Data'],
                    'semana' => $dado['Semana'],
                    'meta_envios' => $dado['Meta  de Envios '],
                    'enviados' => $dado['Enviados'],
                    'faltou' => $dado['Faltou'],
                    'meta_agendamentos' => $dado['Meta Agendamento'],
                    'agendamentos' => $dado['Agendamentos'],
                    'meta_visitas' => $dado['Meta de Visitas'],
                    'visitas_realizadas' => $dado['Visitas Realizadas'],
                    'status' => $dado['Status'],
                ]);
                
            } else {
                // Se não existir, vamos criar um novo registro

                EnviosVisitas::create(
                    [
                        'unidade' => $dado['Unidade'],
                        'data' => $dado['Data'],
                        'semana' => $dado['Semana'],
                        'meta_envios' => $dado['Meta  de Envios '],
                        'enviados' => $dado['Enviados'],
                        'faltou' => $dado['Faltou'],
                        'meta_agendamentos' => $dado['Meta Agendamento'],
                        'agendamentos' => $dado['Agendamentos'],
                        'meta_visitas' => $dado['Meta de Visitas'],
                        'visitas_realizadas' => $dado['Visitas Realizadas'],
                        'status' => $dado['Status'],
                    ]);
            }
        }

       // return response()->json(['success' => true, 'message' => 'Dados inseridos/atualizados com sucesso!']);

       $this->info('Dados atualizados com sucesso!');
   
    }
}
