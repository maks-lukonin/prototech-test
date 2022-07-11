<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoursesRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function courses(CoursesRequest $request)
    {
        $validated = $request->validated();

        $rs = Currency::where([
            ['valueID', $validated['valueID']],
            ['date', '>=', $validated['date']['from']],
            ['date', '<=', $validated['date']['to']],
        ])->get();

        return response()->json(CurrencyResource::collection($rs));
    }
}
