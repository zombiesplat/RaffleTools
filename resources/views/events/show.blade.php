@extends('spark::layouts.app')

@section('content')
    <event-show :event_id="{{$event_id}}" inline-template>
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
                    @{{ event.type_name }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Name
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ event.name }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Description
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ event.description }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Location Name
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ event.location_name }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Location Address
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ event.location_address }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Location Address
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ event.location_address }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Contact Name
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ event.contact_name }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Contact Phone
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ event.contact_phone }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Event Starts
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ event.open_date_time }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Drawing Starts
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ event.drawing_date_time }}
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Terms and Conditions
                    </h3>
                </div>
                <div class="panel-body">
                    @{{ event.terms_and_conditions }}
                </div>
            </div>
        </div>
    </event-show>

@endsection
