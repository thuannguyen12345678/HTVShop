import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-register',
  templateUrl: '../templates/register.component.html',
})
export class RegisterComponent implements OnInit {
  registerForm !: FormGroup;
  register:any;
  submitted = false;
  constructor() { }

  ngOnInit(): void {
  
    }
}