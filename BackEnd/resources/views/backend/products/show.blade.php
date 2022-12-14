@extends('backend.master')
@section('content')
    <div class="card">
        <a href="{{ route('products.index') }}" class="btn btn-danger btn-rounded waves-effect waves-light ">
            <i class=" fas fa-reply-all"></i>
            Back</a>
        <div class="row g-0">
            <div class="col-md-6 border-end">
                <div style="text-align: center" class="d-flex flex-column justify-content-center">
                    <div  class="main_image"> <img src="{{ asset($products->image) }}" id="main_product_image" height="350px" width="450">
                    </div> <br>
                    <div class="thumbnail_images">
                        <ul id="thumbnail">
                            <li>
                                @foreach ($products->image_products as $file_name)
                                    <img  onclick="changeImage(this)" src="{{ asset($file_name->file_name) }}"
                                       height="100px" width="90px">
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 right-side">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $products->name }}</h3> <span class="heart">
                            {{ $products->status == 0 ? 'hidden' : 'show' }}</span>
                    </div>
                    <div class="mt-2 pr-3 content">
                        {{-- <span> Created_by: {{ $products->user->name }} </span> --}}
                    </div>
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" checked />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" checked />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" checked />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div><br>

                    <div >
                        <span class="line-through"><h4><b>S??? l?????ng :</b> {{$products->amount}} c??i </h4></span>
                    </div><br>
                    <div >
                        <span class="line-through"><h4><b>Gi?? :</b> {{ number_format( $products->price)}} vn?? </h4></span>
                    </div><br>

                    <div >
                        <span class="line-through"><h4><b>M??u :</b> {{  $products->color}}  </h4></span>
                    </div><br>
                    {{-- <span>3 Reviews</span> --}}
                    <div class="products-price-discount">   
                        <span
                            class="line-through"><h3><b>T???ng ti???n: </b>{{ number_format($products->amount * $products->price)  }} vn?? </h3></span>
                    </div>
                    <div class="ratings d-flex flex-row align-items-center">
                        <div class="d-flex flex-row">

                        </div>
                    </div>

                </div>
            </div>
            <div class="container">
                <div class="product-info-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description"
                                role="tab" aria-controls="description" aria-selected="true">M?? t???</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                                aria-controls="review" aria-selected="false">????nh gi?? (0)</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="description-tab">
                            {!! $products->description !!}
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="review-heading">????nh gi??</div>
                            <p class="mb-20">Hi???n t???i ch??a c?? ????nh gi?? n??o</p><br><br>
                            <div class="form-group">
                                <label>????nh gi?? c???a b???n</label>
                                <div class="reviews-counter">
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
