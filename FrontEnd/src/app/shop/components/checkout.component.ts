import { Component, OnInit, } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
@Component({
    selector: 'app-checkout',
    templateUrl: '../templates/checkout.component.html',
})
export class CheckoutComponent implements OnInit {
    form!: FormGroup;

    listCart: any;
    cartSubtotal: number = 0;

    listProvince: any;
    listDistrict: any;
    listWard: any;

    provinceSelected: boolean = false;
    districtSelected: boolean = false;
    constructor() {
    }

    ngOnInit(): void {
       
        }
      
    
}