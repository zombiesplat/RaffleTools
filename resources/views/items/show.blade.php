@extends('spark::layouts.app')

@section('content')
    <item-show :item_id="{{$item_id}}" inline-template>
        <div class="spark-screen container">
            <div v-if="!dataLoaded">
                <div class="alert alert-info">
                    Loading... &nbsp; <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Type
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ item.type_name }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Name
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ item.name }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Description
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ item.description }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Image
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="thumbnail">
                        <img v-bind:src="item.image_src" alt="">
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Value
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ item.value }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Cost
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ item.cost }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Sponsor
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ item.sponsor }}
                </div>
            </div>
        </div>
    </item-show>

@endsection
