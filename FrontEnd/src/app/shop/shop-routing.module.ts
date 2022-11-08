import { Routes } from '@angular/router';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { CheckoutComponent } from './components/checkout.component';
import { HomeComponent } from './components/home.component';
import { LoginComponent } from './components/login.component';
import { ProductDetailsComponent } from './components/product-details.component';
import { ProductListComponent } from './components/product-list.component';
import { RegisterComponent } from './components/register.component';
import { ListorderComponent } from './components/listorder.component';
import { OrderDetailComponent } from './components/order-detail.component';

const routes: Routes = [
  { path: '', redirectTo: '/home', pathMatch: 'full' },
  { path: 'home', component: HomeComponent },
  { path: 'product-list', component: ProductListComponent },
  {
     path: 'checkout', component: CheckoutComponent},
   { path: 'product-detail/:id', component: ProductDetailsComponent },
   {
     path: 'register', component: RegisterComponent,
   },
  {
    path: 'login', component: LoginComponent,
  },
  { path: 'order-detail/:id', component: OrderDetailComponent },
  { path: 'listorder/:id', component: ListorderComponent },
  
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ShopRoutingModule { }
