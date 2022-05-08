@extends('layouts.dashboard')

@section('content')
	<!-- content @s -->
    <div class="nk-content ">
        <div class="container">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Space Details</h3>
                                <div class="nk-block-des text-soft">
                                    {{-- <p>An example page for product details</p> --}}
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex">
                                    <em class="icon ni ni-arrow-left"></em>
                                    <span>Back</span>
                                </a>
                               
                            </div>
                        </div>
                    </div>
                    <!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="row pb-5">
                                    <div class="col-lg-6">
                                        <div class="product-gallery mr-xl-1 mr-xxl-5">
                                            <div class="slider-init" id="sliderFor" data-slick='{"arrows": false, "fade": true, "asNavFor":"#sliderNav", "slidesToShow": 1, "slidesToScroll": 1}'>
                                                @foreach ($space->spaceImages as $key => $image)
                                                    <div class="slider-item rounded">
                                                        <img src="{{ asset('uploads/parking/'. $image->image) }}" class="w-100" alt="">
                                                    </div>                                            
                                                @endforeach
                                            </div>
                                            <!-- .slider-init -->
                                            <div class="slider-init slider-nav" id="sliderNav" data-slick='{"arrows": false, "slidesToShow": 5, "slidesToScroll": 1, "asNavFor":"#sliderFor", "centerMode":true, "focusOnSelect": true,
                                                                                    "responsive":[ {"breakpoint": 1539,"settings":{"slidesToShow": 4}}, {"breakpoint": 768,"settings":{"slidesToShow": 3}}, {"breakpoint": 420,"settings":{"slidesToShow": 2}} ]
                                                                                }'>
                                   
                                                @foreach ($space->spaceImages as $key => $image)
                                                <div class="slider-item">
                                                    <div class="thumb">
                                                        <img src="{{ asset('uploads/parking/'. $image->image) }}" alt="">
                                                    </div>
                                                </div>                                          
                                            @endforeach
                                            </div>
                                            <!-- .slider-nav -->
                                        </div>
                                        <!-- .product-gallery -->
                                    </div>
                                    <!-- .col -->
                                    <div class="col-lg-6">
                                        <div class="product-info mt-5 mr-xxl-5">
                                            <h4 class="product-price text-primary">$ {{ toFloat($space->base_price) }}</h4>
                                            <h2 class="product-title">{{ $space->title }}</h2>
                                            {{-- <div class="product-rating">
                                                <ul class="rating">
                                                    <li>
                                                        <em class="icon ni ni-star-fill"></em>
                                                    </li>
                                                    <li>
                                                        <em class="icon ni ni-star-fill"></em>
                                                    </li>
                                                    <li>
                                                        <em class="icon ni ni-star-fill"></em>
                                                    </li>
                                                    <li>
                                                        <em class="icon ni ni-star-fill"></em>
                                                    </li>
                                                    <li>
                                                        <em class="icon ni ni-star-half"></em>
                                                    </li>
                                                </ul>
                                                <div class="amount">(2 Reviews)</div>
                                            </div> --}}
                                            <!-- .product-rating -->
                                            <div class="product-excrept text-soft">
                                                <p class="lead">{{ $space->description }}</p>
                                            </div>
                                            <div class="product-meta">
                                                <ul class="g-3 gx-5">
                                                    <li>
                                                        <div class="fs-14px text-muted">Hosted By</div>
                                                        <div class="fs-16px fw-bold text-secondary">{{ $space->spaceHost->fname  }} {{ $space->spaceHost->lname  }}</div>
                                                    </li>
                                                    <li>
                                                        <div class="fs-14px text-muted">Address</div>
                                                        <div class="fs-16px fw-bold text-secondary">{{ $space->address  }}</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- .product-info -->
                                    </div>
                                    <!-- .col -->
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <!-- .nk-block -->                  
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection

@push('scripts')

@endpush