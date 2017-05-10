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
                </tr>
                </thead>
                <tbody>
                <tr v-for="event in events">
                    <td class="vert-align event_name">
                        <a v-bind:href="'/event/' + event.id + '/edit">@{{ event.name}}</a>
                    </td>

                    <td class="vert-align event_type">
                        @{{ event.type }}
                    </td>

                    <td class="vert-align event_description">
                        @{{ event.description }}
                    </td>

                    <td class="vert-align event_location">
                        @{{ event.location }}
                    </td>

                    <td class="vert-align event_contact">
                        @{{ event.contact }}
                    </td>

                    <td class="vert-align event_start">
                        @{{ event.open_date_time }}
                    </td>

                    <td class="vert-align event_draw_date">
                        @{{ event.drawing_date_time }}
                    </td>
                </tr>
                <tr v-if="!dataLoaded">
                    <td colspan="7">
                        Loading... &nbsp; <i class="fa fa-spinner fa-spin"></i>
                    </td>
                </tr>
                <tr v-show="dataLoaded && events.length == 0">
                    <td colspan="7">
                        No Orders
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </event-index>

@endsection
