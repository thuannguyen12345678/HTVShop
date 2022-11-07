import { HttpClientModule, HttpHandler, HttpEvent, HTTP_INTERCEPTORS } from '@angular/common/http';

import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule } from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { FooterComponent } from './shop/components/footer.component';
import { HeaderComponent } from './shop/components/header.component';
import { ShopRoutingModule } from './shop/shop-routing.module';
import { ToastrModule } from 'ngx-toastr';
import { NgxPaginationModule } from 'ngx-pagination';
import { JWTInterceptorService } from './shop/jwtinterceptor.service';
@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ShopRoutingModule,
    HttpClientModule,
    ReactiveFormsModule,
    NgxPaginationModule,
    ToastrModule.forRoot(

    ),
  ],
  providers:[{ provide: HTTP_INTERCEPTORS, useClass: JWTInterceptorService, multi: true },
    { provide: HTTP_INTERCEPTORS, useClass: JWTInterceptorService, multi: true },],
  bootstrap: [AppComponent]
})
export class AppModule { }
