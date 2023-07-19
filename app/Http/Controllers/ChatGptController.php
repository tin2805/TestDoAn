<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class ChatGptController extends Controller
{
    public function index() {
        return view('AI.ask-index');
    }

    public function textCompletion(Request $request): JsonResponse
    {
        $sentence = $request->chatgpt;
        
        // $setting_chatgpt = setting('site.new_business_fair_copy_chatgpt');
        // $search = str_replace("%text_area%", $sentence, $setting_chatgpt);
        $search = $sentence;
        // $data = $this->makeCallApiChatGpt($search);
        $data['choices'][0]['message'] = ['content' => 'caxxxxxxxxx',
                                            'role' => 'assistant'];
        $args = [
            'customer_id' => \Auth::user()->id ?? 0,
            'type' => 0,
            'promt' => $search,
            'response' => $data['choices'][0]['message']['content'],
        ];

        $data['choices'][0]['message']['root'] = $sentence;


        
        return response()->json($data['choices'][0]['message'], 200, array(), JSON_PRETTY_PRINT);

    }
    
    public function makeCallApiChatGpt($search){
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.env('OPENAI_API_KEY'),
          ])
          ->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-3.5-turbo",
            'messages' => [
                [
                   "role" => "user",
                   "content" => $search
               ]
            ],
            'temperature' => 0.5,
            "max_tokens" => 500,
            "top_p" => 1.0,
            "frequency_penalty" => 0.52,
            "presence_penalty" => 0.5,
          ])
          ->json();
    }
}
