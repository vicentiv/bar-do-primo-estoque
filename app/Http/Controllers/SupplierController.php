<?php
namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;
class SupplierController extends Controller {
 public function index() { return view('suppliers.index',['suppliers'=>Supplier::orderBy('name')->paginate(12)]); }
 public function create() { return view('suppliers.form',['supplier'=>new Supplier()]); }
 public function store(Request $request) { Supplier::create($this->validated($request)); return redirect()->route('fornecedores.index')->with('success','Fornecedor cadastrado.'); }
 public function edit(Supplier $fornecedore) { return view('suppliers.form',['supplier'=>$fornecedore]); }
 public function update(Request $request,Supplier $fornecedore) { $fornecedore->update($this->validated($request)); return redirect()->route('fornecedores.index')->with('success','Fornecedor atualizado.'); }
 public function destroy(Supplier $fornecedore) { if($fornecedore->movements()->exists()) return back()->with('error','Não é possível excluir fornecedor com histórico de compras.'); $fornecedore->delete(); return redirect()->route('fornecedores.index')->with('success','Fornecedor excluído.'); }
 private function validated(Request $request): array { return $request->validate(['name'=>['required','max:150'],'contact_name'=>['nullable','max:150'],'phone'=>['nullable','max:30'],'email'=>['nullable','email'],'city'=>['nullable','max:100'],'notes'=>['nullable'],'active'=>['nullable','boolean']]); }
}
