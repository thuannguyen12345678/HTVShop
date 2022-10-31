<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection,WithHeadings
{
    public function collection()
    {/////////join
        return DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('brands','products.brand_id','=','brands.id')
        ->select('products.name', 'products.price','products.amount','products.color',
        'products.created_at', 'products.updated_at','categories.name as cateName',
        'brands.name as brandName'
        )->get();
    }
    public function headings() :array
    {
        ////////các cột của bảng excel
        return ["Tên Sản Phẩm", "Giá(VND)", "Số Lượng", "màu","Ngày Nhập","Ngày Sửa","Danh Mục","Thương Hiệu"];
    }

}
