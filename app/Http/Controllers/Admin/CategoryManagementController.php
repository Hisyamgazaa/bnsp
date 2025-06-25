<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryManagementController extends Controller
{
  /**
   * Display a listing of categories
   */
  public function index(): View
  {
    $categories = Category::withCount('products')
      ->orderBy('created_at', 'desc')
      ->paginate(15);

    return view('admin.categories.index', compact('categories'));
  }

  /**
   * Show the form for creating a new category
   */
  public function create(): View
  {
    return view('admin.categories.create');
  }

  /**
   * Store a newly created category
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
      'description' => ['nullable', 'string'],
      'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
      'is_active' => ['required', 'boolean'],
    ]);

    $data = [
      'name' => $request->name,
      'slug' => Str::slug($request->name),
      'description' => $request->description,
      'is_active' => $request->is_active,
    ];

    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('categories', 'public');
      $data['image'] = $imagePath;
    }

    Category::create($data);

    return redirect()->route('admin.categories.index')
      ->with('success', 'Category created successfully.');
  }

  /**
   * Display the specified category
   */
  public function show(Category $category): View
  {
    $category->load([
      'products' => function ($query) {
        $query->latest()->take(10);
      }
    ]);

    return view('admin.categories.show', compact('category'));
  }

  /**
   * Show the form for editing the specified category
   */
  public function edit(Category $category): View
  {
    return view('admin.categories.edit', compact('category'));
  }

  /**
   * Update the specified category
   */
  public function update(Request $request, Category $category): RedirectResponse
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $category->id],
      'description' => ['nullable', 'string'],
      'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
      'is_active' => ['required', 'boolean'],
    ]);

    $data = [
      'name' => $request->name,
      'slug' => Str::slug($request->name),
      'description' => $request->description,
      'is_active' => $request->is_active,
    ];

    if ($request->hasFile('image')) {
      // Delete old image if exists
      if ($category->image) {
        Storage::disk('public')->delete($category->image);
      }

      $imagePath = $request->file('image')->store('categories', 'public');
      $data['image'] = $imagePath;
    }

    $category->update($data);

    return redirect()->route('admin.categories.index')
      ->with('success', 'Category updated successfully.');
  }

  /**
   * Remove the specified category
   */
  public function destroy(Category $category): RedirectResponse
  {
    // Check if category has products
    if ($category->products()->count() > 0) {
      return redirect()->route('admin.categories.index')
        ->with('error', 'Cannot delete category that has products. Please move or delete products first.');
    }

    // Delete image if exists
    if ($category->image) {
      Storage::disk('public')->delete($category->image);
    }

    $category->delete();

    return redirect()->route('admin.categories.index')
      ->with('success', 'Category deleted successfully.');
  }

  /**
   * Toggle category status
   */
  public function toggleStatus(Category $category): RedirectResponse
  {
    $category->update([
      'is_active' => !$category->is_active
    ]);

    $status = $category->is_active ? 'activated' : 'deactivated';

    return redirect()->route('admin.categories.index')
      ->with('success', "Category {$status} successfully.");
  }
}
