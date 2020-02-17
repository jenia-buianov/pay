@extends('layouts.invoice')
@section('title'){{__('Invoice #:invoice, Rezervare bilet :from - :to',['invoice'=>$invoice->id,'from'=>$invoice->locationFrom->translate,'to'=>$invoice->locationTo->translate])}}@endsection

@section('content')
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Payment Method')}}</h5>
                </div>
                <div class="modal-body">
                    @foreach($methods as $i=>$method)
                        <div class="row payment_method">
                            <div class="col-md-2 col-3">
                                <img src="{{asset('images/'.mb_strtolower(str_replace(' ','',$method->name)))}}.png">
                            </div>
                            <div class="col-md-10 col-9 method_name">
                                {{$method->title}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>

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
        <!--End Info-->
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
        <div class="col-md-6 col-12">
            <div id="project">
                <h2 class="reservation">{{__('Reservation')}} {{$invoice->locationFrom->translate}} - {{$invoice->locationTo->translate}}</h2>
                <h3 style="text-align:right;font-size:14px">{{$invoice->date->format('d M Y')}}, {{__('time')}}: {{mb_substr($invoice->time,0,5)}}</h3>
            </div>
        </div>
    </div><!--End Invoice Mid-->

    <div class="row" id="invoice-bot">

        <div class="col-12 table-responsive" id="table">
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

                @if(isset($tax))
                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="Rate"><h2>{{__('Tax')}}</h2></td>
                        <td class="payment"><h2>{{number_format($tax['amount'],2)}} {{$tax['currency']}}</h2></td>
                    </tr>
                @endif

                <tr class="tabletitle">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="Rate"><h2>{{__('Total')}}</h2></td>
                    <td class="payment"><h2>{{$total['amount']}} {{$total['currency']}}</h2></td>
                </tr>

            </table>
        </div><!--End Table-->
        <div class="col-12 col-md-6" id="legalcopy">
            <p>
                <strong>{{__('Thank you for your business!')}}</strong><br>
                <font style="color:red">{{__('You should pay the invoice till')}} {{$invoice->due_date->format('M d, Y')}} 00:00</font><br>
                {{__('If you are not pay the invoice, reservation will be canceled')}}
            </p>
        </div>

        <div class="col-12 col-md-6 text-right mt-3">
            <button class="btn btn-success" data-toggle="modal" data-target="#paymentModal">{{__('PAY')}}</button>
        </div>
    </div><!--End InvoiceBot-->
@endsection
