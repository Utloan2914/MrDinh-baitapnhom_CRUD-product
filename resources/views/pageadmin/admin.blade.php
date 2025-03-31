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
<div class="container">

  <div class="d-flex justify-content-between align-items-center my-3">
    <h2 class="text-primary"><i class="fa fa-list"></i> Danh sách sản phẩm</h2>
    <a href="{{ route('add-product') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Thêm sản phẩm</a>
  </div>

  <div class="table-responsive">
    <table id="table_admin_product" class="table table-hover table-bordered shadow-sm bg-white">
      <thead class="bg-dark text-white">
        <tr class="text-center">
          <th>ID</th>
          <th>Ảnh</th>
          <th>Tên sản phẩm</th>
          <th>Loại</th>
          <th>Mô tả</th>
          <th>Giá gốc</th>
          <th>Giá khuyến mãi</th>
          <th>Đơn vị</th>
          <th>Mới</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody id="product-body">
      </tbody>
    </table>
  </div>

  <div class="space50">&nbsp;</div>
</div>

<script>
  async function fetchData(url) {
    let response = await fetch(url);
    let result = await response.json();
    return result;
  }

  async function deleteProduct(id) {
    if (confirm("Bạn có chắc muốn xoá sản phẩm này không?")) {
      let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const response = await fetch(`/delete/${id}`, {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": csrfToken
        }
      });

      const result = await response.json(); // Lấy response JSON
      if (result.success) {
        alert("Đã xoá sản phẩm!");
        location.reload();
      } else {
        alert(result.error); // Hiển thị lỗi nếu có
      }
    }
  }

  (async () => {
    let data = await fetchData('/products');
    let productBody = document.getElementById('product-body');

    productBody.innerHTML = "";

    data.forEach((product) => {
      productBody.innerHTML += `
      <tr class="text-center align-middle">
        <th>${product.id}</th>
        <td>
        <img src="/source/image/product/${product.image}" alt="image" class="img-fluid" style="height: 200px; width: 300px; object-fit: cover; border-radius: 10px;"/>
        </td> 
        <td>${product.name}</td>
        <td>${product.id_type}</td>
      <td style="
          max-width: 400px;
          white-space: normal;
          word-break: break-word;
        ">
          ${product.description}
        </td>

        <td>${product.unit_price.toLocaleString()}đ</td>
        <td>${product.promotion_price > 0 ? product.promotion_price.toLocaleString() + 'đ' : '-'}</td>
        <td>${product.unit}</td>
        <td>
          ${product.new == 1
            ? '<span class="badge bg-success">Mới</span>'
            : '<span class="badge bg-secondary">Cũ</span>'}
        </td>
        <td style="display: flex; gap: 30px; justify-content: center;">
         <a href="/product/update/${product.id}" class="btn btn-warning">Sửa</a>
          <button onclick="deleteProduct(${product.id})" class="btn btn-danger ">Xoá</button>
        </td>

      </tr>
    `;
    });
  })();
</script>