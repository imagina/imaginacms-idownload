<?php

namespace Modules\Idownload\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Idownload\Entities\Category;
use Modules\Idownload\Http\Requests\CreateCategoryRequest;
use Modules\Idownload\Http\Requests\UpdateCategoryRequest;
use Modules\Idownload\Repositories\CategoryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CategoryController extends AdminBaseController
{
    /**
     * @var CategoryRepository
     */
    private $category;

    public function __construct(CategoryRepository $category)
    {
        parent::__construct();

        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->paginate(20);
        return view('idownload::admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $categories = $this->category->all();
        return view('idownload::admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategoryRequest $request
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
      try{
        $this->category->create($request->all());

        return redirect()->route('admin.idownload.category.index')
          ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('idownload::categories.title.categories')]));
      }
      catch (\Exception $e){
        \Log::error($e);
        return redirect()->back()
          ->withError(trans('core::core.messages.resource error', ['name' => trans('idownload::categories.title.categories')]))->withInput($request->all());

      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        $categories = $this->category->all();
        return view('idownload::admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Category $category
     * @param  UpdateCategoryRequest $request
     * @return Response
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->category->update($category, $request->all());

        return redirect()->route('admin.idownload.category.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('idownload::categories.title.categories')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        $this->category->destroy($category);
        return redirect()->route('admin.idownload.category.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('idownload::categories.title.categories')]));
    }
}
