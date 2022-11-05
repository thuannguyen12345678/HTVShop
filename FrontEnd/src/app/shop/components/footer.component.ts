import { Component, OnInit } from '@angular/core';
import { OrderService } from '../services/order.service';

@Component({
  selector: 'app-footer',
  templateUrl: '../templates/footer.component.html',
})
export class FooterComponent implements OnInit {
  listCart: any;
  cartSubtotal: number = 0;
  constructor(private orderService: OrderService) { }

  ngOnInit(): void {
    this.getAllCart();
  }

  getAllCart() {
    this.orderService.getAllCart().subscribe(res => {
        this.listCart = res;
        this.cartSubtotal = 0;
        for(let cart of this.listCart){
            this.cartSubtotal += cart.price * cart.amount;
        }
    });
}
updateAmount(id: any, amount: any){
    this.orderService.updateAmount(id, amount).subscribe(res => {
        this.getAllCart();
    });
}
deleteCart(id: any){
    this.orderService.deleteCart(id).subscribe(res => {
        this.getAllCart();
    });
}

}