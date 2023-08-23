<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Auth;
use App\Models\Employee;
use App\Models\ChatGptLog;
use App\Models\CompanyStorage;
use App\Models\Page;

class ChatGptController extends Controller
{
    public function index() {
        return view('AI.ask-index');
    }

    public function textCompletion(Request $request): JsonResponse
    {
        $sentence = $request->chatgpt;
        $role = $request->role;
        // $setting_chatgpt = setting('site.new_business_fair_copy_chatgpt');
        // $search = str_replace("%text_area%", $sentence, $setting_chatgpt);
        $search = $sentence;
        if($role == 1){
            if(str_contains($search, 'dark mode')){

                $employee = Employee::where('id', Auth::id())->first();
                if($employee->dark_mode == 0){
                    Employee::where('id', Auth::id())->update(['dark_mode' => 1]);
                }
                else{
                    Employee::where('id', Auth::id())->update(['dark_mode' => 0]);
                }
                $data = [
                    'success' => true,
                    'type' => 'dark_mode'
                ];
                return response()->json($data, 200, array(), JSON_PRETTY_PRINT);
            }
            elseif(str_contains($search, 'page') && str_contains($search, 'go to')){
                $pages = Page::where('status', 1)->get();
                foreach($pages as $page){
                    if(str_contains($search, $page->key)){
                        $data = [
                            'success' => true,
                            'type' => 'go_page',
                            'url' => $page->url,
                        ];
                        
                        return response()->json($data, 200, array(), JSON_PRETTY_PRINT);
                    }
                }
            }
            elseif(str_contains($search, 'company')){
                $company_storages = CompanyStorage::where('status', 1)->get();
                foreach($company_storages as $store) {
                    if(str_contains($search, $store->key)){
                        $data['choices'][0]['message']['content'] = $store->value;
                        ChatGptLog::create([
                            'employee_id' => Auth::id() ?? 0,
                            'prompt' => $search,
                            'response' => $data['choices'][0]['message']['content']
                        ]);
                        return response()->json($data['choices'][0]['message'], 200, array(), JSON_PRETTY_PRINT);
                    }
                }
            }
        }

        $employee_id = Auth::id();
        $data = $this->makeCallApiChatGpt($search, $employee_id);
        // $data['choices'][0]['message'] = ['content' => 'caxxxxxxxxx',
        //                                     'role' => 'assistant'];
        $args = [
            'customer_id' => $employee_id ?? 0,
            'type' => 0,
            'promt' => $search,
            'response' => $data['choices'][0]['message']['content'],
        ];

        //save chat log
        ChatGptLog::create([
            'employee_id' => $employee_id ?? 0,
            'prompt' => $search,
            'response' => $data['choices'][0]['message']['content']
        ]);

        $data['choices'][0]['message']['root'] = $sentence;


        
        return response()->json($data['choices'][0]['message'], 200, array(), JSON_PRETTY_PRINT);

    }
    
    public function makeCallApiChatGpt($search, $employee_id){
        $previousChatLogs = ChatGptLog::where('employee_id', $employee_id)->orderBy('id', 'desc')->take(6)->get();
        $previousConversation = '';
        foreach($previousChatLogs as $log){
            $previousConversation .= "\nUser: " . $log->prompt . "\nChatGPT: " . $log->response;
        }
        $currentQuestion = $search;
        $fullPrompt = 'regarding the previous question and answer:'.'\n' . $previousConversation . "\nCurrent question: " . $currentQuestion;
        dd($fullPrompt);
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.env('OPENAI_API_KEY'),
          ])
          ->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-3.5-turbo",
            'messages' => [
                [
                   "role" => "user",
                   "content" =>count($previousChatLogs) > 0 ? $fullPrompt : $search
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
