<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Products;

class Store extends Controller
{
	protected $products;

	public function __construct(){
		$this->products = new Products;
	}

	public function products($type = "clients"){
		$products = $this->products->all();
		
		return view('admin.Store.products')
			   ->with('products', $products);
	}
	
	public function product($id){
		$product = $this->products->find($id);
		 
		$productMetaKeys = array_keys($product->getMeta()->toArray());
		$productMetaValues = array_values($product->getMeta()->toArray());
		$productDetails = array();
		
		foreach($productMetaKeys as $key){
			$productDetails['keys'] = $productMetaKeys;
			$productDetails['values'] = $productMetaValues;
		}
	
		return view('admin.Store.product')
			   ->with('product', $product)
			   ->with('productDetails', $productDetails);
	}
	
	public function updateProduct(Request $request){
		$id = $request->input('id');
		$name = $request->input('name');
		$product = $this->products->find($id);
		
		$count = 0;
		$productMetaKeys = array_keys($product->getMeta()->toArray());
		$productMetaValues = array_values($product->getMeta()->toArray());
		foreach($productMetaKeys as $key){
			$$key = $request->input($key);
			$count++;
		}
	
		$product->name = $name;
		
		$count = 0;
		foreach($productMetaKeys as $key){
			$product->setMeta($key, $$key);
			$count++;
		}
		
		$product->save();
	
		return redirect('admin/store/products/'.$id);
	}
	
	public function addMeta(Request $request){
		$id = $request->input('id');
		$key = $request->input('key');
		$value = $request->input('value');
		if($key != ""){
			$product = $this->products->find($id);
			$product->setMeta($key, $value);
			$product->save();
		}
		return redirect('admin/store/products/'.$id);
	}
	
	public function deleteMeta($id, $meta){
		$product = $this->products->find($id);
		unset($product->$meta);
		$product->save();
		return redirect('admin/store/products/'.$id);
	}

}
