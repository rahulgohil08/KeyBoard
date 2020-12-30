<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{


    /*----------------------------------------- Get Keyword Suggestions ------------------------------------------*/

    public function readJSONFile(Request $request)
    {
        $file = public_path('countries.json');
        $file = file_get_contents($file);

        foreach (json_decode($file) as $data) {

            Suggestion::create([
                'keyword' => $data->name
            ]);

        }

        return "Insert Success";

    }


    /*----------------------------------------- Get Keyword Suggestions ------------------------------------------*/


    public function getSuggestions(Request $request)
    {
        $keyword = $request->keyword;

        $data = Suggestion::query()
            ->where('keyword', 'like', $keyword . '%')
            ->get(['keyword']);

        return response()->json($data, 200, [], JSON_PRETTY_PRINT);

    }


}
