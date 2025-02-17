<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayPlans;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $transaccion = Transaction::create(
                [
                    'user_id' => $request->input('user_id'),
                    'transactionable_id' => $request->input('plan_id'),
                    'transactionable_type' => 'App\Models\Plan',
                    'amount' => $request->input('monto'),
                    'bank_id' => $request->input('bank_id'),
                    'currency' => $request->input('currency'),
                    'payment_method' => $request->input('id_method'),
                    'payment_status' => 'Pendiente',
                    'transaction_date' => $request->input('payment_date')
                ]
            );
            TransactionDetail::create(
                [
                    'transaction_id' => $transaccion->id,
                    'item' => 'Cambio/renovación de Plan',
                    'quantity' => '1',
                    'unit_price' => $request->input('monto'),
                    'description' => $request->input('description'),
                    'subtotal' => $request->input('monto'),
                ]
            );
            PayPlans::create(
                [
                    'plan_id' => $request->input('plan_id'),
                    'user_id' => $request->input('user_id'),
                    'transaction_id' => $transaccion->id,
                    'payment_methods_id' => $request->input('id_method'),
                    'date' => $request->input('payment_date'),
                    'amount' => $request->input('monto'),
                    'reference' => $request->input('reference'),
                    'status' => 'Pendiente',
                ]
            );

            DB::commit();
            Toastr::success(__('Added successfully'), __('Plan'));
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            Toastr::error(__('An error occurred please try again'), 'error');
        }
        return to_route('plans.index');
    }

    public function consult($id)
    {
        $monto = Plan::select('price')->where('id', $id)->first();
        return response()->json($monto);
    }
}