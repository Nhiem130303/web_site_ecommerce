<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateAttributeRequest;
use App\Http\Requests\Admin\UpdateAttributeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\AttributeRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Str;

class AttributeController extends AppBaseController
{
    /** @var AttributeRepository $attributeRepository */
    private $attributeRepository;

    public function __construct(AttributeRepository $attributeRepo)
    {
        $this->attributeRepository = $attributeRepo;
    }

    /**
     * Display a listing of the Attribute.
     */
    public function index()
    {
        $attributes = $this->attributeRepository->paginate(10);

        return view('admin.attributes.index')
            ->with('attributes', $attributes);
    }

    /**
     * Show the form for creating a new Attribute.
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created Attribute in storage.
     */
    public function store(CreateAttributeRequest $request)
    {
        $input = $request->all();

        $attribute = $this->attributeRepository->create($input);

        Flash::success('Attribute saved successfully.');

        return redirect(route('admin.attributes.index'));
    }

    /**
     * Display the specified Attribute.
     */
    public function show($id)
    {
        $attribute = $this->attributeRepository->find($id);

        if (empty($attribute)) {
            Flash::error('Attribute not found');

            return redirect(route('attributes.index'));
        }

        return view('admin.attributes.show')->with('attribute', $attribute);
    }

    /**
     * Show the form for editing the specified Attribute.
     */
    public function edit($id)
    {
        $attribute = $this->attributeRepository->find($id);

        if (empty($attribute)) {
            Flash::error('Attribute not found');

            return redirect(route('attributes.index'));
        }

        return view('admin.attributes.edit')->with('attribute', $attribute);
    }

    /**
     * Update the specified Attribute in storage.
     */
    public function update($id, UpdateAttributeRequest $request)
    {
        $attribute = $this->attributeRepository->find($id);

        if (empty($attribute)) {
            Flash::error('Attribute not found');

            return redirect(route('attributes.index'));
        }

        $attribute = $this->attributeRepository->update($request->all(), $id);

        Flash::success('Attribute updated successfully.');

        return redirect(route('admin.attributes.index'));
    }

    /**
     * Remove the specified Attribute from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $attribute = $this->attributeRepository->find($id);

        if (empty($attribute)) {
            Flash::error('Attribute not found');

            return redirect(route('admin.attributes.index'));
        }

        $this->attributeRepository->delete($id);

        Flash::success('Attribute deleted successfully.');

        return redirect(route('admin.attributes.index'));
    }
}
