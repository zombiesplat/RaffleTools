@extends('spark::layouts.app')

@section('content')
    <event-index :user="user" :current-team="currentTeam" :teams="teams" inline-template>
        <div class="spark-screen container">
            <div class="row">
                <h3>Events</h3>
            </div>
            <table class="index-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th>Start</th>
                    <th>Drawing Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="event in events">
                    <td class="vert-align event_name">
                        <a v-bind:href="'/event/' + event.id">@{{ event.name}}</a>
                    </td>

                    <td class="vert-align event_type">
                        @{{ event.type_name }}
                    </td>

                    <td class="vert-align event_description">
                        @{{ event.description }}
                    </td>

                    <td class="vert-align event_location">
                        @{{ event.location_name }}
                    </td>

                    <td class="vert-align event_contact">
                        @{{ event.contact_name }}
                    </td>

                    <td class="vert-align event_start">
                        @{{ event.open_date_time }}
                    </td>

                    <td class="vert-align event_draw_date">
                        @{{ event.drawing_date_time }}
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a v-bind:href="'/event/' + event.id">View Event</a></li>
                                <li><a v-bind:href="'/event/' + event.id + '/edit'">Edit Event</a></li>
                                <li><a v-bind:href="'/event/' + event.id + '/items'">Edit Items</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr v-if="!dataLoaded">
                    <td colspan="8">
                        <div class="alert alert-info">
                            Loading... &nbsp; <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </td>
                </tr>
                <tr v-show="dataLoaded && events.length == 0">
                    <td colspan="8">
                        <div class="alert alert-info">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> No Orders
                        </div>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </event-index>

@endsection
