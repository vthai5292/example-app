<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    public function addToCart($product)
    {
        Cart::add($product['id'], $product['name'], 1, $product['regular_price'])->associate('\App\Models\Product');
        session()->flash('success', 'Task was sucessful');
        return redirect()->route('Cart');
    }
    public $sorting;
    public $pagesize;
    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = 12;
    }


    public function render()
    {
        $count_product = Product::count();
        // Cart::destroy();
        if ($this->sorting == "date") {
            $products = Product::orderBy('created_at', 'DESC')->paginate($this->pagesize);
        } elseif ($this->sorting == "price") {
            $products = Product::orderBy('regular_price', 'ASC')->paginate($this->pagesize);
        } elseif ($this->sorting == "price-desc") {
            $products = Product::orderBy('regular_price', 'DESC')->paginate($this->pagesize);
        } else {
            $products = Product::paginate($this->pagesize);
        }
        return view('livewire.shop-component', compact([
            'products',
            'count_product',
        ]))->layout('layouts.base');
    }
}
