import { Component, OnInit, } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { OrderService } from '../services/order.service';
import { environment } from '../../../environments/environment';
import { AuthService } from '../auth.service';
import { Order } from '../shop';
@Component({
    selector: 'app-checkout',
    templateUrl: '../templates/checkout.component.html',
})
export class CheckoutComponent implements OnInit {
    form!: FormGroup;
    name:any;
    id:any;
    email:any;
    listCart: any;
    cartSubtotal: number = 0;
    url: any = environment.url;
    listProvince: any;
    listDistrict: any;
    listWard: any;
    provinceSelected: boolean = false;
    districtSelected: boolean = false;
    constructor(
        private orderService: OrderService, private _router: Router,private _UserService:AuthService,
    ) {
        this.getAllCart();
    }

    ngOnInit(): void {
        this.getAllCart();  
        this.profile();  
        this.form = new FormGroup({
          province_id: new FormControl('', Validators.required),
          district_id: new FormControl('', Validators.required),
          ward_id: new FormControl('', Validators.required),
          address: new FormControl('', Validators.required),
          note: new FormControl(''),
          name_customer: new FormControl('', Validators.required),
          phone: new FormControl('', Validators.required),
      })
      this.orderService.getAllProvince().subscribe(res => {
          this.listProvince = res;
      })

  }
    profile(){
        if(this._UserService.checkAuth()) {
            this._UserService.profile().subscribe(res =>{
              this.id = res.id;
              this.name = res.name;
              this.email = res.email;
            },e=>{
              console.log(e);
            })
        }
        else{
          this._router.navigate(['/login']);
        }
    }
    submit() {
        let order: any;
        let id = this.id;
        let data = this.form.value;
        let Order: Order = {
          province_id:data.province_id,
          district_id:data.district_id,
          ward_id:data.ward_id,
          address:data.address,
          note:data.note,
          name_customer:data.name_customer,
          phone:data.phone,
          customer_id:id,
        }
        console.log(Order);
          this.orderService.storeOrder(Order).subscribe(res => {
            order = res;
            this._router.navigate(['home']);
            // alert('thành công');
            this.getAllCart();
    });
   
  }
    getAllCart() {
        this.orderService.getAllCart().subscribe(res => {
            this.listCart = res;
            this.cartSubtotal = 0;
            for (let cart of this.listCart) {
                this.cartSubtotal += cart.price * cart.amount;
            }
        });
    }
    get f() {
        return this.form.controls;
    }
    onSelectProvince(event: any) {
        let province_id = event.target.value;
        this.provinceSelected = true;
        this.districtSelected = false;
        this.orderService.getAllDistrictByProvinceId(province_id).subscribe(res => {
            this.listDistrict = res;
        })
    }
    onSelectDistrict(event: any) {
        let district_id = event.target.value;
        this.districtSelected = true;
        this.orderService.getAllWardDistrictById(district_id).subscribe(res => {
            this.listWard = res;
        })
    }
   
}