<?php
namespace App\Http\Controllers;
use App\Models\InventoryMovement;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class InventoryMovementController extends Controller {
 public function index() { return view('movements.index',['movements'=>InventoryMovement::with(['product','supplier','user'])->latest('moved_at')->paginate(20)]); }
 public function create() { return view('movements.form',['products'=>Product::where('active',true)->orderBy('name')->get(),'suppliers'=>Supplier::where('active',true)->orderBy('name')->get()]); }
 public function store(Request $request) { $data=$request->validate(['product_id'=>['required','exists:products,id'],'supplier_id'=>['nullable','required_if:type,entrada','exists:suppliers,id'],'type'=>['required','in:entrada,saida,ajuste'],'quantity'=>['required','numeric','not_in:0'],'unit_cost'=>['nullable','numeric','min:0'],'reference'=>['nullable','max:100'],'notes'=>['nullable'],'moved_at'=>['required','date']]); DB::transaction(function() use($data,$request) { $product=Product::lockForUpdate()->findOrFail($data['product_id']); $delta=$data['type']==='entrada'?$data['quantity']:($data['type']==='saida'?-$data['quantity']:$data['quantity']); if($product->current_stock+$delta<0) abort(422,'A saída não pode deixar o estoque negativo.'); InventoryMovement::create($data+['user_id'=>$request->user()->id]); $product->increment('current_stock',$delta); if($data['type']==='entrada'&&!empty($data['unit_cost'])) $product->update(['purchase_price'=>$data['unit_cost']]); }); return redirect()->route('movements.index')->with('success','Movimentação registrada e estoque atualizado.'); }
}
