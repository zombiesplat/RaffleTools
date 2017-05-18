@extends('spark::layouts.app')

@section('content')
    <item-index :event_id="{{$event_id}}" inline-template>
        <div class="spark-screen container">
            <div class="row">
                <h3>Items</h3>
            </div>
            <div class="row equal-height-container">
                <div v-for="item in items" class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img v-bind:src="item.image" style="max-width:200px;" alt="">
                        <div class="caption">
                            <h3>@{{ item.name }}</h3>
                            <p>@{{ item.description }}</p>
                            <p>
                                <a class="btn btn-primary" role="button" v-bind:href="'/item/' + item.id + '/edit'">Edit item</a>
                                <a class="btn btn-default" role="button" v-bind:href="'/item/' + item.id">View item</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </item-index>
@endsection
