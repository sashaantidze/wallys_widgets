<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Http\Requests\WidgetsAmountRequest;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use App\Services\WidgetPacksService;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PackageResource::collection(Package::orderBy('size', 'DESC')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageRequest $request)
    {
        $package = Package::create($request->all());

        //return response(new PackageResource($package), Response::HTTP_CREATED);
        return new PackageResource($package);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return new PackageResource($package);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageRequest  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        $package->update($request->all());

        return new PackageResource($package);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }



    public function packs(WidgetsAmountRequest $request)
    {
        $packs = Package::orderBy('size', 'DESC')->pluck('size')->toArray();

        if(!$packs){
            return response(['errors' => ['massage' => 'There are no packages right now']]);
        }
        
        $packsAmount = WidgetPacksService::calculatePacksAmount($packs, $request->amount);

        return response(['data' => ['packs' => $packsAmount]]);
    }
}
