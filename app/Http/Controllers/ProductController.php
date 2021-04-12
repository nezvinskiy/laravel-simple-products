<?php

namespace App\Http\Controllers;

use App\DataTransferObject\ProductDTO;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Interfaces\ProductServiceInterface;
use App\Interfaces\CategoryServiceInterface;
use App\Commands\Products\CreateProductCommand;
use App\Commands\Products\DeleteProductCommand;
use App\Commands\Products\UpdateProductCommand;
use App\Mappers\CategoryMapper;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    private ProductServiceInterface $productService;
    private CategoryServiceInterface $categoryService;
    private CreateProductCommand $createProductCommand;
    private UpdateProductCommand $updateProductCommand;
    private DeleteProductCommand $deleteProductCommand;
    private CategoryMapper $categoryMapper;

    public function __construct(
        ProductServiceInterface $productService,
        CategoryServiceInterface $categoryService,
        CreateProductCommand $createProductCommand,
        UpdateProductCommand $updateProductCommand,
        DeleteProductCommand $deleteProductCommand,
        CategoryMapper $categoryMapper,
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->createProductCommand = $createProductCommand;
        $this->updateProductCommand = $updateProductCommand;
        $this->deleteProductCommand = $deleteProductCommand;
        $this->categoryMapper = $categoryMapper;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = $this->productService->list();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = $this->categoryService->list();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $this->createProductCommand->execute(new ProductDTO($request->validated()));

        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $product = $this->productService->find($id);

        abort_unless($product, 404);

        $categories = $this->categoryMapper->map($product, $this->categoryService->list());

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, int $id): RedirectResponse
    {
        $this->updateProductCommand->execute($id, new ProductDTO($request->validated()));

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->deleteProductCommand->execute($id);

        return redirect()->route('home');
    }
}
