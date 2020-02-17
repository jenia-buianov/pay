@extends('layouts.logged')


@section('content')

    <div class="row mt-5">
        <form-invoice
            :links="{{json_encode(['cities'=>url('dashboard/cities'),'save'=>url('dashboard/invoices/create'),'send'=>url('dashboard/invoice/send')])}}"
            :offer_types="{{$offer_types->toJson()}}"
            :phone_types="{{$phone_types->toJson()}}"
            inline-template>
            <form autocomplete="off" action="#" @submit="generate($event)" method="post" class="col-12 bg-white py-3">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <label>{{__('Transporter')}}</label>
                    </div>
                    <div class="col-md-6 col-lg-9">
                        <multiselect
                            v-model="form.transporter"
                            label="name"
                            track-by="id"
                            :options="{{$transporters->toJson()}}">
                        </multiselect>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h3>{{__('Route information')}}</h3>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-4 col-lg-3">
                        <label>{{__('Direction')}}</label>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <multiselect
                            v-model="form.direction.from"
                            label="translate"
                            track-by="id"
                            @search-change="findCity"
                            placeholder="{{__('Location from')}}"
                            :loading="isLoading"
                            :options="cities">
                        </multiselect>
                    </div>
                    <div class="col-md-4 col-lg-5">
                        <multiselect
                            v-model="form.direction.to"
                            label="translate"
                            track-by="id"
                            @search-change="findCity"
                            :loading="isLoading"
                            placeholder="{{__('Location to')}}"
                            :options="cities">
                        </multiselect>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 col-lg-3">
                        <label>{{__('Dates')}}</label>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <label class="col-md-6 col-lg-6">
                            {{__('Course date')}}
                        </label>
                        <datetime type="datetime" class="theme-orange" v-model="form.direction.date"></datetime>
                    </div>
                    <div class="col-md-4 col-lg-5">
                        <label class="col-md-6 col-lg-5">
                            {{__('Pay till')}}
                        </label>
                        <datetime class="theme-orange" v-model="form.direction.due_date"></datetime>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <h3>{{__('Client information')}}</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <label>{{__('Name')}}</label>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <input autocomplete="random{{rand(0,256)}}" type="text" placeholder="{{__('First name')}}" v-model="form.client.first_name" class="form-control">
                    </div>
                    <div class="col-md-4 col-lg-5">
                        <input autocomplete="random{{rand(257,512)}}" type="text" placeholder="{{__('Last name')}}" v-model="form.client.last_name" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 col-lg-3">
                        <label>{{__('Contacts')}}</label>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <input autocomplete="random{{rand(513,768)}}" type="number" placeholder="{{__('Phone')}}" v-model="form.client.phone" class="form-control">
                    </div>
                    <div class="col-md-4 col-lg-5">
                        <input autocomplete="random{{rand(769,1024)}}" type="text" placeholder="{{__('Email')}}" v-model="form.client.email" class="form-control">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 col-lg-3">
                        <label>{{__('Another phone')}}</label>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <input autocomplete="random{{rand(1025,1300)}}" type="number" placeholder="{{__('Number')}}" v-model="form.client.another_phone" class="form-control">
                    </div>
                    <div class="col-md-4 col-lg-5">
                        <multiselect
                            v-model="form.client.another_phone_type"
                            label="name"
                            track-by="id"
                            :options="{{$phone_types->toJson()}}">
                        </multiselect>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 col-lg-3">
                        <label>{{__('Location')}}</label>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <multiselect
                            v-model="form.client.country"
                            label="translate"
                            track-by="id"
                            placeholder="{{__('Select country')}}"
                            :options="{{$countries->toJson()}}">
                        </multiselect>
                    </div>
                    <div class="col-md-4 col-lg-5">
                        <vue-tags-input
                            v-model="tag"
                            :tags="form.client.state"
                            :max-tags="{{json_encode(1)}}"
                            :autocomplete-items="autocompleteItems"
                            @tags-changed="newTags => form.client.state = newTags"
                            placeholder="{{__('Enter state')}}"
                        />
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 col-lg-3">
                        <label>{{__('Location')}}</label>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <vue-tags-input
                            v-model="tag"
                            :tags="form.client.city"
                            :max-tags="{{json_encode(1)}}"
                            :autocomplete-items="autocompleteItems"
                            @tags-changed="newTags => form.client.city = newTags"
                            placeholder="{{__('Enter city')}}"
                        />
                    </div>
                    <div class="col-md-4 col-lg-5">
                        <input autocomplete="random{{rand(1301,2000)}}" type="text" placeholder="{{__('Address')}}" v-model="form.client.address" class="form-control">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-xs-12 col-sm-12 col-md-10">
                        <h3>{{__('Passengers')}}</h3>
                    </div>
                    <div class="col-12 col-md-2 text-right">
                        <button class="btn btn-primary btn-sm" @click="addPassenger($event)"><i class="fa fa-plus"></i> {{__('passenger')}}</button>
                    </div>
                </div>
                <div class="row mt-5">
                    <div v-if="form.passengers.length>0" v-for="(row,index) in form.passengers" class="col-12 row mt-3 passenger">
                        <div class="col-md-6 col-lg-3">
                            <input autocomplete="random{{rand(2001,3000)}}" class="form-control" type="text" :name="'passenger['+index+']'" v-model="form.passengers[index].first_name" placeholder="{{__('First name')}}">
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <input autocomplete="random{{rand(3001,4000)}}" class="form-control" type="text" :name="'passenger['+index+']'" v-model="form.passengers[index].last_name" placeholder="{{__('Last name')}}">
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <multiselect
                                v-model="form.passengers[index].offer_type"
                                label="translate"
                                track-by="id"
                                placeholder="{{__('Offer type')}}"
                                :options="{{$offer_types->toJson()}}">
                            </multiselect>
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <input autocomplete="random{{rand(4001,5000)}}" class="form-control" type="number" :name="'passenger['+index+']'" v-model="form.passengers[index].price" placeholder="{{__('Price')}}">
                        </div>
                        <div class="col-md-4 col-lg-2">
                            <multiselect
                                v-model="form.passengers[index].currency"
                                label="charcode"
                                track-by="id"
                                placeholder="{{__('Currency')}}"
                                :options="{{$currencies->toJson()}}">
                            </multiselect>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <input type="text" class="form-control col-12 col-lg-3 d-inline mr-3" v-if="inv !== null" :value="'{{url('/')}}/i/'+inv.uuid">
                        <button v-if="inv == null" class="btn btn-success" @click="generate($event)">{{__('Generate invoice')}}</button>
                        <button v-if="inv !== null && sent==false" class="btn btn-warning" @click="sendNotification($event)">{{__('Send SMS')}}</button>
                    </div>
                </div>
            </form>
        </form-invoice>
    </div>
@endsection
