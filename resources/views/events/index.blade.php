@extends('spark::layouts.app')

@section('content')
    <div>
        events index
        <event-index :user="user" :teams="teams" inline-template>
            <div>
                <h3>User ID @{{ user.id }}</h3>
                <h3>Teams 0 ID @{{ teams[0].id }}</h3>
            </div>
        </event-index>
    </div>
@endsection
