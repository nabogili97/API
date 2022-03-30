<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\New_;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->name = "LW Travis Scott x Air Jordan 6";
        $product->category_id = 1;
        $product->brand_id = 2;
        $product->discount = 0;
        $product->price = 7000000;
        $product->retail_price = 10000000;
        $product->image = "product/images/2.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "LW Travis Scott x Air Jordan 6 British Khaki";
        $product->category_id = 1;
        $product->brand_id = 2;
        $product->discount = 0;
        $product->price = 8000000;
        $product->retail_price = 15000000;
        $product->image = "product/images/3.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "LW Travis Scott x Air Jordan 6 UNC";
        $product->category_id = 1;
        $product->brand_id = 2;
        $product->discount = 0;
        $product->price = 5000000;
        $product->retail_price = 9000000;
        $product->image = "product/images/4.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "Air Jordan 4 Retro  SE";
        $product->category_id = 2;
        $product->brand_id = 2;
        $product->discount = 10;
        $product->price = 6000000;
        $product->retail_price = 9500000;
        $product->image = "product/images/5.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Air Jordan 1  High OG";
        $product->category_id = 1;
        $product->brand_id = 2;
        $product->discount = 0;
        $product->price = 10000000;
        $product->retail_price = 15000000;
        $product->image = "product/images/6.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Gucci Rhyton Logo";
        $product->category_id = 2;
        $product->brand_id = 1;
        $product->discount = 50;
        $product->price = 10000000;
        $product->retail_price = 15000000;
        $product->image = "product/images/7.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Gucci Rhyton Môi";
        $product->category_id = 2;
        $product->brand_id = 1;
        $product->discount = 0;
        $product->price = 15000000;
        $product->retail_price = 20000000;
        $product->image = "product/images/8.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Converse Play";
        $product->category_id = 1;
        $product->brand_id = 5;
        $product->discount = 0;
        $product->price = 15000000;
        $product->retail_price = 2000000;
        $product->image = "product/images/9.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Converse Cocacola";
        $product->category_id = 2;
        $product->brand_id = 5;
        $product->discount = 25;
        $product->price = 2000000;
        $product->retail_price = 2500000;
        $product->image = "product/images/10.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "VANS  Old Skool  2021";
        $product->category_id = 2;
        $product->brand_id = 3;
        $product->discount = 10;
        $product->price = 2000000;
        $product->retail_price = 2500000;
        $product->image = "product/images/11.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "VANS  Old Skool  2021";
        $product->category_id = 1;
        $product->brand_id = 3;
        $product->discount = 0;
        $product->price = 2500000;
        $product->retail_price = 3000000;
        $product->image = "product/images/12.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = "VANS  Old Skool Chữ";
        $product->category_id = 1;
        $product->brand_id = 3;
        $product->discount = 0;
        $product->price = 2500000;
        $product->retail_price = 3000000;
        $product->image = "product/images/13.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();


        $product = new Product();
        $product->name = " Louis Vuitton LV Trainer ";
        $product->category_id = 1;
        $product->brand_id = 4;
        $product->discount = 0;
        $product->price = 7500000;
        $product->retail_price = 40000000;
        $product->image = "product/images/14.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

        $product = new Product();
        $product->name = " Louis Vuitton LV 2021 ";
        $product->category_id = 1;
        $product->brand_id = 4;
        $product->discount = 0;
        $product->price = 7500000;
        $product->retail_price = 40000000;
        $product->image = "product/images/15.jpg";
        $product->description = "Đây chính là một trong những mẫu giày vô cùng phổ biến được rất nhiều người biết tới và được coi là một trong những mẫu giày sneaker đặc trưng đại diện cho thương hiệu Louis Vuitton. Mẫu giày này được cánh mày râu khá yêu thích bởi thiết kế đơn giản nhưng không kém phần tinh tế, có thể phối với rất nhiều loại trang phục mang những phong cách khác nhau.";
        $product->content = '<h1>&nbsp;</h1><h4>Chi tiết sản phẩm</h4><figure class="table"><table><tbody><tr><td>Danh mục sản phẩm</td><td>Giày thấp cổ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td></tr><tr><td>Chất liệu</td><td>Da</td></tr><tr><td>Độ cao của đế</td><td>3 cm</td></tr><tr><td>Xuất xứ</td><td>Itali</td></tr></tbody></table></figure>';
        $product->status = 1;
        $product->save();

    }
     
}
