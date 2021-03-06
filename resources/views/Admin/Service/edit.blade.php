@extends('tpl.main')

@section('body')
<div class="site-section">
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="heading-39291 col-12 text-center">{{ $service->title }}</h2>

            <form class="login-form col-12" action="{{ route('admin.services.update', $service) }}" method="post">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Название" value="{{ old('title') ?? $service->title }}">
                        <div class="invalid-feedback text-bold">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <input type="text" name="price_per_hour" class="form-control @error('price_per_hour') is-invalid @enderror"
                            placeholder="Цена за час" value="{{ old('price_per_hour') ?? $service->price_per_hour }}">
                        <div class="invalid-feedback text-bold">
                            @error('price_per_hour')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Описание"
                            cols="30" rows="3">{{ old('description') ?? $service->description }}</textarea>
                        <div class="invalid-feedback text-bold">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="type_id">Вид съемки</label>
                        <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror" >
                            @foreach ($types as $t)
                                <option value="{{ $t->id }}" {{ (old('type_id') ?? $service->type_id) == $t->id ? 'selected' : '' }}>{{ $t->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 mr-auto">
                        <input type="submit" class="btn btn-block btn-primary text-white py-3 px-5 rounded-0"
                            value="Сохранить">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
