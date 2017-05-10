@extends('spark::layouts.app')

@section('content')
    <event-edit :event_id="{{$event_id}}" inline-template>
        <div class="spark-screen container">
            <div v-if="!dataLoaded">
                <div class="alert alert-info">
                    Loading... &nbsp; <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="form-horizontal">
                <div class="form-group required" :class="{'has-error': form.errors.has('type')}">
                    <label class="col-sm-2 control-label" for="event_type">
                        Type
                    </label>
                    <div class="col-sm-10">
                        <select name="type"
                                class="form-control"
                                v-model="form.type"
                                id="event_type"
                                required
                        >
                            @foreach(\App\Model\Event::TYPES as $k => $v)
                                <option value="{{ $k }}">{{$v}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('type')">
                        @{{ form.errors.get('type') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('name')}">
                    <label class="col-sm-2 control-label" for="event_name">
                        Name
                    </label>
                    <div class="col-sm-10">
                        <input name="name"
                               class="form-control"
                               v-model="form.name"
                               id="event_name"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('name')">
                        @{{ form.errors.get('name') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('description')}">
                    <label class="col-sm-2 control-label" for="event_description">
                        Description
                    </label>
                    <div class="col-sm-10">
                        <input name="description"
                               class="form-control"
                               v-model="form.description"
                               id="event_description"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('description')">
                        @{{ form.errors.get('description') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('location_name')}">
                    <label class="col-sm-2 control-label" for="event_location_name">
                        location_name
                    </label>
                    <div class="col-sm-10">
                        <input name="location_name"
                               class="form-control"
                               v-model="form.location_name"
                               id="event_location_name"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('location_name')">
                        @{{ form.errors.get('location_name') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('location_address')}">
                    <label class="col-sm-2 control-label" for="event_location_address">
                        location_address
                    </label>
                    <div class="col-sm-10">
                        <input name="location_address"
                               class="form-control"
                               v-model="form.location_address"
                               id="event_location_address"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('location_address')">
                        @{{ form.errors.get('location_address') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('contact_name')}">
                    <label class="col-sm-2 control-label" for="event_contact_name">
                        contact_name
                    </label>
                    <div class="col-sm-10">
                        <input name="contact_name"
                               class="form-control"
                               v-model="form.contact_name"
                               id="event_contact_name"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('contact_name')">
                        @{{ form.errors.get('contact_name') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('contact_phone')}">
                    <label class="col-sm-2 control-label" for="event_contact_phone">
                        contact_phone
                    </label>
                    <div class="col-sm-10">
                        <input name="contact_phone"
                               class="form-control"
                               v-model="form.contact_phone"
                               id="event_contact_phone"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('contact_phone')">
                        @{{ form.errors.get('contact_phone') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('open_date_time')}">
                    <label class="col-sm-2 control-label" for="event_open_date_time">
                        open_date_time
                    </label>
                    <div class="col-sm-10">
                        <input name="open_date_time"
                               class="form-control"
                               v-model="form.open_date_time"
                               id="event_open_date_time"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('open_date_time')">
                        @{{ form.errors.get('open_date_time') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('drawing_date_time')}">
                    <label class="col-sm-2 control-label" for="event_drawing_date_time">
                        drawing_date_time
                    </label>
                    <div class="col-sm-10">
                        <input name="drawing_date_time"
                               class="form-control"
                               v-model="form.drawing_date_time"
                               id="event_drawing_date_time"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('drawing_date_time')">
                        @{{ form.errors.get('drawing_date_time') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('terms_and_conditions')}">
                    <label class="col-sm-2 control-label" for="event_terms_and_conditions">
                        terms_and_conditions
                    </label>
                    <div class="col-sm-10">
                        <textarea name="terms_and_conditions"
                               class="form-control"
                               v-model="form.terms_and_conditions"
                               id="event_terms_and_conditions"
                               required
                        ></textarea>
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('terms_and_conditions')">
                        @{{ form.errors.get('terms_and_conditions') }}
                    </span>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit"
                                class="btn btn-default"
                                @click="saveForm"
                        >
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </event-edit>

@endsection
