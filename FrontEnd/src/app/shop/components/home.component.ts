import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { environment } from 'src/environments/environment';


@Component({
  selector: 'app-home',
  templateUrl: '../templates/home.component.html',
})
export class HomeComponent implements OnInit {
  products: any[] =[];
  brands: any[] = []
  baner:any;
  constructor () { }

  ngOnInit(): void {
   

  }
  trendingProduct(){
   
  }
  getBaner(){
   
  }
  getAllBrand(){
    
  }
}

