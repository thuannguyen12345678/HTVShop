import { CUSTOM_ELEMENTS_SCHEMA, NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './components/home.component';
import { HttpClientModule } from '@angular/common/http';
import { ReactiveFormsModule,FormsModule } from '@angular/forms';
import {provideRoutes, RouterModule} from '@angular/router';
import { ProductListComponent } from './components/product-list.component';
import { CheckoutComponent } from './components/checkout.component';
import { ProductDetailsComponent } from './components/product-details.component';
import { RegisterComponent } from './components/register.component';
import { LoginComponent } from './components/login.component';
import { ShopRoutingModule } from './shop-routing.module';



@NgModule({
  declarations: [
    HomeComponent,
    ProductListComponent,
    CheckoutComponent,
    ProductDetailsComponent,
    RegisterComponent,
    LoginComponent,
  ],
  imports: [
    CommonModule,
    RouterModule,
    HttpClientModule,
    ReactiveFormsModule,
    FormsModule,
    RouterModule,
    ShopRoutingModule,
  ],
  providers: [],
})
export class ShopModule { }
