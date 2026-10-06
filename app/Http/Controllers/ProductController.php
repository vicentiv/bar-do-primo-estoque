<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
class ProductController extends Controller {
 public function index() { $search=request('busca'); $products=Product::with('category')->when($search,fn($q)=>$q->where(fn($q)=>$q->where('name','like',"%{$search}%")->orWhere('sku','like',"%{$search}%")))->orderBy('name')->paginate(12)->withQueryString(); return view('products.index',compact('products','search')); }
 public function create() { return view('products.form',['product'=>new Product(),'categories'=>Category::orderBy('name')->get()]); }
 public function store(Request $request) { Product::create($this->validated($request)); return redirect()->route('produtos.index')->with('success','Produto cadastrado com sucesso.'); }
 public function edit(Product $produto) { return view('products.form',['product'=>$produto,'categories'=>Category::orderBy('name')->get()]); }
 public function update(Request $request,Product $produto) { $produto->update($this->validated($request,$produto)); return redirect()->route('produtos.index')->with('success','Produto atualizado.'); }
 public function destroy(Product $produto) { if($produto->movements()->exists()) return back()->with('error','Não é possível excluir um produto com movimentações.'); $produto->delete(); return redirect()->route('produtos.index')->with('success','Produto excluído.'); }
 private function validated(Request $request,?Product $product=null): array { return $request->validate(['category_id'=>['nullable','exists:categories,id'],'name'=>['required','max:150'],'sku'=>['required','max:50','unique:products,sku'.($product?','.$product->id:'')],'unit'=>['required','max:12'],'minimum_stock'=>['required','numeric','min:0'],'purchase_price'=>['nullable','numeric','min:0'],'sale_price'=>['nullable','numeric','min:0'],'active'=>['nullable','boolean']]); }
}
