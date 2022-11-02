import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CheckoutComponent } from './components/checkout.component';
import { HomeComponent } from './components/home.component';
import { LoginComponent } from './components/login.component';
import { ProductDetailsComponent } from './components/product-details.component';
import { ProductListComponent } from './components/product-list.component';
import { RegisterComponent } from './components/register.component';

const routes: Routes = [
  { path: '', redirectTo: '/home', pathMatch: 'full' },
  { path: 'home', component: HomeComponent },
  { path: 'product-list', component: ProductListComponent },
  {
     path: 'checkout', component: CheckoutComponent},
   { path: 'product-detail', component: ProductDetailsComponent },
   {
     path: 'register', component: RegisterComponent,
   },
  {
    path: 'login', component: LoginComponent,
  },
  // { path: 'cart', component: CartComponent },
  // { path: 'order-detail/:id', component: OrderDetailComponent },
  // { path: 'order-pay-online/:id', component: OrderPayOnlineComponent },
  // { path: 'order/check', component: OrderCheckComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ShopRoutingModule { }