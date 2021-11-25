<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use DataTables; 
use PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\products;
use App\Models\menu;
use App\Models\categories;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class AdminController extends Controller
{
    // function demo() {
    //     $user = User::insert([
    //         'name' => Str::random(10),
    //         'email' => 'admin@gmail.com',
    //         'password' => Hash::make('admin'),
    //         'role_id'=>1
    //     ]);
    //     dd($user);
    // }
    function index(){
        return view('dashboards.admins.index');
    }
   
    function product(Request $request){
        
        // $products = DB::table('products')->paginate(10);
       // $products = products::all();
        $products = products::paginate(5);
        //$productIds = $products->pluck('id');
        return view('dashboards.admins.products',compact('products'));
    }

    function deletemultipleproducts(Request $request) 
    {
        //print_r($_POST); exit();
        $ids =$request->ids;
        //dd($ids);
        products::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['status' => true, 'message' => 'Products Delete SuccessFully']);
    }

    function user(){
        $user = DB::table('users');
        return view('dashboards.admins.user',compact('user'));
    }

    function categories(){
        $categories = DB::table('categories')->paginate(5);
        // $products = products::all();
         //$products = products::paginate(5);
         return view('dashboards.admins.categories',compact('categories'));
    }

    function menus(){
         return view('dashboards.admins.menus');
    }

    function menu(Request $request){
        $menu = $request->validate([
            'm_name' => 'required',
            'order' => 'required'
        ]);
       menu::create($menu);
       
       return redirect('admin/menus')
        ->with('success','Menu inserted successfully');
    }

    function create(){
        
        return view('dashboards.admins.create');
        
    }

    function createcategories(){
        
        return view('dashboards.admins.createcategories');
        
    }
    function categoriesstore(Request $request){
        $ds = $request->validate([
            'c_name' => 'required',
            'c_amount' => 'required'
        ]);
       categories::create($ds);
       //dd($ds);
       return redirect('admin/categories')
        ->with('success','Categories inserted successfully');
    }

    function store(Request $request){
      
        $data = $request->validate([
            'c_id' => 'required',
            'p_name' => 'required',
            'p_sku' => 'required',
            'p_tags' => 'required',
            'p_description' => 'required',
            'p_image' => 'required',
            'p_stock' => 'required',
            'p_price' => 'required'
        ]);
        
       products::create($data);
       return redirect('admin/products')
        ->with('success','Product inserted successfully');
    }

    public function edit($id){
        $categories = categories::find($id);
         return view('dashboards.admins.edit', compact('categories'));
    } 

    public function update(Request $request, $id)
    {
      $data =  $request->validate([
            'c_name' => 'required',
            'c_amount' => 'required',
        ]);
        // $crud->name = $request->name;
        // $crud->salary = $request->salary;
        // $crud->save();
        categories::where('id',$id)->update($data);
        
        $categories = DB::table('categories')->paginate(5);

        return view('dashboards.admins.categories',compact('categories'));
        // return redirect()->route('dashboards.admins.categories')
        // ->with('success','Record Updated Successfully');
    }

    public function destroy(products $products, $id)
    {
        Products::where('id', $id)->delete();
        //$products->delete($id);
        return redirect('admin/products')
        ->with('success','Product Delete successfully');
    }

    public function delete(categories $categories, $id)
    {
        categories::where('id', $id)->delete();
        return redirect('admin/categories')
        ->with('success','categories Delete successfully');        
    }

    function profile(){
        return view('dashboards.admins.profile');
    }
   
    function settings(){
        return view('dashboards.admins.settings');
    }
    
    function pdf()
    {
        //$products = products::where('id',49672)->get();
        $products = products::all();

        // share data to view
        $pdf = PDF::loadView('exports.product', compact('products'));
        return $pdf->download('pdf_file.pdf');
    }

    public function ExportExcel(Request $request)
    {
        return Excel::download(new ProductsExport, 'Products' . date('d-m-Y') . '.xlsx');
    }

    function convert_customer_data_to_html()
    {
        $products = products::all();
     $output = '
     <h3 align="center">Product Data</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Id</th>
    <th style="border: 1px solid; padding:12px;" width="20%">Category Id</th>
    <th style="border: 1px solid; padding:12px;" width="20%">Name</th>
    <th style="border: 1px solid; padding:12px;" width="30%">SKU</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Tags</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Description</th>
    <th style="border: 1px solid; padding:12px;" width="20%">Image</th>
    <th style="border: 1px solid; padding:12px;" width="20%">Stock</th>
    <th style="border: 1px solid; padding:12px;" width="20%">Price</th>
   </tr>
     ';  
//      foreach($products as $product)
//      {
//       $output .= '
//       <tr>
//        <td style="border: 1px solid; padding:12px;">'.$product->id.'</td>
//        <td style="border: 1px solid; padding:12px;">'.$product->c_id.'</td>
//        <td style="border: 1px solid; padding:12px;">'.$product->p_name.'</td>
//        <td style="border: 1px solid; padding:12px;">'.$product->p_sku.'</td>
//        <td style="border: 1px solid; padding:12px;">'.$product->p_tags.'</td>
//        <td style="border: 1px solid; padding:12px;">'.$product->p_description.'</td>
//        <td style="border: 1px solid; padding:12px;">'.$product->p_image.'</td>
//        <td style="border: 1px solid; padding:12px;">'.$product->p_stock.'</td>
//        <td style="border: 1px solid; padding:12px;">'.$product->p_price.'</td>

//       </tr>
//       ';
//      }
//      $output .= '</table>';
//      return $output;
    }
}