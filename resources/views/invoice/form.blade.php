@extends('layouts.invoice')
@section('title'){{__('Invoice #:invoice, Rezervare bilet :from - :to',['invoice'=>$invoice->id,'from'=>$invoice->locationFrom->translate,'to'=>$invoice->locationTo->translate])}}@endsection

@section('content')
    <form action="{{route('invoice',['uuid'=>$invoice->uuid])}}" method="post" style="float:none;text-align: left;margin-top: 0px">
        <div id="invoice-top" class="row">
            <div class="col-12 col-md-6">
                <img class="logo" src="https://scontent.fkiv5-1.fna.fbcdn.net/v/t1.0-9/60873565_2319394741416942_5989460872139898880_n.jpg?_nc_cat=111&_nc_ohc=ntCruHepw1sAX-Lw16n&_nc_ht=scontent.fkiv5-1.fna&oh=9ce9e0ae20745487b91c6ed9bd0165ad&oe=5F02C0AB">
                <div class="info">
                    <h2>SRL TechSola</h2>
                    <p> info@infogari.ro <br>
                        +40373744844
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="title">
                    <h1>{{__('Invoice')}} #{{$invoice->id}}</h1>
                    <p>
                        {{__('Issued')}}: {{$invoice->created_at->format('M d, Y')}}<br>
                        {{__('Payment Due')}}: {{$invoice->due_date->format('M d, Y')}}
                    </p>
                </div>
            </div>
        </div><!--End InvoiceTop-->
        @if(!empty(trim($invoice->details->name)))
            <div id="invoice-mid" class="row">
                <div class="col-12 col-md-6">
                    <div class="clientlogo"></div>
                    <div class="info">
                        <h2>{{$invoice->details->name}}</h2>
                        <p>
                            @if(!empty($invoice->details->email)){{$invoice->details->email}}<br>@endif
                            +{{$invoice->details->phone}}<br>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div id="project">
                        <h2 class="reservation">{{__('Reservation')}} {{$invoice->locationFrom->translate}} - {{$invoice->locationTo->translate}}</h2>
                        <h3 style="text-align:right;font-size:14px">{{$invoice->date->format('d M Y')}}, {{__('time')}}: {{mb_substr($invoice->time,0,5)}}</h3>
                    </div>
                </div>
            </div><!--End Invoice Mid-->
        @else
            <div id="invoice-mid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label>{{__('First name')}}</label>
                        <input type="text" autocomplete="rand{{rand(10000,11000)}}" name="client[first_name]" value="{{$invoice->details->first_name}}" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label>{{__('Last name')}}</label>
                        <input type="text" autocomplete="rand{{rand(11001,12000)}}" name="client[last_name]" value="{{$invoice->details->last_name}}" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-md-6">
                        <label>{{__('Phone')}}</label>
                        <input  autocomplete="rand{{rand(12001,13000)}}" type="number" name="client[phone]" value="{{$invoice->details->phone}}" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label>{{__('Email')}}</label>
                        <input  autocomplete="rand{{rand(13001,14000)}}" type="email" name="client[email]" value="{{$invoice->details->email}}" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-md-6">
                        <label>{{__('Another phone')}}</label>
                        <input autocomplete="rand{{rand(14001,15000)}}" type="text" name="client[another_phone]" value="{{$invoice->details->another_phone}}" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label>{{__('Another phone type')}}</label>
                        <select  autocomplete="rand{{rand(15001,16000)}}" class="form-control" name="client[another_phone_type_id]">
                            <option value="0">{{__('Select option')}}</option>
                            @foreach($types as $i=>$type)
                            <option value="{{$type->id}}" @if($type->id==$invoice->details->another_phone_type_id) selected="selected" @endif>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-md-6">
                        <label>{{__('State')}}</label>
                        <input autocomplete="rand{{rand(14051,15000)}}" type="text" name="client[client_state]" value="{{$invoice->details->client_state}}" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label>{{__('City')}}</label>
                        <input autocomplete="rand{{rand(14051,15000)}}" type="text" name="client[client_city]" value="{{$invoice->details->client_state}}" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-md-12">
                        <label>{{__('Address')}}</label>
                        <input autocomplete="rand{{rand(14051,15000)}}" type="text" name="client[client_address]" value="{{$invoice->details->client_address}}" class="form-control">
                    </div>
                </div>
            </div>
        @endif

        @if($invoice->passengers->count()>0 && !empty($invoice->passengers[0]->first_name))
            <div class="row" id="invoice-bot">

                <div id="table" class="table-responsive">
                    <table class="table">
                        <tr class="tabletitle">
                            <td class="item"><h2>{{__('name')}}</h2></td>
                            <td class="Hours"><h2>{{__('Category')}}</h2></td>
                            <td class="Hours"><h2>{{__('Quantity')}}</h2></td>
                            <td class="Rate"><h2>{{__('Unit Price')}}</h2></td>
                            <td class="subtotal"><h2>{{__('Amount')}}</h2></td>
                        </tr>

                        @foreach($invoice->passengers as $i=>$passenger)
                            <tr class="service">
                                <td class="tableitem"><p class="itemtext">@if(!empty($passenger->first_name)){{$passenger->first_name}} {{$passenger->last_name}}@endif</p></td>
                                <td class="tableitem"><p class="itemtext">{{$passenger->offerType->translate}}</p></td>
                                <td class="tableitem"><p class="itemtext">1</p></td>
                                <td class="tableitem"><p class="itemtext">{{number_format($passenger->amount,2)}} {{$passenger->currencyType->charcode}}</p></td>
                                <td class="tableitem"><p class="itemtext">{{number_format($passenger->amount,2)}} {{$passenger->currencyType->charcode}}</p></td>
                            </tr>
                        @endforeach
                    </table>
                </div><!--End Table-->
                @else
                    <div id="invoice-bot" class="row">

                        <div id="table" class="table-responsive">
                            <table class="table">
                                <tr class="tabletitle">
                                    <td class="item"><h2>{{__('name')}}</h2></td>
                                    <td class="Hours"><h2>{{__('Category')}}</h2></td>
                                    <td class="Hours"><h2>{{__('Quantity')}}</h2></td>
                                    <td class="Rate"><h2>{{__('Unit Price')}}</h2></td>
                                    <td class="subtotal"><h2>{{__('Amount')}}</h2></td>
                                </tr>

                                @if($invoice->passengers->count()>0)
                                    @foreach($invoice->passengers as $i=>$passenger)
                                        <tr class="service">
                                            <td class="tableitem"><p class="itemtext">
                                                    <input type="text" class="form-control"  autocomplete="rand{{rand(16001,17000)}}" value="{{old('passenger['.$i.'][first_name]')}}" required name="passengers[{{$i}}][first_name]" placeholder="{{__('Numele')}}">
                                                    <input type="text" class="form-control"  autocomplete="rand{{rand(17001,18000)}}" value="{{old('passenger['.$i.'][last_name]')}}" required name="passengers[{{$i}}][last_name]" placeholder="{{__('Prenumele')}}">
                                                </p></td>
                                            <td class="tableitem"><p class="itemtext">{{$passenger->offerType->translate}}</p></td>
                                            <td class="tableitem"><p class="itemtext">1</p></td>
                                            <td class="tableitem"><p class="itemtext">{{number_format($passenger->amount,2)}} {{$passenger->currencyType->charcode}}</p></td>
                                            <td class="tableitem"><p class="itemtext">{{number_format($passenger->amount,2)}} {{$passenger->currencyType->charcode}}</p></td>
                                        </tr>
                                    @endforeach
                                @endif

                            </table>
                        </div><!--End Table-->
                @endif

                @csrf
                <div class="col-12 col-md-6" id="legalcopy">
                    @if(count($errors)==0)
                        <p>
                            <strong>{{__('Thank you for your business!')}}</strong><br>
                            <font style="color:red">{{__('You should pay the invoice till')}} {{$invoice->due_date->format('M d, Y')}} 00:00</font><br>
                            {{__('If you are not pay the invoice, reservation will be canceled')}}
                        </p>
                    @else
                        <p style="color: red">{!! implode("<br>",$errors) !!}</p>
                    @endif
                </div>

                <div class="col-md-6 col-12 text-right mt-3">
                    <button class="btn btn-success" type="submit">{{__('Continue')}}</button>
                </div>
            </div><!--End InvoiceBot-->
    </form>
@endsection
