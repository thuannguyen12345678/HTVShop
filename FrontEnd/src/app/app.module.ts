import { HttpClientModule, HttpHandler, HttpEvent } from '@angular/common/http';

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
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
