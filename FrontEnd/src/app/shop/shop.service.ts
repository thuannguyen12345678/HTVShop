import { Injectable } from '@angular/core';
import { Brand, Category, Product, Register, Review } from './shop';
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
  trendingProductSer(): Observable<Product[]> {
    return this.http.get<Product[]>(environment.urlTrendingPro);
  // registerSer(register: Register): Observable<Register[]> {
  //   return this.http.post<Register[]>(environment.urlRegister, register);
  // }
  googleLogin(): Observable<any> {
    return this.http.get<any[]>(environment.urlLogin)
  }
  }
  getAllBrand(): Observable<Brand[]> {
    return this.http.get<Brand[]>(environment.urlGetAllBrand);
  }
  getAllBanner() {
    return this.http.get(environment.urlBanner);
  }
  

}