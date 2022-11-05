import { environment } from './../../../environments/environment';
import { Product } from './../shop';
import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, FormBuilder } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ShopService } from '../shop.service';


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
  url_image = 'http://127.0.0.1:8000/';
  image_2 :any;
  constructor(
    private _route:ActivatedRoute,
    private _Router: Router,
    private ShopService:ShopService
  ) {  }

  ngOnInit(): void {
    this.id = this._route.snapshot.params['id'];
      this.ShopService.product_image(this.id).subscribe(res => {
      this.images= res;
      console.log(res);
    });
      this.ShopService.product_detailSer(this.id).subscribe(res => {
      console.log(this.id);
      this.products = res;
      console.log(this.products);
      for( let product of this.products){
        this.product = product;
         this.image1 = this.product.image
      }
    });
  }

  changeImage(image:any){
    this.image1 =  image;
  }

}
