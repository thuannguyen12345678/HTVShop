import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, FormBuilder } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';


@Component({
  selector: 'app-product-details',
  templateUrl: '../templates/product-details.component.html',
})
export class ProductDetailsComponent implements OnInit {

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
  product:any;
  constructor(
  ) {  }

  ngOnInit(): void {
   
   
    
    };
   
}