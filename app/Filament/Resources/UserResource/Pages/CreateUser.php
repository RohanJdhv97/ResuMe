<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\CandidateQualification;
use Aws\S3\S3Client;
use Filament\Resources\Pages\CreateRecord;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Smalot\PdfParser\Parser;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    /**
     * Summary of mutateFormDataBeforeCreate
     * @param array $data
     * @return array
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $actualPassword = Str::random(6);
        $data['password'] = Hash::make($actualPassword);
        $data["company_id"] = 1;
        $data['role_id'] = 3;
        return $data;
    }

    protected function afterCreate(): void
    {
        // Setup AWS S3 Client
        $s3Client = new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);

        // Fetch the PDF file from S3
        $result = $s3Client->getObject([
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $this->record->url // Replace with your S3 file path
        ]);

        // Get the content of the PDF
        $pdfContent = $result['Body'];

        // Parse the PDF content
        $pdfParser = new Parser();
        $pdf = $pdfParser->parseContent($pdfContent);
        $text = $pdf->getText();
        // return $text;
        $client = new Client();

        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY') // Assuming you have your API key in the .env file.
            ],
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        "role" => "system",
                        "content" => "You are helpful assistance"
                    ],
                    [
                        "role" => "user",
                        "content" => $text
                    ],
                    [
                        "role" => "assistant",
                        "content" => "I want the education qualification details from the above content. Here is the example to the format of expected output from you.\n[\n  ['\''qualification'\'' => '\''B.E'\'', '\''scored'\''=>'\''30'\'']\n  ['\''qualification'\'' => '\''MCA'\'', '\''scored'\'' => '\''50'\'']\n]\nTake this array of object in laravel as a example and give me the education qualifications in qualification key and scored in the scored key without `%` character. make each qualification a object and place all objects in an array format of laravel. There can be CGPA instead of percentage if that is the case then convert CGPA to percentage, the scored key must have only converted percentage value without `%` character. I don'\''t need any other text, I need only array as response from you. "
                    ],
                ],
                'temperature' => 0.5,
                'max_tokens' => 3547,
                'top_p' => 1,
                'frequency_penalty' => 0,
                'presence_penalty' => 0
            ]
        ]);

        $responseBody = $response->getBody()->getContents();
        // Decode the JSON
        $jsonResponse = json_decode($responseBody, true);

        // Extract the content data
        $contentData = $jsonResponse['choices'][0]['message']['content'] ?? null;
        $converted = $this->convertToObjects($contentData);
        // return $converted;
        foreach ($converted as $dbData) {
            CandidateQualification::create([
                'qualification' => $dbData?->qualification,
                'scored' => (int) $dbData?->scored,
                'user_id' => $this->record->id
            ]);
        }
    }

    public function convertToObjects(string $data): Collection
    {
        // Match the inner arrays
        preg_match_all("/\[(.*?)\]/s", $data, $matches);

        $array = [];

        foreach ($matches[1] as $match) {
            // Split the matched string by comma but not within single quotes
            $items = preg_split("/,(?=(?:[^']*'[^']*')*[^']*$)/", $match);
            $itemArray = [];

            foreach ($items as $item) {
                // Extract key-value pairs
                preg_match("/'([^']+)'\s*=>\s*'([^']+)'/", $item, $kv);
                $itemArray[$kv[1]] = $kv[2];
            }

            $array[] = $itemArray;
        }

        // Convert to Laravel collection of objects
        return collect($array)->map(function ($item) {
            return (object) $item;
        });
    }
}
