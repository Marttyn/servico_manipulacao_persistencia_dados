<?php

namespace App\Console\Commands;

use App\Models\Data;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImportFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import text file with data to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $files = $this->getFiles();

        $this->startLog($files);

        foreach ($files as $file) {
            $data = Storage::disk('local')->get($file);
            $data = explode("\n", $data);
            array_splice($data, 0, 1);
            foreach ($data as $index => $line) {
                $lineData = preg_split('/ +/', $line, null, PREG_SPLIT_NO_EMPTY);

                $data = new Data();
                $data->cpf = $lineData[0];
                $data->private = $lineData[1];
                $data->incompleto = $lineData[2];
                $data->data_ultima_compra = $lineData[3] !== "NULL" ? $lineData[3] : null;
                $data->ticket_medio = $lineData[4] !== "NULL" ? $lineData[4] : null;
                $data->ticket_ultima_compra = $lineData[5] !== "NULL" ? $lineData[5] : null;
                $data->loja_mais_frequente = $lineData[6] !== "NULL" ? $lineData[6] : null;
                $data->loja_ultima_compra = $lineData[7] !== "NULL" ? $lineData[7] : null;

                $validator = $this->validateData($data);

                if ($validator->fails()) {
                    $this->addErrorMessages($index, $validator);
                    continue;
                }

                $data->save();
            }
        }

        $this->endLog();
    }

    /**
     * Get txt files in storage/app folder
     *
     * @return array
     */
    private function getFiles(): array
    {
        return array_filter(Storage::disk('local')->files(),
            function ($item) {
                if (strpos($item, '.txt')) {
                    return true;
                }
                return false;
            }
        );
    }

    /**
     * Start log message
     *
     * @param  array  $files
     */
    private function startLog(array $files): void
    {
        Log::info("Inicio do processamento de dados");
        Log::info("Arquivos a serem processados");
        Log::info($files);
    }

    /**
     * Validate the data
     *
     * @param  Data  $data
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    private function validateData(Data $data)
    {
        return Validator::make($data->toArray(), [
            'cpf' => 'required|cpf',
            'private' => 'required|boolean',
            'incompleto' => 'required|boolean',
            'data_ultima_compra' => 'nullable|date',
            'ticket_medio' => 'nullable|numeric',
            'ticket_ultima_compra' => 'nullable|numeric',
            'loja_mais_frequente' => 'nullable|cnpj',
            'loja_ultima_compra' => 'nullable|cnpj'
        ]);
    }

    /**
     * Add Validation error messages to the laravel log
     *
     * @param $index
     * @param $validator
     */
    private function addErrorMessages($index, $validator): void
    {
        $lineNumber = $index + 2;
        Log::info("Falha de validação na linha $lineNumber");
        foreach ($validator->errors()->messages() as $error) {
            Log::info($error);
        }
    }

    /**
     * End log message
     */
    private function endLog(): void
    {
        Log::info("Fim do processamento de dados");
    }
}
