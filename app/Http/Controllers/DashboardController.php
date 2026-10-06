<?php
namespace App\Http\Controllers;
use App\Models\InventoryMovement;
use App\Models\Product;
use App\Models\Supplier;
class DashboardController extends Controller {
 public function __invoke() { $lowStock=Product::whereColumn('current_stock','<=','minimum_stock')->where('active',true)->orderBy('current_stock')->get(); return view('dashboard.index',['productsCount'=>Product::where('active',true)->count(),'suppliersCount'=>Supplier::where('active',true)->count(),'lowStock'=>$lowStock,'recentMovements'=>InventoryMovement::with(['product','supplier'])->latest('moved_at')->take(8)->get()]); }
}
