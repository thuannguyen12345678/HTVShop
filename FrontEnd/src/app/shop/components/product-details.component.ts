import { environment } from './../../../environments/environment';
import { Product } from './../shop';
import { Component, OnInit } from '@angular/core';
import { FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ShopService } from '../shop.service';
import { OrderService } from '../services/order.service';


@Component({
  selector: 'app-product-details',
  templateUrl: '../templates/product-details.component.html',
})
export class ProductDetailsComponent implements OnInit {
  url:any = environment.url;
  id: any;
  reviewForm !: FormGroup;
  answerForm !: FormGroup;
  review: any;
  currentUser: any;
  review_id: any;
  answer: any;
  customer_email: any;
  customer_id: any
  token: any;
  reviews: any;
  countStar: any;
  reviewStatus: any;
  avgRateStar: any;
  anserRe_id: any;
  products:any;
  product:any;
  images:any;
  image1:any;
  trending_top :any[]=[];
  url_image = 'http://127.0.0.1:8000/';
  image_2 :any;
  product_all:any;
  count: number = 0;
  cate_id:any;
  categories:any;
  product_top:any;
  constructor(
    private _route:ActivatedRoute,
    private _Router: Router,
    private ShopService:ShopService,
    private orderService: OrderService,
  ) {  }

  ngOnInit(): void {

    this.id = this._route.snapshot.params['id'];
      this.ShopService.product_image(this.id).subscribe(res => {
      this.images= res;
      // console.log(res);
    });
      this.ShopService.product_detailSer(this.id).subscribe(res => {
      // console.log(this.id);
      this.products = res;

      for( let product of this.products){
        this.product = product;
         this.image1 = this.product.image
         this.cate_id=this.product.category_id;
      }
    });
    this.ShopService.category_listSer().subscribe(res => {
      this.categories = res;
      for (const category of this.categories) {
        if (this.cate_id == category.id) {
          this.product_top = category.products;
        }
      }
    });
  }

  changeImage(image:any){
    this.image1 =  image;
  }
  detail(id:any){

      this.ShopService.product_detailSer(id).subscribe(res => {
      // console.log(this.id);
      this.products = res;

      for( let product of this.products){
        this.product = product;
         this.image1 = this.product.image
         this.cate_id=this.product.category_id;
      }
        this.ShopService.product_image(id).subscribe(res => {
      this.images= res;
    });
    });
  }
  addToCart(id: number) {
    this.orderService.addToCart(id).subscribe(res => {
      this.orderService.getAllCart();
      alert('Added to cart');
    })
  }

}
