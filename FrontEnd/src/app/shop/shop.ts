export interface Product {
   id:any;
    name: any;
    price: any;
    amount: any;
    sale_price: any;
    image:{ url: string};
    description: any;
    status: any;
  }
  export interface Category {
    name: any;
    status:any
  }
  export interface Review {
    content: any;
    vote: any;
    customer_id: any;
    product_id:any
  }
  export interface Register {
    email:any;
    password: any;
    password_confirmation: any;
  }
  export interface User {
    email:any;
    token:any;
  }
  export interface Brand {
    name: any;
    logo: any;
    status: any;
  }
  export interface Image {
    file_name: any;
    product_id: any;
  }
