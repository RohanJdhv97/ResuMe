<?php

namespace App\Http\Controllers;

use App\Models\CandidateQualification;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Smalot\PdfParser\Parser;
use Spatie\PdfToText\Pdf;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

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
    public function test(Request $request)
    {
        $user_id = 12;
        $file = $request->file('pdf');

        // Store the file temporarily
        $tempPath = $file->storeAs('temp', $file->getClientOriginalName());
        $parser = new Parser();
        $pdf = $parser->parseFile(storage_path("app/$tempPath"));
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
        foreach($converted as $dbData){
            CandidateQualification::create([
                'qualification' => $dbData?->qualification,
                'scored' => (int) $dbData?->scored,
                'user_id' => $user_id
            ]);
        }

        return response()->json([
            'message' => 'education qualification saved successfully'
        ], 200);
        
    }

}
