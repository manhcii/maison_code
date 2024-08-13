@extends('admin.layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/admin/plugins/nestable/jquery.nestable.min.css') }}">
    <style>
        .dd{
          max-width: 100%;
        }
        .mt-10{
          margin-top: 10px;
        }
        .dd-empty,
        .dd-item,
        .dd-placeholder {
            margin: 10px 0;
        }

        .dd-item>button {
            height: 30px;
        }

        .form-group .select2-container {
            width: 100% !important;
        }

        .form-control {
            height: auto;
        }

        .box-body {
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .box-body .form-horizontal .form-group {
            margin: 0px
        }

        .dd-item .item-details {
            position: relative;
            border-bottom: 1px solid #ccc;
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            margin-bottom: 5px;
            margin-top: 0px;
            padding: 10px 15px;
        }

        .dd3-content {
            background-color: #fff;
            border: 0;
            height: 40px;
            padding: 10px;
            width: 100%;
        }

        .dd3-handle {
            background: transparent;
            border: 1px solid #aaa;
            border-radius: 0;
            cursor: move;
            height: 40px;
            left: 0;
            margin: 0;
            overflow: hidden;
            position: absolute;
            text-indent: 100%;
            top: 0;
            white-space: nowrap;
            width: 100%;
        }

        .dd3-handle:hover {
            background-color: transparent;
        }

        .dd3-content>span.text.float-end,
        .dd3-content>span.text.float-start {
            display: inline-block;
            overflow: hidden;
            text-overflow: ellipsis;
            -ms-text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dd3-content>span.text.float-start {
            max-width: 200px;
        }

        .float-start {
            float: left !important;
        }

        .dd3-content .show-item-details {
            background-color: #ccc;
            border-left: 1px solid #aaa;
            color: #000;
            right: 0px;
            ;
            line-height: 38px;
            position: absolute;
            text-align: center;
            top: 1px;
            width: 43px;
        }

        .widget-menu .widget.meta-boxes>a {
            text-decoration: none !important;
        }

        .widget {
            background: #ffffff;
            clear: both;
            margin-bottom: 10px;
        }

        .meta-boxes {
            margin-top: 10px;
        }

        .widget.meta-boxes:first-child {
            margin-top: 0;
        }

        .widget-title {
            cursor: move;
            overflow: hidden;
            background: #ebeae8;
            height: 44px;
            line-height: 34px;
            border-bottom: 1px solid #ffffff;
            color: #1f64a0 !important;
        }

        .widget-menu .meta-boxes .narrow-icon {
            float: right;
            margin-right: 0;
            margin-top: 12px;
        }

        .widget-menu .widget.meta-boxes .collapsed h4.widget-title .narrow-icon:before {
            content: "\f107";
        }

        .meta-boxes .widget-title {
            cursor: pointer;
            overflow: hidden;
            height: 40px;
            border: 1px solid #aaa;
            padding: 0 10px;
            background: none;
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .widget-menu .widget.meta-boxes .widget-title {
            cursor: pointer;
            font-size: 14px;
            font-weight: 400;
            height: 40px;
            line-height: 40px;
            padding: 0 15px;
        }

        .widget-body {
            padding: 15px 15px;
            border-radius: 0 0 3px 3px;
            min-height: 200px;
        }

        .widget-menu .widget.meta-boxes .widget-body {
            min-height: 130px;
        }

        .box-links-for-menu .list-item {
            border: 1px solid #ddd;
            max-height: 200px;
            overflow: auto;
            padding: 15px;
        }

        .mCSB_container {
            padding: 10px;
        }

        .box-links-for-menu .list-item li {
            list-style: none;
            margin-bottom: 5px;
            position: relative;
        }

        .box-links-for-menu .list-item li label {
            max-width: 80%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        input[type=checkbox] {
            cursor: pointer;
            margin: 0 0.5rem 0 0;
            position: relative;
            top: 0;
        }

        .box-links-for-menu .list-item li label input {
            margin-left: 5px;
        }

        input[type=checkbox]:before {
            border-color: #58b3f0;
            border-style: none none solid solid;
            border-width: 2px;
            content: "";
            height: 5px;
            left: 2px;
            margin: auto;
            position: absolute;
            right: 0;
            top: 0.2em;
            transform: rotate(-45deg) scale(0);
            transition: transform .4s cubic-bezier(.45, 1.8, .5, .75);
            width: 10px;
            z-index: 1;
        }

        input[type=checkbox]:after {
            background: #fff;
            border: 1px solid #c4cdd5;
            border-radius: 3px;
            bottom: 0;
            content: "";
            cursor: pointer;
            height: 16px;
            left: -1px;
            margin: auto;
            position: absolute;
            right: 0;
            top: 0;
            width: 16px;
        }

        input[type=checkbox]:checked:before {
            transform: rotate(-45deg) scale(1);
        }

        input[type=checkbox]:checked:after {
            border-color: #58b3f0;
        }

        .float-end {
            float: right !important;
        }

        .dd3-content>span.text.float-end,
        .dd3-content>span.text.float-start {
            display: inline-block;
            overflow: hidden;
            text-overflow: ellipsis;
            -ms-text-overflow: ellipsis;
            white-space: nowrap;
        }

        .dd3-content>span.text.float-end {
            margin-right: 40px;
            max-width: 100px;
        }
    </style>
@endsection
@section('title')
  {{ $module_name }}
@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ $module_name }}
      <a class="btn btn-sm btn-warning pull-right" href="{{ route(Request::segment(2) . '.create') }}"><i
          class="fa fa-plus"></i> @lang('Add')</a>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    @if (session('errorMessage'))
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('errorMessage') }}
      </div>
    @endif
    @if (session('successMessage'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('successMessage') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach

      </div>
    @endif

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">@lang('Update form')</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-block" role="form" action="{{ route(Request::segment(2) . '.update', $detail->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="box-body">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#tab_1" data-toggle="tab">
                  <h5>
                    @lang('General information')
                    <span class="text-danger">*</span>
                  </h5>
                </a>
              </li>
              </li>

              <button type="submit" class="btn btn-primary btn-sm pull-right">
                <i class="fa fa-floppy-o"></i>
                @lang('Save')
              </button>
            </ul>

            <div class="tab-content">

              <div class="tab-pane active" id="tab_1">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Parent element')</label>
                      <select name="parent_id" id="parent_id" class="form-control select2" style="width: 100%">
                        <option value="">@lang('Please select')</option>
                        @foreach ($parents as $item)
                          @if ($item->parent_id == 0 || $item->parent_id == null)
                            <option value="{{ $item->id }}" {{ $detail->parent_id == $item->id ? 'selected' : '' }}>
                              {{ $item->title }}</option>

                            @foreach ($parents as $sub)
                              @if ($item->id == $sub->parent_id)
                                <option value="{{ $sub->id }}"
                                  {{ $detail->parent_id == $sub->id ? 'selected' : '' }}>- -
                                  {{ $sub->title }}</option>

                                @foreach ($parents as $sub_child)
                                  @if ($sub->id == $sub_child->parent_id)
                                    <option value="{{ $sub_child->id }}"
                                      {{ $detail->parent_id == $sub_child->id ? 'selected' : '' }}>
                                      - - - - {{ $sub_child->title }}</option>
                                  @endif
                                @endforeach
                              @endif
                            @endforeach
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Status')</label>
                      <div class="form-control">
                        @foreach (App\Consts::STATUS as $key => $value)
                          <label>
                            <input type="radio" name="status" value="{{ $value }}"
                              {{ $detail->status == $value ? 'checked' : '' }}>
                            <small class="mr-15">{{ __($value) }}</small>
                          </label>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>
                        @lang('Title')
                        <small class="text-red">*</small>
                      </label>
                      <input type="text" class="form-control" name="title" placeholder="@lang('Title')"
                        value="{{ old('title') ?? $detail->title }}" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>
                        @lang('Block type')
                        <small class="text-red">*</small>
                      </label>
                      <select name="block_code" id="block_code" class="form-control select2" style="width: 100%" required>
                        <option value="">@lang('Please select')</option>
                        @foreach ($blocks as $item)
                          <option value="{{ $item->block_code }}"
                            {{ $item->block_code == $detail->block_code ? 'selected' : '' }}>{{ $item->name }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Layout')</label>
                      <select name="json_params[layout]" id="block_layout" class="form-control select2"
                        style="width: 100%">
                        <option value="">@lang('Please select')</option>
                        @foreach ($blocks as $item)
                          @if ($item->block_code == $detail->block_code)
                            @php
                              $json_params = json_decode($item->json_params);
                            @endphp
                            @isset($json_params->layout)
                              @foreach ($json_params->layout as $name => $value)
                                <option value="{{ $value }}"
                                  {{ isset($detail->json_params->layout) && $value == $detail->json_params->layout ? 'selected' : '' }}>
                                  {{ __($value) }}
                                </option>
                              @endforeach
                            @endisset
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Style')</label>
                      <select name="json_params[style]" id="block_style" class="form-control select2" style="width: 100%">
                        <option value="">@lang('Please select')</option>
                        @foreach ($blocks as $item)
                          @if ($item->block_code == $detail->block_code)
                            @php
                              $json_params = json_decode($item->json_params);
                            @endphp
                            @isset($json_params->style)
                              @foreach ($json_params->style as $name => $value)
                                <option value="{{ $value }}"
                                  {{ isset($detail->json_params->style) && $value == $detail->json_params->style ? 'selected' : '' }}>
                                  {{ __($value) }}
                                </option>
                              @endforeach
                            @endisset
                          @endif
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('Brief')</label>
                      <textarea name="brief" id="brief" class="form-control" rows="5">{{ old('brief') ?? $detail->brief }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('Content')</label>
                      <textarea name="content" id="content" class="form-control" rows="5">{{ old('content') ?? $detail->content }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Url redirect')</label>
                      <input type="text" class="form-control" name="url_link" placeholder="@lang('Url redirect')"
                        value="{{ old('url_link') ?? $detail->url_link }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Url redirect title')</label>
                      <input type="text" class="form-control" name="url_link_title"
                        placeholder="@lang('Url redirect title')"
                        value="{{ old('url_link_title') ?? $detail->url_link_title }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Order')</label>
                      <input type="number" class="form-control" name="iorder" placeholder="@lang('Order')"
                        value="{{ old('iorder') ?? $detail->iorder }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Icon')</label>
                      <input type="text" class="form-control" name="icon" placeholder="Ex: fa fa-folder"
                        value="{{ old('icon') ?? $detail->icon }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Image')</label>
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a data-input="image" data-preview="image-holder" class="btn btn-primary lfm"
                            data-type="cms-image">
                            <i class="fa fa-picture-o"></i> @lang('Select')
                          </a>
                        </span>
                        <input id="image" class="form-control" type="text" name="image"
                          placeholder="@lang('Image source')" value="{{ $detail->image }}">
                      </div>
                      <div id="image-holder" style="margin-top:15px;max-height:100px;">
                        @if ($detail->image != '')
                          <img style="height: 5rem;" src="{{ $detail->image }}">
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Background image')</label>
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a data-input="image_background" data-preview="image_background-holder" data-type="cms-image"
                            class="btn btn-primary lfm">
                            <i class="fa fa-picture-o"></i> @lang('Select')
                          </a>
                        </span>
                        <input id="image_background" class="form-control" type="text" name="image_background"
                          placeholder="@lang('Image source')" value="{{ $detail->image_background }}">
                      </div>
                      <div id="image_background-holder" style="margin-top:15px;max-height:100px;">
                        @if ($detail->image_background != '')
                          <img style="height: 5rem;" src="{{ $detail->image_background }}">
                        @endif
                      </div>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="box-footer">
          <a class="btn btn-success btn-sm" href="{{ route(Request::segment(2) . '.index') }}">
            <i class="fa fa-bars"></i> @lang('List')
          </a>
          <button type="submit" class="btn btn-primary pull-right btn-sm"><i class="fa fa-floppy-o"></i>
            @lang('Save')</button>
        </div>
      </form>
    </div>
    @if(isset($child) && count($child)>0)
    <div class="row">
      <div class="col-md-12">
          <hr style="border-top: dashed 2px #a94442; margin: 10px 0px;">
      </div>
      <div class="col-md-12 mt-10">
        <div class="box box-primary">
          <div class="box-header with-border">
              <h3 class="box-title">
                  @lang('Block structure')
              </h3>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <div class="dd" id="menu-sort">
                <ol class="dd-list">
                  @foreach ($child as $item)
                    <li class="dd-item dd3-item "
                        data-id="{{ $item->id }}">
                        <div class="dd-handle dd3-handle"></div>
                        <div class="dd3-content">
                            <span class="text float-start"
                                data-update="title">{{ $item->title }}</span>
                            <span
                                class="text float-end">@lang($status[$item->status])</span>
                            <a data-toggle="collapse"
                                href="#item-details-{{ $item->id }}"
                                role="button" aria-expanded="false"
                                aria-controls="item-details-{{ $item->id }}"
                                class="show-item-details">
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                         
                        <div class="item-details collapse multi-collapse form-block"
                            id="item-details-{{ $item->id }}">
                            <form role="form"
                                action="{{ route(Request::segment(2) . '.update', $item->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="box-body">
                                  <div class="nav-tabs-custom">
                                    <div class="tab-content">
                                      <div class="tab-pane active" id="tab_1">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Parent element')</label>
                                              <select name="parent_id" id="parent_id" class="form-control select2" style="width: 100%">
                                                <option value="">@lang('Please select')</option>

                                                @foreach ($parents_child as $item_child)
                                                  @if ($item_child->parent_id == 0 || $item_child->parent_id == null)
                                                  @php
                                                  if($item_child->id==$item->id) continue;
                                                  @endphp
                                                    <option value="{{ $item_child->id }}" {{ $item->parent_id == $item_child->id ? 'selected' : '' }}>
                                                      {{ $item_child->title }}</option>

                                                    @foreach ($parents as $sub)
                                                      @if ($item_child->id == $sub->parent_id)
                                                      @php
                                                      if($sub->id==$item->id) continue;
                                                      @endphp
                                                        <option value="{{ $sub->id }}"
                                                          {{ $item->parent_id == $sub->id ? 'selected' : '' }}>- -
                                                          {{ $sub->title }}</option>

                                                        @foreach ($parents as $sub_child)
                                                          @if ($sub->id == $sub_child->parent_id)
                                                           @php
                                                          if($sub_child->id==$item->id) continue;
                                                          @endphp
                                                            <option value="{{ $sub_child->id }}"
                                                              {{ $item->parent_id == $sub_child->id ? 'selected' : '' }}>
                                                              - - - - {{ $sub_child->title }}</option>
                                                          @endif
                                                        @endforeach
                                                      @endif
                                                    @endforeach
                                                  @endif
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Status')</label>
                                              <div class="form-control">
                                                @foreach (App\Consts::STATUS as $key => $value)
                                                  <label>
                                                    <input type="radio" name="status" value="{{ $value }}"
                                                      {{ $item->status == $value ? 'checked' : '' }}>
                                                    <small class="mr-15">{{ __($value) }}</small>
                                                  </label>
                                                @endforeach
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>
                                                @lang('Title')
                                                <small class="text-red">*</small>
                                              </label>
                                              <input type="text" class="form-control" name="title" placeholder="@lang('Title')"
                                                value="{{ old('title') ?? $item->title }}" required>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>
                                                @lang('Block type')
                                                <small class="text-red">*</small>
                                              </label>
                                              <select name="block_code" id="block_code" class="form-control select2" style="width: 100%" required>
                                                <option value="">@lang('Please select')</option>
                                                @foreach ($blocks as $block)
                                                  <option value="{{ $block->block_code }}"
                                                    {{ $block->block_code == $item->block_code ? 'selected' : '' }}>{{ $block->name }}
                                                  </option>
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Layout')</label>
                                              <select name="json_params[layout]" id="block_layout" class="form-control select2"
                                                style="width: 100%">
                                                <option value="">@lang('Please select')</option>
                                                @foreach ($blocks as $block)
                                                  @if ($block->block_code == $item->block_code)
                                                    @php
                                                      $json_params = json_decode($block->json_params);
                                                    @endphp
                                                    @isset($json_params->layout)
                                                      @foreach ($json_params->layout as $name => $value)
                                                        <option value="{{ $value }}"
                                                          {{ isset($item->json_params->layout) && $value == $item->json_params->layout ? 'selected' : '' }}>
                                                          {{ __($value) }}
                                                        </option>
                                                      @endforeach
                                                    @endisset
                                                  @endif
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Style')</label>
                                              <select name="json_params[style]" id="block_style" class="form-control select2" style="width: 100%">
                                                <option value="">@lang('Please select')</option>
                                                @foreach ($blocks as $block)
                                                  @if ($block->block_code == $detail->block_code)
                                                    @php
                                                      $json_params = json_decode($block->json_params);
                                                    @endphp
                                                    @isset($json_params->style)
                                                      @foreach ($json_params->style as $name => $value)
                                                        <option value="{{ $value }}"
                                                          {{ isset($item->json_params->style) && $value == $item->json_params->style ? 'selected' : '' }}>
                                                          {{ __($value) }}
                                                        </option>
                                                      @endforeach
                                                    @endisset
                                                  @endif
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>

                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Brief')</label>
                                              <textarea name="brief" id="brief" class="form-control" rows="5">{{ old('brief') ?? $item->brief }}</textarea>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Content')</label>
                                              <textarea name="content" id="content" class="form-control" rows="5">{{ old('content') ?? $item->content }}</textarea>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Url redirect')</label>
                                              <input type="text" class="form-control" name="url_link" placeholder="@lang('Url redirect')"
                                                value="{{ old('url_link') ?? $item->url_link }}">
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Url redirect title')</label>
                                              <input type="text" class="form-control" name="url_link_title"
                                                placeholder="@lang('Url redirect title')"
                                                value="{{ old('url_link_title') ?? $item->url_link_title }}">
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Order')</label>
                                              <input type="number" class="form-control" name="iorder" placeholder="@lang('Order')"
                                                value="{{ old('iorder') ?? $item->iorder }}">
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Icon')</label>
                                              <input type="text" class="form-control" name="icon" placeholder="Ex: fa fa-folder"
                                                value="{{ old('icon') ?? $item->icon }}">
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Image')</label>
                                              <div class="input-group">
                                                <span class="input-group-btn">
                                                  <a data-input="image-{{$item->id}}" data-preview="image-holder-{{$item->id}}" class="btn btn-primary lfm"
                                                    data-type="cms-image">
                                                    <i class="fa fa-picture-o"></i> @lang('Select')
                                                  </a>
                                                </span>
                                                <input id="image-{{$item->id}}" class="form-control" type="text" name="image"
                                                  placeholder="@lang('Image source')" value="{{ $item->image }}">
                                              </div>
                                              <div id="image-holder-{{$item->id}}" style="margin-top:15px;max-height:100px;">
                                                @if ($item->image != '')
                                                  <img style="height: 5rem;" src="{{ $item->image }}">
                                                @endif
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                              <label>@lang('Background image')</label>
                                              <div class="input-group">
                                                <span class="input-group-btn">
                                                  <a data-input="image_background-{{$item->id}}" data-preview="image_background-holder-{{$item->id}}" data-type="cms-image"
                                                    class="btn btn-primary lfm">
                                                    <i class="fa fa-picture-o"></i> @lang('Select')
                                                  </a>
                                                </span>
                                                <input id="image_background-{{$item->id}}" class="form-control" type="text" name="image_background"
                                                  placeholder="@lang('Image source')" value="{{ $item->image_background }}">
                                              </div>
                                              <div id="image_background-holder-{{$item->id}}" style="margin-top:15px;max-height:100px;">
                                                @if ($item->image_background != '')
                                                  <img style="height: 5rem;" src="{{ $item->image_background }}">
                                                @endif
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="text-end mt-2">
                                   
                                  <button
                                      class="btn btn-primary btn-sm">@lang('Save')</button>
                                      <a class="btn btn-danger  btn-sm" onclick="return confirm('@lang('confirm_action')')" href="{{ route(Request::segment(2) . '.destroy', $item->id) }}">
                                      @lang('Delete')</a>
                                </div>
                            </form>
                             <form action="{{ route(Request::segment(2) . '.destroy', $item->id) }}" method="POST" onsubmit="return confirm('@lang('confirm_action')')">
                              @csrf
                              @method('DELETE')
                              <button style="position: absolute;bottom: 10px;left: 80px;" class="btn btn-danger  btn-sm">@lang('Delete')</button>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                        @php $count_sub=0; @endphp

                        @foreach ($parents_child as $item_sub_1)
                          @if ($item_sub_1->parent_id == $item->id)
                            @php $count_sub++; @endphp
                          @endif
                        @endforeach    
                        @if ($count_sub>0)
                        
                        <ol class="dd-list">
                          @foreach ($parents_child as $item_sub_1)
                              @if ($item_sub_1->parent_id == $item->id)
                                  <li class="dd-item dd3-item"
                                      data-id="{{ $item_sub_1->id }}">
                                      <div class="dd-handle dd3-handle">
                                      </div>
                                      <div class="dd3-content">
                                          <span class="text float-start"
                                              data-update="title">{{ $item_sub_1->title }}</span>
                                          <span
                                              class="text float-end">@lang($status[$item_sub_1->status])</span>
                                          <a data-toggle="collapse"
                                              href="#item-details-{{ $item_sub_1->id }}"
                                              role="button"
                                              aria-expanded="false"
                                              aria-controls="item-details-{{ $item_sub_1->id }}"
                                              class="show-item-details">
                                              <i
                                                  class="fa fa-angle-down"></i>
                                          </a>
                                          <div class="clearfix">
                                          </div>
                                      </div>
                                      <div class="item-details collapse multi-collapse"
                                          id="item-details-{{ $item_sub_1->id }}">
                                        <form role="form"
                                            action="{{ route(Request::segment(2) . '.update', $item_sub_1->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="box-body">
                                              <div class="nav-tabs-custom">
                                                <div class="tab-content">
                                                  <div class="tab-pane active" id="tab_1">
                                                    <div class="row">
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Parent element')</label>
                                                          <select name="parent_id" id="parent_id" class="form-control select2" style="width: 100%">
                                                            <option value="">@lang('Please select')</option>

                                                            @foreach ($parents_child as $item_child)
                                                              @if ($item_child->parent_id == 0 || $item_child->parent_id == null)
                                                              @php
                                                              if($item_child->id==$item->id) continue;
                                                              @endphp
                                                                <option value="{{ $item_child->id }}" {{ $item_sub_1->parent_id == $item_child->id ? 'selected' : '' }}>
                                                                  {{ $item_child->title }}</option>

                                                                @foreach ($parents as $sub)
                                                                  @if ($item_child->id == $sub->parent_id)
                                                                  @php
                                                                  if($sub->id==$item_sub_1->id) continue;
                                                                  @endphp
                                                                    <option value="{{ $sub->id }}"
                                                                      {{ $item_sub_1->parent_id == $sub->id ? 'selected' : '' }}>- -
                                                                      {{ $sub->title }}</option>

                                                                    @foreach ($parents as $sub_child)
                                                                      @if ($sub->id == $sub_child->parent_id)
                                                                       @php
                                                                      if($sub_child->id==$item_sub_1->id) continue;
                                                                      @endphp
                                                                        <option value="{{ $sub_child->id }}"
                                                                          {{ $item_sub_1->parent_id == $sub_child->id ? 'selected' : '' }}>
                                                                          - - - - {{ $sub_child->title }}</option>
                                                                      @endif
                                                                    @endforeach
                                                                  @endif
                                                                @endforeach
                                                              @endif
                                                            @endforeach
                                                          </select>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Status')</label>
                                                          <div class="form-control">
                                                            @foreach (App\Consts::STATUS as $key => $value)
                                                              <label>
                                                                <input type="radio" name="status" value="{{ $value }}"
                                                                  {{ $item_sub_1->status == $value ? 'checked' : '' }}>
                                                                <small class="mr-15">{{ __($value) }}</small>
                                                              </label>
                                                            @endforeach
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>
                                                            @lang('Title')
                                                            <small class="text-red">*</small>
                                                          </label>
                                                          <input type="text" class="form-control" name="title" placeholder="@lang('Title')"
                                                            value="{{ old('title') ?? $item_sub_1->title }}" required>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>
                                                            @lang('Block type')
                                                            <small class="text-red">*</small>
                                                          </label>
                                                          <select name="block_code" id="block_code" class="form-control select2" style="width: 100%" required>
                                                            <option value="">@lang('Please select')</option>
                                                            @foreach ($blocks as $block)
                                                              <option value="{{ $block->block_code }}"
                                                                {{ $block->block_code == $item_sub_1->block_code ? 'selected' : '' }}>{{ $block->name }}
                                                              </option>
                                                            @endforeach
                                                          </select>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Layout')</label>
                                                          <select name="json_params[layout]" id="block_layout" class="form-control select2"
                                                            style="width: 100%">
                                                            <option value="">@lang('Please select')</option>
                                                            @foreach ($blocks as $block)
                                                              @if ($block->block_code == $item_sub_1->block_code)
                                                                @php
                                                                  $json_params = json_decode($block->json_params);
                                                                @endphp
                                                                @isset($json_params->layout)
                                                                  @foreach ($json_params->layout as $name => $value)
                                                                    <option value="{{ $value }}"
                                                                      {{ isset($item_sub_1->json_params->layout) && $value == $item_sub_1->json_params->layout ? 'selected' : '' }}>
                                                                      {{ __($value) }}
                                                                    </option>
                                                                  @endforeach
                                                                @endisset
                                                              @endif
                                                            @endforeach
                                                          </select>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Style')</label>
                                                          <select name="json_params[style]" id="block_style" class="form-control select2" style="width: 100%">
                                                            <option value="">@lang('Please select')</option>
                                                            @foreach ($blocks as $block)
                                                              @if ($block->block_code == $detail->block_code)
                                                                @php
                                                                  $json_params = json_decode($block->json_params);
                                                                @endphp
                                                                @isset($json_params->style)
                                                                  @foreach ($json_params->style as $name => $value)
                                                                    <option value="{{ $value }}"
                                                                      {{ isset($item_sub_1->json_params->style) && $value == $item_sub_1->json_params->style ? 'selected' : '' }}>
                                                                      {{ __($value) }}
                                                                    </option>
                                                                  @endforeach
                                                                @endisset
                                                              @endif
                                                            @endforeach
                                                          </select>
                                                        </div>
                                                      </div>

                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Brief')</label>
                                                          <textarea name="brief" id="brief" class="form-control" rows="5">{{ old('brief') ?? $item_sub_1->brief }}</textarea>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Content')</label>
                                                          <textarea name="content" id="content" class="form-control" rows="5">{{ old('content') ?? $item_sub_1->content }}</textarea>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Url redirect')</label>
                                                          <input type="text" class="form-control" name="url_link" placeholder="@lang('Url redirect')"
                                                            value="{{ old('url_link') ?? $item_sub_1->url_link }}">
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Url redirect title')</label>
                                                          <input type="text" class="form-control" name="url_link_title"
                                                            placeholder="@lang('Url redirect title')"
                                                            value="{{ old('url_link_title') ?? $item_sub_1->url_link_title }}">
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Order')</label>
                                                          <input type="number" class="form-control" name="iorder" placeholder="@lang('Order')"
                                                            value="{{ old('iorder') ?? $item_sub_1->iorder }}">
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Icon')</label>
                                                          <input type="text" class="form-control" name="icon" placeholder="Ex: fa fa-folder"
                                                            value="{{ old('icon') ?? $item_sub_1->icon }}">
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Image')</label>
                                                          <div class="input-group">
                                                            <span class="input-group-btn">
                                                              <a data-input="image-{{$item_sub_1->id}}" data-preview="image-holder-{{$item_sub_1->id}}" class="btn btn-primary lfm"
                                                                data-type="cms-image">
                                                                <i class="fa fa-picture-o"></i> @lang('Select')
                                                              </a>
                                                            </span>
                                                            <input id="image-{{$item_sub_1->id}}" class="form-control" type="text" name="image"
                                                              placeholder="@lang('Image source')" value="{{ $item_sub_1->image }}">
                                                          </div>
                                                          <div id="image-holder-{{$item_sub_1->id}}" style="margin-top:15px;max-height:100px;">
                                                            @if ($item_sub_1->image != '')
                                                              <img style="height: 5rem;" src="{{ $item_sub_1->image }}">
                                                            @endif
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>@lang('Background image')</label>
                                                          <div class="input-group">
                                                            <span class="input-group-btn">
                                                              <a data-input="image_background-{{$item_sub_1->id}}" data-preview="image_background-holder-{{$item_sub_1->id}}" data-type="cms-image"
                                                                class="btn btn-primary lfm">
                                                                <i class="fa fa-picture-o"></i> @lang('Select')
                                                              </a>
                                                            </span>
                                                            <input id="image_background-{{$item_sub_1->id}}" class="form-control" type="text" name="image_background"
                                                              placeholder="@lang('Image source')" value="{{ $item_sub_1->image_background }}">
                                                          </div>
                                                          <div id="image_background-holder-{{$item_sub_1->id}}" style="margin-top:15px;max-height:100px;">
                                                            @if ($item_sub_1->image_background != '')
                                                              <img style="height: 5rem;" src="{{ $item_sub_1->image_background }}">
                                                            @endif
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="text-end mt-2">
                                              <button
                                                  class="btn btn-primary btn-sm">@lang('Save')</button>
                                            </div>
                                        </form>
                                        <form action="{{ route(Request::segment(2) . '.destroy', $item_sub_1->id) }}" method="POST" onsubmit="return confirm('@lang('confirm_action')')">
                                          @csrf
                                          @method('DELETE')
                                          <button style="position: absolute;bottom: 10px;left: 80px;" class="btn btn-danger  btn-sm">@lang('Delete')</button>
                                        </form> 
                                      </div>
                                      <div class="clearfix"></div>
                                  </li>
                              @endif
                          @endforeach
                        </ol>
                        @endif
                    </li>
                  @endforeach    
                </ol>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <a class="btn btn-warning btn-flat menu-sort-save btn-sm"
                title="@lang('Save')">
                <i class="fa fa-floppy-o"></i>
                @lang('Save sort')
            </a>
          </div>
        </div>
      </div> 
    </div>
    @endif
  </section>
@endsection

@section('script')
  <script>
        CKEDITOR.replace('content', ck_options);

    $(document).ready(function() {
      $(document).on('change', '#block_code', function() {
        let block_code = $(this).val();
        var _targetLayout = $(this).parents('.form-block').find('#block_layout');
        var _targetStyle = $(this).parents('.form-block').find('#block_style');
        _targetLayout.html('');
        _targetStyle.html('');
        var url = "{{ route('blocks.params') }}/";
        $.ajax({
          type: "GET",
          url: url,
          data: {
            "block_code": block_code,
          },
          success: function(response) {
            var _optionListLayout = '<option value="">@lang('Please select')</option>';
            var _optionListStyle = '<option value="">@lang('Please select')</option>';
            if (response.data != null) {
              let json_params = JSON.parse(response.data);
              if (json_params.hasOwnProperty('layout')) {
                Object.entries(json_params.layout).forEach(([key, value]) => {
                  _optionListLayout += '<option value="' + value + '"> ' + value + ' </option>';
                });
              }
              _targetLayout.html(_optionListLayout);
              if (json_params.hasOwnProperty('style')) {
                Object.entries(json_params.style).forEach(([key, value]) => {
                  _optionListStyle += '<option value="' + value + '"> ' + value + ' </option>';
                });
              }
              _targetStyle.html(_optionListStyle);
            }
            $(".select2").select2();
          },
          error: function(response) {
            // Get errors
            var errors = response.responseJSON.message;
            console.log(errors);
          }
        });
      });
    });
    $('#menu-sort').nestable({
        group: 0,
        maxDepth: 2,
    });
    $('.menu-sort-save').click(function() {
      $('#loading').show();
      let serialize = $('#menu-sort').nestable('serialize');
      let menu = JSON.stringify(serialize);
      $.ajax({
          url: '{{ route('blocks.update_sort') }}',
          type: 'POST',
          dataType: 'json',
          data: {
              _token: '{{ csrf_token() }}',
              menu: menu,
              root_id: {{ $detail->id }}
          },
      })
      .done(function(data) {
          $('#loading').hide();
          if (data.error == 0) {
            alert('Cập nhật thành công');
              location.reload();
          } else {
              alert("Cập nhật thất bại");
              location.reload();
          }
      });
  });
  </script>
@endsection
