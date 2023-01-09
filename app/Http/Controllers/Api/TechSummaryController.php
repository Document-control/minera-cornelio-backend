<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchPhoto;
use App\Models\Courier;
use App\Models\DetailExpCourier;
use App\Models\Expense;
use App\Models\ExpensePhoto;
use App\Models\FactoryPlant;
use App\Models\TechSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TechSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // PLANTA
            $fp = FactoryPlant::create([
                'name' => $request->factory_plant
            ]);


            $tech_before = TechSummary::orderBy('id', 'DESC')->first();

            $tech = TechSummary::create([
                'initial_month'    => $request->month_id,
                'factory_tmh'      => $request->factory_tmh,
                'trader'           => $request->trader,
                'trader_number'    => $request->trader_number,
                'amount_acu'       => $tech_before->amount_acu + $request->amount_pen,
                'amount_pen'       => $request->amount_pen,
                'start_date'       => $request->start_date,
                'contract_id'      => 1,
                'client_id'        => 1,
                'factory_plant_id' => $fp->id,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            foreach ($request->batches as $key => $batch) {
                $batch = Batch::create([
                    'qty' => $batch['qty'],
                    'price' => $batch['price'],
                    'total_prov' => $batch['total'],
                ]);

                $batch->minerals()->attach($batch['minerals']);

                if (count($batch['files']) > 0) {
                    foreach ($batch['files'] as $key => $file) {
                        // $request->validate([
                        //     'name' => 'required|max:255',
                        //     // 'image' => 'required|mimes:jpg,png|max:2048',
                        //     'image' => 'required|max:2048',
                        // ]);

                        $batch_photo = new BatchPhoto();
                        $batch_photo->name = $file->getClientOriginalName();
                        $batch_photo->slug = Str::slug($batch_photo);
                        $extension  = $file->getClientOriginalExtension(); //This is to get the extension of the image file just uploaded
                        $file_name = time() . '-' . $batch_photo->slug . '.' . $extension;
                        $path = $request->file('image')->storePubliclyAs(
                            'batchs',
                            $file_name,
                            's3'
                        );

                        $batch_photo->path = $path;
                        $batch_photo->ext = $extension;
                        $batch_photo->batch_id = $batch->id;
                        $batch_photo->save();
                    }
                }
            }



            $expense = Expense::create([
                'type_id' => 1,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $total_exp = 0;

            foreach ($request->couriers as $key => $courier) {
                $new_courier = Courier::create([
                    'name' => $courier['company']
                ]);

                $dec = DetailExpCourier::create([
                    'plates' => $courier['plates'],
                    'weight' => $courier['weight'],
                    'total' => $courier['total'],
                    'start_date' => $courier['start_date'],
                    'expense_id' => $expense->id,
                    'courier_id' => $new_courier->id,
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]);

                $total_exp += $courier['total'];

                if (count($courier['files']) > 0) {
                    foreach ($courier['files'] as $key => $file) {
                        // $request->validate([
                        //     'name' => 'required|max:255',
                        //     // 'image' => 'required|mimes:jpg,png|max:2048',
                        //     'image' => 'required|max:2048',
                        // ]);

                        $courier_photo = new ExpensePhoto();
                        // $courier_photo->end_date   = @$file['end_date'];

                        $courier_photo->name = $file->getClientOriginalName();
                        $courier_photo->slug = Str::slug($courier_photo);
                        $extension  = $file->getClientOriginalExtension(); //This is to get the extension of the image file just uploaded
                        $file_name = time() . '-' . $courier_photo->slug . '.' . $extension;
                        $path = $request->file('image')->storePubliclyAs(
                            'couriers',
                            $file_name,
                            's3'
                        );

                        $courier_photo->nro        = $file['nro'];
                        $courier_photo->amount     = $file['amount'];
                        $courier_photo->start_date = $file['start_date'];
                        $courier_photo->path = $path;
                        $courier_photo->ext = $extension;
                        $courier_photo->imageable_id   = $dec->id;
                        $courier_photo->imageable_type = $dec->id;
                        $courier_photo->save();
                    }
                }
            }

            $expense->total = $total_exp;
            $expense->save();

            $tech_before->end_date = $request->start_date;
            $tech_before->save();
            DB::commit();
            return response()->json(['status' => true, 'message' => 'RT creado correctamente']);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response        
     */
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
