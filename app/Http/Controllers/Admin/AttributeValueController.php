<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateAttributeValueRequest;
use App\Http\Requests\Admin\UpdateAttributeValueRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\Attribute;
use App\Repositories\Admin\AttributeValueRepository;
use Illuminate\Http\Request;
use Flash;

class AttributeValueController extends AppBaseController
{
    /** @var AttributeValueRepository $attributeValueRepository*/
    private $attributeValueRepository;

    public function __construct(AttributeValueRepository $attributeValueRepo)
    {
        $this->attributeValueRepository = $attributeValueRepo;
    }

    /**
     * Display a listing of the AttributeValue.
     */
    public function index(Request $request)
    {
        $attributeValues = $this->attributeValueRepository->paginate(10);

        return view('admin.attribute_values.index')
            ->with('attributeValues', $attributeValues);
    }

    /**
     * Show the form for creating a new AttributeValue.
     */
    public function create()
    {
        $attributes = Attribute::all();

        return view('admin.attribute_values.create', [
            'attributes' => $attributes
        ]);
    }

    /**
     * Store a newly created AttributeValue in storage.
     */
    public function store(CreateAttributeValueRequest $request)
    {
        $input = $request->all();

        $attributeValue = $this->attributeValueRepository->create($input);

        Flash::success('Attribute Value saved successfully.');

        return redirect(route('admin.attributeValues.index'));
    }

    /**
     * Display the specified AttributeValue.
     */
    public function show($id)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('admin.attributeValues.index'));
        }

        return view('admin.attribute_values.show')->with('attributeValue', $attributeValue);
    }

    /**
     * Show the form for editing the specified AttributeValue.
     */
    public function edit($id)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        $attributes = Attribute::all();

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('admin.attributeValues.index'));
        }

        return view('admin.attribute_values.edit')
            ->with('attributes', $attributes)
            ->with('attributeValue', $attributeValue);
    }

    /**
     * Update the specified AttributeValue in storage.
     */
    public function update($id, UpdateAttributeValueRequest $request)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('admin.attributeValues.index'));
        }

        $attributeValue = $this->attributeValueRepository->update($request->all(), $id);

        Flash::success('Attribute Value updated successfully.');

        return redirect(route('attributeValues.index'));
    }

    /**
     * Remove the specified AttributeValue from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }

        $this->attributeValueRepository->delete($id);

        Flash::success('Attribute Value deleted successfully.');

        return redirect(route('admin.attributeValues.index'));
    }
}
