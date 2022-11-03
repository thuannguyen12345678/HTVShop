import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { ActivatedRoute, ParamMap } from '@angular/router';

import { Router } from '@angular/router';
import { FormControl, FormGroup, Validators } from '@angular/forms';
@Component({
  selector: 'app-header',
  templateUrl: '../templates/header.component.html',
})
export class HeaderComponent implements OnInit {
  constructor( 
    private _AuthService: AuthService,
    private _Router: Router,
    ) { }
  check:any = this._AuthService.checkAuth();
  ngOnInit(): void {
  }
  logout(){
    this._AuthService.logout();
    this._Router.navigate(['login']);
  }
}