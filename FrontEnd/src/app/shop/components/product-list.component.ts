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
  page: number = 1;
  count: number = 0;
  tableSize:number = 16;
  tableSizes:any = [5,10,15,20];

  constructor(
    private shopService: ShopService,
    private orderService: OrderService
  ) { }
  ngOnInit(): void {
    this.filterCate(this.category_id);
    // this.shopService.product_listSer().subscribe(products => {
    //   this.products = products;
    //  });
    this.getallproducts();

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
    getallproducts(){
      this.shopService.product_listSer().subscribe(products => {
     this.products = products;
     console.log(this.products);

    });
   }
    filter2000000() {
      this.shopService.product_listSer().subscribe(res => {
        this.products = res;
        let obj = []
        for (const product of this.products) {
          if (product.price <= 2000000) {
            obj.push(product);
          }
        }
        this.products = obj;
      })
    }
    filter2_5() {
      this.shopService.product_listSer().subscribe(res => {
        this.products = res;
        let obj = []
        for (const product of this.products) {
          if ( product.price >= 2000000&&product.price <= 5000000) {
            obj.push(product);
          }
        }
        this.products = obj;
      })
    }
    filter5_10() {
      this.shopService.product_listSer().subscribe(res => {
        this.products = res;
        let obj = []
        for (const product of this.products) {
          if ( product.price >= 5000000&&product.price <= 10000000) {
            obj.push(product);
          }
        }
        this.products = obj;
      })
    }
    filter10_20() {
      this.shopService.product_listSer().subscribe(res => {
        this.products = res;
        let obj = []
        for (const product of this.products) {
          if ( product.price >= 10000000&&product.price <= 20000000) {
            obj.push(product);
          }
        }
        this.products = obj;
      })
    }
    filter20() {
      this.shopService.product_listSer().subscribe(res => {
        this.products = res;
        let obj = []
        for (const product of this.products) {
          if ( product.price >= 20000000) {
            obj.push(product);
          }
        }
        this.products = obj;
      })
    }
    ontableDataChange(event: any){
      this.page = event;
      this.products;
    }
    onTableSizeChange(event:any):void{
      this.tableSize = event.target.value;
      this.page = 1;
      this.getallproducts();
    }
  }

