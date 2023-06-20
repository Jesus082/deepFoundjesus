<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Status;
use App\Models\Producto;
use Livewire\WithPagination;

class SearchProductsComponent extends Component
{
    use WithPagination;
    public $search;
    public $categories, $subcategories;
    public $randomNumber;
    public $statuses;
    public $statusFilter;
    public $max_price, $min_price;
    public $max_year;
    public $sortOrder;
    public $min_year;
    public $categoryFilter, $subCategoryFilter;
    protected $queryString = ['search', 'categoryFilter', 'subCategoryFilter', 'min_price', 'max_price', 'max_year', 'min_year', 'sortOrder', 'statusFilter'];

    public function mount()
    {
        $this->categories = Category::all();
        $this->statuses = Status::all();
        $this->subcategories = collect();

    }

    public function updatedMinPrice($value)
    {
        if (is_numeric($value)) {
            if ($value >= $this->max_price) {
                $this->max_price = $value + 100;
            }
        }
    }

    public function updatedMaxPrice($value)
    {
        if ($value < $this->min_price) {
            $this->min_price = $value;
        }
    }

    public function updatedMinYear($value)
    {
        if (!is_numeric($value)) {
            $this->min_year = 1;
        } elseif ($value >= $this->max_year) {
            $this->max_year = $value + 100;
        }
    }

    public function updatedMaxYear($value)
    {
        if ($value < $this->min_year) {
            $this->min_year = $value;
        }
    }


    public function updatedCategoryFilter($id)
    {
        $this->subcategories = Subcategory::where('category_id', $id)->get();
        $this->subCategoryFilter = $this->subcategories->first()->id ?? null;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        if ($this->min_price < 1) {
            $this->min_price = 1;
        }

        if (!isset($this->min_year)) {
            $this->min_year = -2023;
        }

        intval($this->min_year);

        $products = Producto::query()
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->when($this->subCategoryFilter, function ($query) {
                $query->where('subcategory_id', $this->subCategoryFilter);
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status_id', $this->statusFilter);
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . trim($this->search) . '%');
            })
            ->when($this->min_price && $this->max_price, function ($query) {
                $query->whereBetween('price', [$this->min_price, $this->max_price]);
            })
            ->when($this->min_year && $this->max_year, function ($query) {
                $query->whereBetween('manufacturing', [$this->min_year, $this->max_year]);
            })
            ->when($this->sortOrder, function ($query) {
                $query->orderBy('price', $this->sortOrder);
            })
            ->with('images')->paginate(10);

        return view('livewire.search-products-component', ['products' => $products]);
    }
}
