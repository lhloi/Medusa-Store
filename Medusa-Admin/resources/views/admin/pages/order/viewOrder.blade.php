@extends('admin.layouts.layout')
@section('css')
    {{-- <link rel="stylesheet" href="{{ 'http://127.0.0.1:8000/client/home/home.css' }}" type="text/css"> --}}
@endsection

@section('js')
    <script type="text/javascript">
        $('.order_status').change(function(){
            var value = $('.order_status').val();
            var id = {{ $order->id }};
            // alert(id);
            $.ajax({
                url: '/admin/order/update-status/'+id,
                method : 'POST',
                data:{status:value,"_token":"{{csrf_token()}}"},
                success:function(data){
                    alert(data);
                }
            })
        })
    </script>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('admin.layouts.content-header', ['name' => 'Order', 'key' => 'Invoice'])

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        {{-- <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                  </div> --}}


                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> AdminLTE, Inc.
                                        <small class="float-right">Date: {{ date_format($order->created_at,"d/m/Y") }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>Admin, Inc.</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        Phone: (804) 123-5432<br>
                                        Email: info@almasaeedstudio.com
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{ $order->name }}</strong><br>
                                       {{$order->address}}<br>
                                        {{ $order->district }}, {{ $order->conscious }}, {{ $order->city }}<br>
                                        Phone: {{ $order->phone }}<br>
                                        Email: {{ $order->email }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #007612</b><br>
                                    <br>
                                    <b>Order ID:</b> {{ $order->id }}<br>
                                    <b>Payment Due:</b> {{date_format($transaction->created_at,"d/m/Y")  }}<br>
                                    <b>Account:</b> default
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th class="col-5">Product</th>
                                                <th>size</th>
                                                <th>color</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order_item as $item)
                                                <tr>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->size }}</td>
                                                    <td>{{ $item->color }}</td>
                                                    <td>{{ number_format($item->total ) }} vnd</td>

                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">
                                    <p class="lead">THANH TOÁN:</p>
                                    <p class="ml-3">Phương thức thanh toán :
                                        @switch($transaction->type)
                                            @case(1)
                                                Thanh toán khi nhận hàng
                                                @break
                                            @case(2)
                                                Thẻ tín dụng/ Ghi nợ
                                                @break
                                            @case(3)
                                                Ví Zalo Pay
                                                @break
                                            @case(4)
                                                Ví Momo
                                                @break
                                            @default
                                        @endswitch
                                    </p>
                                    <p class="ml-3">Trạng thái:
                                        @switch($transaction->status)
                                            @case(1)
                                                Chưa thanh toán
                                                @break
                                            @case(2)
                                                Đã thanh toán
                                                @break
                                            @default

                                        @endswitch
                                    </p>
                                    <p class="lead">ĐƠN HÀNG:</p>
                                    <P class="ml-3 mt-1 mr-1 float-left">tình trạng đơn hàng: </P>
                                    <select class="form-control col-3 float-left order_status">
                                        <option value="1" {{ ($order->status == 1)? 'selected' : '' }}>Chờ xác nhận</option>
                                        <option value="2" {{ ($order->status == 2)? 'selected' : '' }}>Chờ lấy hàng</option>
                                        <option value="3" {{ ($order->status == 3)? 'selected' : '' }}>Đang giao</option>
                                        <option value="4" {{ ($order->status == 4)? 'selected' : '' }}>Đã giao</option>
                                        <option value="5" {{ ($order->status == 5)? 'selected' : '' }}>Đã hủy</option>
                                    </select>

                                    {{-- <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya
                                        handango imeem
                                        plugg
                                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                    </p> --}}
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <p class="lead">Amount Due {{date_format($order->updated_at,"d/m/Y")  }}</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">tổng:</th>
                                                <td>{{ number_format($order->subTotal) }}vnd</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td>{{ number_format($order->shipping) }}vnd</td>
                                            </tr>
                                            <tr>
                                                <th>Mã giảm giá:</th>
                                                @if ($order->coupon_id)
                                                    @foreach ($order->coupon as $cou)
                                                        @if ($cou->condition ==1)
                                                            <td>{{ $cou->number }}%</td>
                                                        @elseif($cou->condition ==2)
                                                            <td>-{{number_format($cou['number'],0,",",".")}}vnd</td>
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </tr>
                                            <tr>
                                                <th>Tổng thanh toán:</th>
                                                <td>{{ number_format($order->total) }}vnd</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                            class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-success float-right"><i
                                            class="far fa-credit-card"></i> Submit
                                        Payment
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>

    </div>
@endsection
@section('js')
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('AdminBE/Product/list.js') }}"></script> --}}
@endsection
