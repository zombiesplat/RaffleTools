@extends('spark::layouts.app')

@section('content')
    <item-index :event_id="{{$event_id}}" inline-template>
        <div class="spark-screen container">
            <div class="row">
                <h3>Items</h3>
            </div>
            <table class="index-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items">
                    <td class="vert-align item_name">
                        <a v-bind:href="'/item/' + item.id">@{{ item.name}}</a>
                    </td>

                    <td class="vert-align item_type">
                        @{{ item.type_name }}
                    </td>

                    <td class="vert-align item_description">
                        @{{ item.description }}
                    </td>

                    <td class="vert-align item_image">
                        @{{ item.image }}
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a v-bind:href="'/item/' + item.id">View item</a></li>
                                <li><a v-bind:href="'/item/' + item.id + '/edit'">Edit item</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr v-if="!dataLoaded">
                    <td colspan="5">
                        <div class="alert alert-info">
                            Loading... &nbsp; <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </td>
                </tr>
                <tr v-show="dataLoaded && items.length == 0">
                    <td colspan="5">
                        <div class="alert alert-info">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> No Orders
                        </div>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </item-index>
@endsection
