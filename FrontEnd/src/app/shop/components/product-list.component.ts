import { Component, OnInit } from '@angular/core';
// import { FormBuilder, FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { Brand, Category, Product } from '../shop';
import { ShopService } from '../shop.service';
import { OrderService } from '../services/order.service';
@Component({
  selector: 'app-product-list',
  templateUrl: '../templates/product-list.component.html',
})
export class ProductListComponent implements OnInit {

  products: any[] = [];
  categories: any;
  category_id:any;

  constructor(
    private shopService: ShopService,
    private orderService: OrderService
  ) { }
  ngOnInit(): void {
    this.filterCate(this.category_id);
    this.shopService.product_listSer().subscribe(products => {
      this.products = products;
     });

     this.shopService.category_listSer().subscribe(res => {
      this.categories = res;
    });
    };
    addToCart(id: number) {
      this.orderService.addToCart(id).subscribe(res => {
        this.orderService.getAllCart();
        alert('Added to cart');
      })
    }
    filterCate(category_id: any) {
      this.category_id = category_id;
      console.log(category_id);

      this.shopService.category_listSer().subscribe(res => {
        this.categories = res;
        for (const category of this.categories) {
          if (this.category_id == category.id) {
            this.products = category.products;
          }
        }
      });
    }

  }

