import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

import { Router } from '@angular/router';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { OrderService } from '../services/order.service';
import { ShopService } from '../shop.service';
@Component({
  selector: 'app-header',
  templateUrl: '../templates/header.component.html',
})
export class HeaderComponent implements OnInit {
  listCart: any;
  id_user: any;
  name: any;
  order: any;
  cartSubtotal: number = 0;
  count: any;
  constructor(
    private _AuthService: AuthService,
    private _Router: Router,
    private orderService: OrderService,
    private _UserService:AuthService,
    private ShopService:ShopService,
  ) {}
  check: any = this._AuthService.checkAuth();
  ngOnInit(): void {
    this.getAllCart();
    this.profile();
  }
  logout() {
    this._AuthService.logout();
    this.check = this._AuthService.checkAuth();
    this.listCart = [];
    this._Router.navigate(['login']);
  }
  ngDoCheck(): void {
    if (!this.check) {
      this.check = this._AuthService.checkAuth();
    }
    if (this.check && !this.name && !this.id_user) {
      // this.getAllCart();
      
    }
  }
  profile(){
    if(this._UserService.checkAuth()) {
        this._UserService.profile().subscribe(res =>{
          this.id_user = res.id;
          console.log(this.id_user);
        },e=>{        })        
    }
    else{
      this._Router.navigate(['/login']);
    }
}
  getAllCart() {
    this.orderService.getAllCart().subscribe((res) => {
      this.listCart = res;
      this.count = this.listCart.length;
      this.cartSubtotal = 0;
      for (let cart of this.listCart) {
        this.cartSubtotal += cart.price * cart.amount;
      }
    });
  }
  updateAmount(id: any, amount: any) {
    this.orderService.updateAmount(id, amount).subscribe((res) => {
      this.getAllCart();
    });
  }
  deleteCart(id: any) {
    this.orderService.deleteCart(id).subscribe((res) => {
      this.getAllCart();
    });
  }
  changeCart() {
    this.getAllCart();
    this.check = this._AuthService.checkAuth();
  }
  orders(){
    // this.customer_id = this.route.snapshot.params['id'];
    this.ShopService.getListOrder(this.id_user).subscribe(res => {
      this.order = res;
      console.log(res);
    });
  }
}
