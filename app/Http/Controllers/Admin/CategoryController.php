<?php

namespace App\Http\Controllers\Admin;

use App\Events\CategoryUpdated;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\Category;
use App\Models\Admin\File;
use App\Repositories\Admin\CategoryRepository;
use App\Services\File\UploadService;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class CategoryController extends AppBaseController
{
    /** @var CategoryRepository $categoryRepository */
    private $categoryRepository;

    private $uploadService;

    public function __construct(CategoryRepository $categoryRepo, UploadService $uploadService)
    {
        $this->categoryRepository = $categoryRepo;

        $this->uploadService = $uploadService;
    }

    /**
     * Display a listing of the Category.
     */
    public function index(Request $request)
    {
        $categories = $this->categoryRepository->paginate(10);

        return view('admin.categories.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new Category.
     */
    public function create()
    {
        $categories = Category::where('parent_id',0)->get();

        return view('admin.categories.create',['categories' => $categories]);
    }

    /**
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateCategoryRequest $request)
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

        $category = $this->categoryRepository->create($input);

        Flash::success('Category saved successfully.');

        return redirect(route('admin.categories.index'));
    }


    /**
     * Display the specified Category.
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }

        return view('admin.categories.show',[
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified Category.
     */
    public function edit($id)
    {
        $categories = Category::where('parent_id',0)->get();

        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }

        return view('admin.categories.edit',[
            'category' => $category,
            'categories' => $categories
        ]);
    }

    /**
     * @param $id
     * @param UpdateCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $category = $this->categoryRepository->find($id);

        if ($request->file('file_id')) {
            $response = $this->uploadService->uploadImage($request);

            if (!$response["status"]) {
                pd($response["message"]);
            }

            $file_id = $response["data"]["file_id"];

            if ($category->file_id != $file_id) {
                $this->uploadService->delete($category->file_id);

                $category->file_id = $file_id;
            }
        }

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }

        $category->update($request->except("file_id"));

        event(new CategoryUpdated($category));

        Flash::success('Category updated successfully.');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('admin.categories.index'));
        }

        $this->categoryRepository->delete($id);

        Flash::success('Category deleted successfully.');

        return redirect(route('admin.categories.index'));
    }
}
