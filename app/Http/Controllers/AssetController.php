<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function assetUploader(Request $request)
    {
        $uploadedFile = $request->file('file');
        Storage::disk('public')->deleteDirectory('chezpack');
        $filePath = Storage::disk('public')->putFile('chezpack', $uploadedFile);
        Asset::query()->delete();
        $product_asset = new Asset();
        $product_asset->asset_id = 1;
        $product_asset->file_path = $filePath;
        $product_asset->file_name = $uploadedFile->getClientOriginalName();
        $product_asset->file_type = $uploadedFile->getClientOriginalExtension();
        $product_asset->save();
        return $product_asset;
    }

    /**
     * Display the specified resource.
     */
    public function assetRetriever()
    {
        $fileData = Asset::all()->first();
        $file = Storage::url($fileData->file_path);

        $fileDataArray = $fileData->toArray();
        $fileDataArray['created_at'] = Carbon::parse($fileData->created_at)->format('F j, Y, H:i');
        $fileDataArray['updated_at'] = Carbon::parse($fileData->updated_at)->format('F j, Y, H:i');

        return response()->json(['fileUrl' => $file, 'data' => $fileDataArray]);
    }
}
