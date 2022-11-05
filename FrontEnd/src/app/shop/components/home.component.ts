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
  brands: any[] = [];
  url: string = environment.url;
  banners: any;
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
  }
  trendingProduct() {
    this.shopService.trendingProductSer().subscribe((res) => {
      this.products = res;

      console.log(this.products);
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
      alert('Added to cart');
    });
  }
  product_list() {
    this.shopService.product_listSer().subscribe(res => {
      this.products = res;
    })
  }
}

}

