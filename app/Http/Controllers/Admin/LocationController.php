<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateLocationRequest;
use App\Http\Requests\Admin\UpdateLocationRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\LocationRepository;
use Illuminate\Http\Request;
use Flash;

class LocationController extends AppBaseController
{
    /** @var LocationRepository $locationRepository*/
    private $locationRepository;

    public function __construct(LocationRepository $locationRepo)
    {
        $this->locationRepository = $locationRepo;
    }

    /**
     * Display a listing of the Location.
     */
    public function index(Request $request)
    {
        $locations = $this->locationRepository->paginate(10);

        return view('admin.locations.index')
            ->with('locations', $locations);
    }

    /**
     * Show the form for creating a new Location.
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created Location in storage.
     */
    public function store(CreateLocationRequest $request)
    {
        $input = $request->all();

        $location = $this->locationRepository->create($input);

        Flash::success('Location saved successfully.');

        return redirect(route('admin.locations.index'));
    }

    /**
     * Display the specified Location.
     */
    public function show($id)
    {
        $location = $this->locationRepository->find($id);

        if (empty($location)) {
            Flash::error('Location not found');

            return redirect(route('admin.locations.index'));
        }

        return view('admin.locations.show')->with('location', $location);
    }

    /**
     * Show the form for editing the specified Location.
     */
    public function edit($id)
    {
        $location = $this->locationRepository->find($id);

        if (empty($location)) {
            Flash::error('Location not found');

            return redirect(route('admin.locations.index'));
        }

        return view('admin.locations.edit')->with('location', $location);
    }

    /**
     * Update the specified Location in storage.
     */
    public function update($id, UpdateLocationRequest $request)
    {
        $location = $this->locationRepository->find($id);

        if (empty($location)) {
            Flash::error('Location not found');

            return redirect(route('admin.locations.index'));
        }

        $location = $this->locationRepository->update($request->all(), $id);

        Flash::success('Location updated successfully.');

        return redirect(route('admin.locations.index'));
    }

    /**
     * Remove the specified Location from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $location = $this->locationRepository->find($id);

        if (empty($location)) {
            Flash::error('Location not found');

            return redirect(route('admin.locations.index'));
        }

        $this->locationRepository->delete($id);

        Flash::success('Location deleted successfully.');

        return redirect(route('admin.locations.index'));
    }
}
