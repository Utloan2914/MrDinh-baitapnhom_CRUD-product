<header>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('source/assets/dest/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('source/assets/dest/vendors/colorbox/example3/colorbox.css') }}">
    <link rel="stylesheet" href="{{ asset('source/assets/dest/rs-plugin/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('source/assets/dest/rs-plugin/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('source/assets/dest/css/animate.css') }}">
    <link rel="stylesheet" title="style" href="{{ asset('source/assets/dest/css/huong-style.css') }}">
    <link rel="stylesheet" href="{{ asset('source/assets/dest/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('eshopper/images/ico/favicon.ico') }}">
</header>
<div class="space50">&nbsp;</div>
<div class="container beta-relative">
    <div class="pull-left">
        <h2>Edit product</h2>
    </div>
    <div class="space50">&nbsp;</div>
    @include('pageadmin.error')
    <div class="container">
        <form id="edit-product-form" action="{{ route('updateProduct', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for='editName'>Name</label>
                <input type="text" class="form-control" name="editName" id="editName" value="{{$product->name}}" required>
            </div>

            <div class="form-group">
                <label for='editPrice'>Price</label>
                <input type="number" min="10000" class="form-control" name="editPrice" id="editPrice" value="{{$product->unit_price}}" required>
            </div>

            <div class="form-group">
                <label for='editPromotionPrice'>Promotion Price</label>
                <input type="number" min="10000" class="form-control" name="editPromotionPrice" id="editPromotionPrice" value="{{$product->promotion_price}}">
            </div>

            <div class="form-group">
                <label for='editUnit'>Unit</label>
                <input type="text" class="form-control" name="editUnit" id="editUnit" value="{{$product->unit}}" required>
            </div>

            <div class="form-group">
                <label for='editNew'>New</label>
                <input type="number" min="0" class="form-control" name="editNew" id="editNew" value="{{$product->new}}" required>
            </div>

            <div class="form-group">
                <label for='editType'>Type</label>
                <input type="text" class="form-control" name="editType" id="editType" value="{{$product->id_type}}" required>
            </div>

            <div class="form-group">
                <label for='editImage'>Image file</label>
                <input type="file" class="form-control-file" name="editImage" id="editImage">
            </div>

            <div class="form-group">
                <img id="preview-image-before-upload" src="/source/image/product/{{$product->image}}" alt="preview image" style="max-height: 250px;">
            </div>

            <div class="form-group">
                <label for='editDescription'>Description</label>
                <textarea name="editDescription" id="editDescription" required>{{$product->description}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('edit-product-form').addEventListener('submit', async function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của form

            const formData = new FormData(this);
            const productId = "{{ $product->id }}"; // Lấy ID sản phẩm từ Blade
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch(`/update/${productId}`, {
                    method: 'PUT', // Laravel không hỗ trợ PUT trong form, cần dùng POST
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Có lỗi xảy ra khi cập nhật sản phẩm');
                }

                alert('Sản phẩm đã được cập nhật thành công!');
                window.location.href = '/';
            } catch (error) {
                console.error('Chi tiết lỗi:', error);
                alert(error.message);
            }
        });
    </script>