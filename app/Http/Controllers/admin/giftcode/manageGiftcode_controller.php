<?php

namespace App\Http\Controllers\admin\giftcode;

use App\Http\Controllers\Controller;
use App\Models\accountModel;
use App\Models\brandsModel;
use App\Models\giftcodeModel;
use App\Models\productsModel;
use Illuminate\Http\Request;

class manageGiftcode_controller extends Controller
{
    public function index()
    {
        $giftcode = Giftcode::all();
        return view('giftcode.index', compact("giftcode"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $giftcode = Giftcode::all();
        return view('giftcode.create', ['giftcode' => $giftcode]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'code' => 'required',
                'detail' => 'required',
                'expired' => 'required',
            ]);
            if($validator->fails()) {
                return redirect() -> back()
                ->withErrors($validator)
                ->withInput();
            }
            $newGiftcode = new Giftcode();
            $newGiftcode->id = $request->id;
            $newGiftcode->code = $request->code;
            $newGiftcode->detail = $request->detail;
            $newGiftcode->expired = $request->expired;
            $newGiftcode->save();
            return redirect()->route('giftcodes.index')
            ->with('success', 'giftcode update successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $giftcode = Giftcode::find($id);
        return view('giftcode.edit', ['giftcode' => $giftcode]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'code' => 'required',
                'detail' => 'required',
                'expired' => 'required',
            ]);
            if($validator->fails()) {
                return redirect() -> back()
                ->withErrors($validator)
                ->withInput();
        }
        $giftcode = Giftcode::find($id);
        if($giftcode != null) {
            $giftcode->code = $request->code;
            $giftcode->detail = $request->detail;
            $giftcode->expired = $request->expired;
            $giftcode->save();
            return redirect()->route('giftcodes.index')
            ->with('success', 'giftcodes update successfully');
        }
        else {
            return redirect()->route('giftcodes.index')
                ->with('Error', 'giftcode not update');

        }

    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $giftcode = Giftcode::find($id);
        $giftcode->delete();
        return redirect()->route('giftcodes.index')
            ->with('success', 'giftcode delete sucessfully');
    }
}
