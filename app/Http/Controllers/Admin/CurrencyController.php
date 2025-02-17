<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();
        return view('admin.currency.index', compact('currencies'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if ($request['is_principal'] == 'on') {
            $request['is_principal'] = 1;
            $change = Currency::where('is_principal', 1);
            $change->update(['is_principal' => 0]);
        } else {
            $request['is_principal'] = 0;
        }
        // dd($request->all());
        try {
            Currency::create($request->all());
            Toastr::success(__('Added successfully'), __('Currency') . ' ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return to_route('currencies.index');
    }

    public function edit($id)
    {
        $currency = Currency::find($id);
        return response()->json([$currency]);
    }

    public function update(Request $request, $id)
    {
        if ($request['is_principal'] == 'on') {
            $request['is_principal'] = 1;
            $change = Currency::where('is_principal', 1);
            $change->update(['is_principal' => 0]);
        } else {
            $request['is_principal'] = 0;
        }
        try {
            $currency = Currency::find($id);
            $currency->update($request->post());
            Toastr::success(__('Updated registration'), __('Currency') . ' ' . $request->input('name'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }

        return to_route('currencies.index');
    }
    public function destroy($id)
    {
        try {
            $currency = Currency::find($id);
            $currency->delete();
            Toastr::success(__('Registration Successfully Disabled'), __('Deleted'));
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('currencies.index');
    }
}