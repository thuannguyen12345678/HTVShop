export interface Product {
   id:any;
    name: any;
    price: any;
    amount: any;
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
    name:any;
    email:any;
    phone:any;
    password: any;
    password_confirmation: any;
  }
  export interface User {
    id?:any;
    name?:any;
    phone?:any;
    email:any;
    password:any;
  }
  export interface Brand {
    name: any;
    image: any;
    status: any;
  }
  export interface Banner {
    url: any;
    image: any;
    status: any;
  }
  export interface Image {
    file_name: any;
    product_id: any;
  }
