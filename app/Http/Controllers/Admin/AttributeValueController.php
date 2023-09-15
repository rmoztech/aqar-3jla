<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeValueRequest;
use App\Repositories\AttributeValueRepository;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function __construct(private AttributeValueRepository $attributeValueRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeValueRequest $request)
    {
        $this->attributeValueRepository->create($request);
        return redirect()->back()->with('add-success',__('success_messages.attribute.value.add.success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeValueRequest $request)
    {
        $this->attributeValueRepository->update($request,$request->id);
        return redirect()->back()->with('edit-success',__('success_messages.attribute.value.edit.success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->attributeValueRepository->delete($request->id);
        return redirect()->back()->with('delete-success',__('success_messages.attribute.value.delete.success'));
    }
}
