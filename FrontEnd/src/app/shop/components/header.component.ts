import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

import { Router } from '@angular/router';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { OrderService } from '../services/order.service';
@Component({
  selector: 'app-header',
  templateUrl: '../templates/header.component.html',
})
export class HeaderComponent implements OnInit {
  listCart: any;
  id_user: any;
  name: any;
  cartSubtotal: number = 0;
  count: any;
  constructor(
    private _AuthService: AuthService,
    private _Router: Router,
    private orderService: OrderService
  ) {}
  check: any = this._AuthService.checkAuth();
  ngOnInit(): void {
    this.getAllCart();
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
}
