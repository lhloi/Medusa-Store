@extends('admin.layouts.layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'Color', 'key' => 'List'])
        <!-- /.content-header -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 ">
                        <div class="card-body">
                            <form method="POST" action="{{ Url('admin/product/save-product-color/') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên Màu</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                         name="name" id="name" placeholder="Nhập tiêu đề color" value="{{ old('name') }}"onkeyup="ChangeToSlug()">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="name">Chọn màu</label>
                                    <input type="hidden" class="form-control @error('code_color') is-invalid @enderror"
                                         name="code_color" id="code_color">
                                    <div class="color-picker"></div>
                                    @error('code_color')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô Tả</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        name="description" rows="4">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </form>


                        </div>
                    </div>
                    <div class="card col-8 ">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Tên Màu</th>
                                        <th scope="col">Mã màu</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Mô Tả</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($color as $key => $data)
                                        <tr>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                #{{ $data->code_color }}
                                                <div class="" style="background-color:  #{{ $data->code_color }}; width:55px ;height:18px"></div>
                                            </td>
                                            <td>{{ $data->slug }}</td>
                                            <td>{{ $data->description }}</td>

                                            <td>
                                                {{-- @can('edit-role')
                                                <a href="{{ Url('admin/product/edit-product-color/'.$data->id) }}" type="button"
                                                    class="btn btn-warning">
                                                        Edit
                                                    </a>
                                                @endcan --}}

                                                @can('delete-role')
                                                    <a href="" data-url="{{ Url('admin/product/delete-product-color/'.$data->id) }}"
                                                    class="btn btn-danger action_Delete">
                                                    Delete
                                                    </a>
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="col-sm-12"> --}}
                            {{ $color->links('pagination::bootstrap-4') }}
                        {{-- </div> --}}
                    </div>

                </div>
            </div>
        </div>

        {{-- /.table --}}

    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('AdminBE/product/list.js') }}"></script>


    {{-- ---------------------------Color Picker-------------------------------- --}}
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <script>
        let code_color = document.getElementById('code_color');
        let a = [];
        const pickr = Pickr.create({
            el: '.color-picker',
            theme: 'classic',

            // swatches: [
            //     'rgba(244, 67, 54, 1)',
            //     'rgba(233, 30, 99, 0.95)',
            //     'rgba(156, 39, 176, 0.9)',
            //     'rgba(103, 58, 183, 0.85)',
            //     'rgba(63, 81, 181, 0.8)',
            //     'rgba(33, 150, 243, 0.75)',
            //     'rgba(3, 169, 244, 0.7)',
            //     'rgba(0, 188, 212, 0.7)',
            //     'rgba(0, 150, 136, 0.75)',
            //     'rgba(76, 175, 80, 0.8)',
            //     'rgba(139, 195, 74, 0.85)',
            //     'rgba(205, 220, 57, 0.9)',
            //     'rgba(255, 235, 59, 0.95)',
            //     'rgba(255, 193, 7, 1)'
            // ],

            components: {

                // Main components
                preview: false,
                opacity: false,
                hue: true,

                // Input / output Options
                interaction: {
                    hex: false,
                    rgba: false,
                    hsla: false,
                    hsva: false,
                    cmyk: false,
                    input: true,
                    clear: true,
                    save: true
                }
            }
        });
        pickr.on('change', (color) => {
            this.code_color.value = color.toHEXA().join('');
        });
    </script>
@endsection
