@extends('spark::layouts.app')

@section('content')
    <item-edit :item_id="{{$item_id}}" inline-template>
        <div class="spark-screen container">
            <div v-if="!dataLoaded">
                <div class="alert alert-info">
                    Loading... &nbsp; <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
            <div class="form-horizontal">
                <div class="form-group required" :class="{'has-error': form.errors.has('type')}">
                    <label class="col-sm-2 control-label" for="item_type">
                        Type
                    </label>
                    <div class="col-sm-10">
                        <select name="type"
                                class="form-control"
                                v-model="form.type"
                                id="item_type"
                                required
                        >
                            @foreach(\App\Model\Item::TYPES as $k => $v)
                                <option value="{{ $k }}">{{$v}}</option>
                            @endforeach
                        </select>
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('type')">
                        @{{ form.errors.get('type') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('name')}">
                    <label class="col-sm-2 control-label" for="item_name">
                        Name
                    </label>
                    <div class="col-sm-10">
                        <input name="name"
                               class="form-control"
                               v-model="form.name"
                               id="item_name"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('name')">
                        @{{ form.errors.get('name') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('description')}">
                    <label class="col-sm-2 control-label" for="item_description">
                        Description
                    </label>
                    <div class="col-sm-10">
                        <input name="description"
                               class="form-control"
                               v-model="form.description"
                               id="item_description"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('description')">
                        @{{ form.errors.get('description') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('image')}">
                    <label class="col-sm-2 control-label" for="item_image">
                        Image
                    </label>
                    <div class="col-sm-10">
                        <input name="image"
                               class="form-control"
                               v-model="form.image"
                               id="item_image"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('image')">
                        @{{ form.errors.get('image') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('value')}">
                    <label class="col-sm-2 control-label" for="item_value">
                        value
                    </label>
                    <div class="col-sm-10">
                        <input name="value"
                               class="form-control"
                               v-model="form.value"
                               id="item_value"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('value')">
                        @{{ form.errors.get('value') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('cost')}">
                    <label class="col-sm-2 control-label" for="item_cost">
                        cost
                    </label>
                    <div class="col-sm-10">
                        <input name="cost"
                               class="form-control"
                               v-model="form.cost"
                               id="item_cost"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('cost')">
                        @{{ form.errors.get('cost') }}
                    </span>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('sponsor')}">
                    <label class="col-sm-2 control-label" for="item_sponsor">
                        sponsor
                    </label>
                    <div class="col-sm-10">
                        <input name="sponsor"
                               class="form-control"
                               v-model="form.sponsor"
                               id="item_sponsor"
                               required
                        />
                    </div>
                    <span class="help-block filled" v-show="form.errors.has('sponsor')">
                        @{{ form.errors.get('sponsor') }}
                    </span>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit"
                                class="btn btn-primary"
                                @click="saveForm"
                        >
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </item-edit>

@endsection
