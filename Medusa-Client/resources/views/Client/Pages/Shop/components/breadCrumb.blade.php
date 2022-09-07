<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ Url('/') }}"><i class="fa fa-home"></i> Home</a>

                    @if (isset($category))
                        <a>{{ $page }}</a>
                        <span>{{ $category }}</span>
                    @else
                    <span>{{ $page }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
