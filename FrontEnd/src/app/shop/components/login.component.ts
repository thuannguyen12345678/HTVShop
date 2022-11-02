import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';

import { first } from 'rxjs/operators';

@Component({
  selector: 'app-login',
  templateUrl: '../templates/login.component.html',
})
export class LoginComponent implements OnInit {
  loginForm !: FormGroup;
  login: any;
  submitted = false;
  token: any;
  error ='';
  message: string = 'login successfully';
  constructor() { }

  ngOnInit(): void {
    
    }
  }



