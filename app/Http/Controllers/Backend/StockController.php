<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use App\Model\Category;
use Auth;
use Session;
use PDF;

class StockController extends Controller
{
    public function stockReport()
    {
    	Session::put('page', 'stock_report');
    	$alldata = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
    	//dd($alldata->toArray());
    	return view('backend.stock.stock-report')->with(compact('alldata'));
    }
    public function stockReportpdf()
    {
    	$data['alldata'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
    	$pdf = PDF::loadView('backend.pdf.stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    	return view('backend.product.add-product')->with(compact('suppliers','categories','units'));
    }
    public function supplierProductWise()
    {
    	Session::put('page', 'stock_supplier_product');
    	$suppliers = Supplier::all();
    	$categories = Category::all();
    	return view('backend.stock.supplier-product-wise-report')->with(compact('suppliers','categories'));
    }
    public function supplierWisePdf(Request $request)
    {
    	$data['alldata'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->where('supplier_id',$request->supplier_id)->get();
    	$pdf = PDF::loadView('backend.pdf.supplier-wise-stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function productWisePdf(Request $request)
    {
    	$data['product'] = Product::where('category_id',$request->category_id)->where('id',$request->product_id)->first();
    	$pdf = PDF::loadView('backend.pdf.product-wise-stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
