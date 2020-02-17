@extends('layouts.logged')


@section('content')
    <div class="row mt-5">
        <div class="statistic-badge col-md-3">
            {{__('Invoices')}}
            <span>{{$statistics['invoices']}}</span>
        </div>
        <div class="statistic-badge col-md-3">
            {{__('Paid')}}
            <span>{{$statistics['paid']}}</span>
        </div>
        <div class="statistic-badge col-md-3">
            {{__('Unpaid')}}
            <span>{{$statistics['unpaid']}}</span>
        </div>
        <div class="statistic-badge col-md-3">
            {{__('Total money')}}
            <span>{{$statistics['money']}} EUR</span>
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-right mt-5">
            <a href="{{url('dashboard/invoices/create')}}" class="btn btn-success">{{__('Create invoice')}}</a>
        </div>
        <invoices :inv="{{$invoices->toJson()}}" :ppage="{{json_encode(15)}}" :pages="{{json_encode($pages)}}" inline-template>
            <div class="col-12 table-responsive bg-white mt-1">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('From')}}</th>
                            <th>{{__('To')}}</th>
                            <th>{{__('Sum')}}</th>
                            <th>{{__('Status')}}</th>
                            <th style="text-align:right">{{__('View')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row, index) in invoices">
                            <td>@{{ index+1 }}</td>
                            <td>@{{ row.details.name }}</td>
                            <td>@{{ row.location_from.translate }}</td>
                            <td>@{{ row.location_to.translate }}</td>
                            <td>@{{ row.sum }}</td>
                            <td>
                                <span :class="row.status.code">@{{ row.status.name }}</span>
                            </td>
                            <td style="text-align:right">
                                <a :href="'{{url('i')}}/'+row.uuid" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="pages>1">
                    <button v-if="page>1" class="btn btn-default">{{__('Prev')}}</button>
                    <button v-if="page<pages" class="btn btn-default">{{__('Next')}}</button>
                </div>
            </div>
        </invoices>
    </div>
@endsection
