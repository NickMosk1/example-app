<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Lead;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProcessLeadApi extends Command
{
    protected $signature = 'lead:process {url} {--data=*}';
    protected $description = 'Process lead data from API';

    public function handle()
    {
        $url = $this->argument('url');
        $data = $this->option('data');

        // Если данные переданы как опция
        if (!empty($data)) {
            $input = $this->parseInputData($data);
            return $this->createLead($input);
        }

        // Если URL передан - делаем запрос
        try {
            $response = Http::get($url);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['data']) && is_array($data['data'])) {
                    foreach ($data['data'] as $leadData) {
                        $this->createLead($leadData);
                    }
                    $this->info('All leads processed successfully!');
                    return 0;
                }
                
                return $this->createLead($data);
            }
            
            $this->error('API request failed: ' . $response->status());
            return 1;
            
        } catch (\Exception $e) {
            $this->error('Error processing API request: ' . $e->getMessage());
            return 1;
        }
    }

    protected function parseInputData(array $data): array
    {
        $result = [];
        foreach ($data as $item) {
            if (str_contains($item, '=')) {
                [$key, $value] = explode('=', $item, 2);
                $result[$key] = $value;
            }
        }
        return $result;
    }

    protected function createLead(array $data): int
    {
        $validator = Validator::make($data, [
            'full_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|string|max:255',
            'status' => 'required|string|in:' . implode(',', Lead::getStatuses()),
        ]);

        if ($validator->fails()) {
            $this->error('Validation failed: ' . json_encode($validator->errors()));
            return 1;
        }

        try {
            $lead = Lead::create($validator->validated());
            $this->info("Lead created successfully! ID: {$lead->id}");
            return 0;
        } catch (\Exception $e) {
            $this->error('Error creating lead: ' . $e->getMessage());
            return 1;
        }
    }
}
