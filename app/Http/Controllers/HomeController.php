<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        list($values, $sorted, $compare, $total, $count) = $this->data($request);

        $idx = count($sorted) - 1;

        $request->session()->put('data', [$values, $sorted, $compare, $total, $count]);

        return view('home', [
            'progress' => round(($total - count($values)) / $total, 2) * 100,
            'compare' => $compare,
            'sorted' => $sorted,
            'idx' => $idx,
        ]);
    }

    public function store(Request $request)
    {
        $idx = intval($request->idx);
        $choice = $request->choice;

        list($values, $sorted, $compare, $total, $count) = $this->data($request);

        // dd([$idx, $choice, $values, $sorted, $compare, $total, $count]);

        if (0 === strcmp($sorted[$idx], $choice)) {
            // $compare is less important than $idx
            array_splice($sorted, $idx + 1, 0, $compare);
            $compare = array_shift($values);
            $idx = count($sorted) - 1;
        } elseif (0 === strcmp($compare, $choice)) {
            // $compare is more important than $idx
            if (0 === $idx) {
                // $compare is most important item
                array_splice($sorted, $idx, 0, $compare);
                $compare = array_shift($values);
                $idx = count($sorted) - 1;
            } else {
                // Need to check $compare against next highest item
                $idx--;
            }
        }

        // We only care about the top $count items
        $sorted = array_slice($sorted, 0, $count);
        if ($idx > ($count-1)) {
            $idx = ($count-1);
        }

        $request->session()->put('data', [$values, $sorted, $compare, $total, $count]);

        return view('home', [
            'progress' => round(($total - count($values)) / $total, 2) * 100,
            'compare' => $compare,
            'sorted' => $sorted,
            'idx' => $idx,
        ]);
    }

    public function reset(Request $request)
    {
        $request->session()->flash('status', 'Your quiz has been reset.');
        $request->session()->forget('data');
        return redirect()->route('home.index');
    }

    protected function data(Request $request)
    {
        if ($request->session()->has('data')) {
            list($values, $sorted, $compare, $total, $count) = $request->session()->get('data');
        } elseif ($request->session()->has('defaults')) {
            list($values, $count) = $request->session()->get('defaults');
            shuffle($values);
            $sorted = [array_shift($values)];
            $compare = array_shift($values);
            $total = count($values);
        } else {
            $values = array_map('trim', config('values.default'));
            shuffle($values);
            $sorted = [array_shift($values)];
            $compare = array_shift($values);
            $total = count($values);
            $count = 5;
        }

        return [$values, $sorted, $compare, $total, $count];
    }
}
