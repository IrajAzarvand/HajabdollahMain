@extends('PageElements.Dashboard.Layout')
@section('PageTitle', 'تنظیمات اسلایدر')
@section('ContentHeader', 'تنظیمات اسلایدر')
@section('content')
<div class="col-md-12">
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                ویرایش تصویر و توضیحات
            </h3>
            <!-- tools box -->
            <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>

            </div>
            <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <form class="card-body" action="{{ route('Slider.update',$EditSlider->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- /image uploader -->
            <input type="hidden" name="SliderId" value="{{$EditSlider->id}}" readonly>
            <input type="hidden" name="OldSliderImage" value="{{$EditSlider->image}}" readonly>

            <div class="mb3">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                <div class="form-group">
                    <label for="sliderImage">تصویر</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="SliderImage" class="custom-file-input" id="fileUploader">
                            <label class="custom-file-label" for="sliderImage">{{$EditSlider->image}}</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.image uploader -->

            <div class="row">
                <div class="col-12">
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                @foreach (Locales() as $item)
                                <li class="nav-item"><a class="nav-link @if ($loop->first) active @endif" href="#{{$item['locale']}}" data-toggle="tab">{{$item['name']}}</a> </li>
                                @endforeach
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                @foreach (Locales() as $key=>$value)
                                <div class="tab-pane @if ($loop->first) active @endif" id="{{$value['locale']}}">
                                    <div class="mb-3">
                                        <textarea id="editor1" name="{{$value['locale']}}" style="width: 100%">{{$EditSlider->contents[$key]['element_content']}}</textarea>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- ./card -->
                </div>
                <!-- /.col -->
            </div>


            <button type="submit" class="btn btn-primary">ذخیره</button>
        </form>
    </div>
</div>
<!-- /.card -->

<!-- image preview -->

<div class="col-md-4">
    <!-- Box Comment -->
    <div class="card card-widget">
        <div class="card-header">
            <div class="user-block">
                <span class="username">تصویر قبلی</span>
            </div>
            <!-- /.user-block -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <img class="img-fluid pad" src="/storage/Main/Sliders/{{$EditSlider->image}}" alt="Photo">
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->

@endsection
