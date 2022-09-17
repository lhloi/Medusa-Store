@extends('Client.Pages.User.layout')

@section('js')
@endsection

@section('profile_card')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Địa chỉ của tôi
            </h3>
            <div class="float-right">
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-primary btn-sm">+
                    Thêm địa chỉ</button>
            </div>
        </div>
        <div iv class="card-body">
            <div class="col-12 ">
                @if (isset($address))
                @foreach ($address as $item)
                    <div class="post row">
                        <div class="col-md-9 mb-3">
                            <div class="title_address">
                                <p class="name">{{ $item->name }}</p>
                                <span class="ml-1 mr-1">|</span>
                                <p>{{ $item->phone }}</p>
                            </div>

                            <p>
                                {{ $item->address}}
                            </p>
                            <p>{{  $item->district.', '. $item->conscious.', '. $item->city }}</p>
                            @if ($item->status == 1)
                                <button type="button" class="btn btn-outline-danger btn-sm" disabled>Mặc định</button>
                            @endif

                        </div>

                        <div class="col-md-3">
                            <div class="float-right">
                                <a href="" class="disabled mr-3" >Cập nhập</a>
                                @if ($item->status != 1)
                                    <a class="ml-2" href="{{ Url('user/delete-address/'.$item->id) }}">Xóa</a>
                                @endif
                                <a href="{{ Url('user/default-address/'.$item->id) }}" class="btn btn-block btn-outline-dark btn-sm {{ $item->status == 1 ? 'disabled':''}}" >Thiết lập mặc định</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else

                @endif

            </div>
            <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Địa Chỉ Mới</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ Url('user/save-address') }}" method="POST" class="form-horizontal row">
                                @csrf
                                <div class="form-group col-sm-6">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Tên Người Dùng">

                                </div>
                                <div class="form-group col-sm-6">
                                        <input type="text" class="form-control" name="phone"
                                            placeholder="Số Điện Thoại">
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="text" class="form-control" name="city"
                                        placeholder="Tỉnh/ Thành phố">
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="text" class="form-control" name="conscious"
                                        placeholder="Quận/ Huyện">
                                </div>
                                <div class="form-group col-sm-4">
                                    <input type="text" class="form-control" name="district"
                                        placeholder="Phường xã">
                                </div>
                                <div class="form-group col-sm-12">
                                    <input type="text" class="form-control" name="address"
                                        placeholder="Địa chỉ cụ thể">
                                </div>
                                <div class="form-group  col-sm-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="address_type" id="home"
                                                value="1">
                                            <label class="form-check-label" for="home">Nhà</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="address_type" id="company"
                                                value="0">
                                            <label class="form-check-label" for="company">Văn Phòng  </label>
                                        </div>
                                </div>


                                <div class="form-group ">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="modal-footer">

                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
