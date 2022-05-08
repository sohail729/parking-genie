@extends('layouts.dashboard')

@section('content')
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Spaces</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('host.dashboard.index') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active"> <a href="javascript:void(0)">Spaces</a></li>
                                </ul>
                            </nav>
                        </div><!-- .nk-block-head-content -->

                    </div><!-- .nk-block-between -->
                </div>

                <!-- main alert @s -->
                @include('dashboard.partials.alerts')
                <!-- main alert @e -->

                <div class="components-preview  mx-auto">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-preview">
                            <div class="card-inner">
                                <table class="datatable-init nowrap table">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Address</th>
                                        <th>Price</th>
                                        <th>Session</th>      
                                        <th>Timings</th>
                                        <th>Added on</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->space_parkings as $key => $space)
                                            <tr>
                                                <td title="{{$space->title}}">{{htmlToText($space->title, 20)}}</td>
                                                <td title="{{ $space->address }}">{{ htmlToText($space->address, 30)}}</td>
                                                <td>${{$space->base_price}} / <small>{{$space->price_type}}</small> </td>
                                                <td>
                                                <p> {{getMonth($space->session_start) }} - {{getMonth($space->session_end) }}</p>
                                                </td>
                                                <td>
                                                <p> {{ getTime($space->earliest_reservation) }} - {{ getTime($space->lastest_reservation) }}</p>
                                                </td>
                                                <td>
                                                <p> {{ getFormattedDate($space->created_at, 'd-M-Y') }}</p>
                                                </td>  
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a id="edit" class="btn bg-blue text-white btn-sm" href='{{ route("host.space.edit", encrypt($space->id)) }}'>
                                                            <em class="icon ni ni-edit"></em></a>
                                                    </div>
                                                </td>        
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>

<!-- content @e -->
@endsection
@push('scripts')
@endpush