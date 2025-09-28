@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-9">

            <h3> :: form Add Car :: </h3>

            <form action="/test" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> ชื่อรถ </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="product_name" required placeholder="Car Name" minlength="3" value="{{ old('product_name') }}">
                        @if(isset($errors) && $errors->has('product_name'))
                            <div class="text-danger"> {{ $errors->first('product_name') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> รายละเอียด </label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="product_detail" required placeholder="Car Detail">{{ old('product_detail') }}</textarea>
                        @if(isset($errors) && $errors->has('product_detail'))
                            <div class="text-danger"> {{ $errors->first('product_detail') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> ราคา </label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="price" required placeholder="Price" value="{{ old('price') }}">
                        @if(isset($errors) && $errors->has('price'))
                            <div class="text-danger"> {{ $errors->first('price') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> รูปภาพ </label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control" name="picture" placeholder="Picture URL" value="{{ old('picture') }}">
                        @if(isset($errors) && $errors->has('picture'))
                            <div class="text-danger"> {{ $errors->first('picture') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> </label>
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary"> Insert </button> 
                        <a href="/test" class="btn btn-danger">Cancel</a>
                    </div>
                </div>

            </form>

        </div> <!--  /col-sm-9 -->
    </div>
</div>

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
