import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from 'src/environments/environment';
@Component({
  selector: 'app-header',
  templateUrl: '../templates/header.component.html',
})
export class HeaderComponent implements OnInit {
  categories: any[] = [];
  currentUser: any;
  token: any;
  userData: any;
  listCart: any;
  cartSubtotal: number = 0;
  products: any;
  constructor() {
    
  }

  ngOnInit(): void {
    
  }
  
}