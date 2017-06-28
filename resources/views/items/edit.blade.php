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
                        <span class="help-block filled" v-show="form.errors.has('type')">
                            @{{ form.errors.get('type') }}
                        </span>
                    </div>
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
                        <span class="help-block filled" v-show="form.errors.has('name')">
                            @{{ form.errors.get('name') }}
                        </span>
                    </div>
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
                        <span class="help-block filled" v-show="form.errors.has('description')">
                            @{{ form.errors.get('description') }}
                        </span>
                    </div>
                </div>

                <div class="form-group required" :class="{'has-error': form.errors.has('image')}">
                    <label class="col-sm-2 control-label" for="item_image">
                        Image
                    </label>
                    <div class="col-sm-10">
                        <div class="thumbnail" v-show="form.image_src">
                            <img v-bind:src="form.image_src" alt="">
                            <div class="caption">
                                <p class="text-center">
                                    <a class="btn btn-default" role="button" @click="removeImage">Remove Image</a>
                                </p>
                            </div>
                        </div>
                        <div v-show="form.image_src == ''">
                            <div class="file-attachment-target text-center" id="dmedropzone">
                                <div class="dz-default dz-message">
                                    DRAG &amp; DROP
                                    <div>or CLICK to select files</div>
                                </div>
                            </div>
                            <div class="file-attachment-helper text-center">
                                <div>Supported Formats: JPG, PNG, GIF</div>
                                <div>Max File Size Allowed: 10 MB</div>
                            </div>
                            <div id="actions" class="row">
                                <div class="col-xs-12">
                                    <!-- The global file processing state -->
                                    <span class="fileupload-process">
                                        <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar" style="width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div id="previews"></div>
                        </div>
                        <span class="help-block filled" v-show="form.errors.has('image')">
                            @{{ form.errors.get('image') }}
                        </span>
                    </div>
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
                        <span class="help-block filled" v-show="form.errors.has('value')">
                            @{{ form.errors.get('value') }}
                        </span>
                    </div>
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
                        <span class="help-block filled" v-show="form.errors.has('cost')">
                            @{{ form.errors.get('cost') }}
                        </span>
                    </div>
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
                        <span class="help-block filled" v-show="form.errors.has('sponsor')">
                            @{{ form.errors.get('sponsor') }}
                        </span>
                    </div>
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
