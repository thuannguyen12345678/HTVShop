import { Injectable } from '@angular/core';
import { HttpClient,HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class OrderService {
  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
    })
  }
  constructor(private http: HttpClient,) {}
  addToCart(id: number){
    return this.http.get(environment.url+'api/add-to-cart/'+id);
  }
  getAllCart(){
    return this.http.get(environment.url+'api/list-cart');
  }
  updateAmount(id: any, amount: any){
    return this.http.get(environment.url+'api/update-cart/'+id+'/'+amount);
  }
  deleteCart(id: any){
    return this.http.get(environment.url+'api/remove-to-cart/'+id);
  }
  createOrder(){
    return this.http.get(environment.url+'api/orders/create');
  }
  getAllProvince(){
    return this.http.get(environment.url+'api/orders/list-province');
  }
  getAllDistrictByProvinceId(id: any){
    return this.http.get(environment.url+'api/orders/list-district/'+id);
  }
  getAllWardDistrictById(id: any){
    return this.http.get(environment.url+'api/orders/list-ward/'+id);
  }
  storeOrder(request: any){
    return this.http.post(environment.url+'api/orders/store/', request, {responseType: 'text'});
  }
  showOrder(id: any){
    return this.http.get(environment.url+'api/orders/show/'+id);
  }
}
