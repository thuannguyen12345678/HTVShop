import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { OrderService } from '../services/order.service';
import { Banner, Product } from '../shop';
import { ShopService } from '../shop.service';

@Component({
  selector: 'app-home',
  templateUrl: '../templates/home.component.html',
})
export class HomeComponent implements OnInit {
  products: any[] = [];
  top: any[] = [];
  brands: any[] = [];
  url: string = environment.url;
  banners: any;

  // brands: any;
  brand_id: any;
  quantity50_100:any;
  page: number = 1;
  count: number = 0;
  tableSize:number = 8;
  tableSizes:any = [5,10,15,20];

  
  constructor(
    private shopService: ShopService,
    private route: ActivatedRoute,
    private _Router: Router,
    private orderService: OrderService
  ) {}

  ngOnInit(): void {
    this.product_list();
    this.trendingProduct();
    this.getBanner();
    this.getAllBrand();
    this.filterBrand(this.brand_id);
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
      let obj = []
      for (const product of this.products) {
        if (product.price > 50 && product.price < 100) {
          obj.push(product);
          this.products = obj;
        }
      }
      this.quantity50_100 = obj;
    });
  }
  trendingProduct() {
    this.shopService.trendingProductSer().subscribe((res) => {
      this.top = res;

      console.log(this.top);
    });
  }
  getBanner() {
    this.shopService.getAllBanner().subscribe((res) => {
      this.banners = res;
      this.banners = this.banners.image;
      console.log(this.banners);
    });
  }
  getAllBrand() {
    this.shopService.getAllBrand().subscribe((res) => {
      this.brands = res;
      // console.log(this.brands);
    });
  }
  addToCart(id: number) {
    this.orderService.addToCart(id).subscribe((res) => {
      this.orderService.getAllCart();
      alert('Thêm vào giỏ hàng thành công');
    });
  }
  product_list() {
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
    })
  }
  filterBrand(brand_id: any) {
    this.brand_id = brand_id;
    this.shopService.getAllBrand().subscribe(res => {
      this.brands = res;
      for (const brand of this.brands) {
        if (this.brand_id == brand.id) {
          this.products = brand.products;
        }
      }
    });
  }
  ontableDataChange(event: any){
    this.page = event;
    this.products;
  }
  onTableSizeChange(event:any):void{
    this.tableSize = event.target.value;
    this.page = 1;
    this.product_list();
  }
}



