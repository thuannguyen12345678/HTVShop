import { Injectable } from '@angular/core';
import { Brand, Category, Image, Product, Register, Review } from './shop';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { map, Observable, of } from 'rxjs';
import { environment } from 'src/environments/environment';
import { delay } from 'rxjs/operators';


@Injectable({
  providedIn: 'root'
})
export class ShopService {


  constructor(private http: HttpClient,) {}



  product_listSer(): Observable<Product[]> {
    return this.http.get<Product[]>(environment.urlAllProducts);
  }


  product_detailSer(id: any): Observable<Product> {
    return this.http.get<Product>(environment.urlIdProduct + '/' + id);
  }
  product_image(id: any): Observable<Image[]> {
    return this.http.get<Image[]>(environment.urlImageProduct + '/' + id);
  }
  trendingProductSer(): Observable<Product[]> {
    return this.http.get<Product[]>(environment.urlTrendingPro);

  }
  getAllBrand(): Observable<Brand[]> {
    return this.http.get<Brand[]>(environment.urlGetAllBrand);
  }
  getAllBanner() {
    return this.http.get(environment.urlBanner);
  }
  category_listSer(): Observable<Category[]> {
    return this.http.get<Category[]>(environment.urlAllCategories);
  }
  searchProductList(name:string){
    const response = new Promise(resolve => {
      this.http.get(environment.urlSearch+`product_list/search?
      search=${name}`).subscribe(data => {
        resolve(data)
      }, err => {
        console.log(err);
      });
    });
    return response;
  }


}
