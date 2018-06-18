<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvancedController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('defaults')) {
            list($values, $count) = $request->session()->get('defaults');
        } else {
            $values = array_map('trim', config('values.default'));
            $count = 5;
        }
        return view('advanced', compact('values', 'count'));
    }

    public function store(Request $request)
    {
        if (0 === strcmp('update', $request->action)) {
            $values = array_map(
                'trim',
                explode(
                    "\n",
                    preg_replace('![\n\r]+!', "\n", $request->values)
                )
            );

            $count = intval($request->count);

            $request->session()->flash('status', 'Your settings have been saved.');

            $request->session()->put('defaults', [$values, $count]);
        } else {
            $request->session()->flash('status', 'Your settings have been reset.');

            $request->session()->forget('defaults');
        }

        $request->session()->forget('data');

        return redirect()->route('advanced.index');
    }
}
