<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\File;
use App\Repositories\Admin\BannerRepository;
use Illuminate\Http\Request;
use App\Services\File\UploadService;
use Flash;

class BannerController extends AppBaseController
{
    /** @var BannerRepository $bannerRepository*/
    private $bannerRepository;

    private $uploadService;

    public function __construct(BannerRepository $bannerRepo, UploadService $uploadService)
    {
        $this->bannerRepository = $bannerRepo;

        $this->uploadService = $uploadService;
    }

    /**
     * Display a listing of the Banner.
     */
    public function index(Request $request)
    {
        $banners = $this->bannerRepository->paginate(10);

        return view('admin.banners.index')
            ->with('banners', $banners);
    }

    /**
     * Show the form for creating a new Banner.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created Banner in storage.
     */
    public function store(CreateBannerRequest $request)
    {
        $input = $request->all();

        if ($request->file('file_id')) {
            $response = $this->uploadService->uploadImage($request);

            if (!$response["status"]) {
                pd($response["message"]);
            }

            $input['file_id'] = $response["data"]["file_id"];
        }

        if (empty($input['file_id'])) {
            $input['file_id'] = File::IMG_DEFAULT;
        }

        $banner = $this->bannerRepository->create($input);

        Flash::success('Banner saved successfully.');

        return redirect(route('admin.banners.index'));
    }

    /**
     * Display the specified Banner.
     */
    public function show($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('admin.banners.index'));
        }

        return view('admin.banners.show')->with('banner', $banner);
    }

    /**
     * Show the form for editing the specified Banner.
     */
    public function edit($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('admin.banners.index'));
        }

        return view('admin.banners.edit')->with('banner', $banner);
    }

    /**
     * Update the specified Banner in storage.
     */
    public function update($id, UpdateBannerRequest $request)
    {
        $banner = $this->bannerRepository->find($id);

        if ($request->file('file_id')) {
            $response = $this->uploadService->uploadImage($request);

            if (!$response["status"]) {
                pd($response["message"]);
            }

            $file_id = $response["data"]["file_id"];

            if ($banner->file_id != $file_id) {
                $this->uploadService->delete($banner->file_id);

                $banner->file_id = $file_id;
            }
        }

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('admin.banners.index'));
        }

        $banner->update($request->except("file_id"));

        Flash::success('Banner updated successfully.');

        return redirect(route('admin.banners.index'));
    }

    /**
     * Remove the specified Banner from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('admin.banners.index'));
        }

        $this->bannerRepository->delete($id);

        Flash::success('Banner deleted successfully.');

        return redirect(route('admin.banners.index'));
    }
}
