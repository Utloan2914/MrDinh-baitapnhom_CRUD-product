<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center text-primary mb-4">Add Product</h2>
        <form id="add" action="{{ route('addProduct') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="inputName" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="inputUnitPrice" class="form-label">Unit Price</label>
                    <input type="number" class="form-control" name="unit_price" id="inputUnitPrice" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputPromotionPrice" class="form-label">Promotion Price</label>
                    <input type="number" class="form-control" name="promotion_price" id="inputPromotionPrice">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="inputUnit" class="form-label">Unit</label>
                    <input type="text" class="form-control" name="unit" id="inputUnit" placeholder="Enter unit" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="inputNew" class="form-label">New</label>
                    <input type="number" min="0" max="1" class="form-control" name="new" id="inputNew" placeholder="0 or 1" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="inputType" class="form-label">Type ID</label>
                <input type="number" class="form-control" name="id_type" id="inputType" required>
            </div>

            <div class="mb-3">
                <label for="inputImage" class="form-label">Image file</label>
                <input type="file" class="form-control" name="image" id="inputImage">
                <img id="preview-image" src="/source/image/product/default-image.png" alt="image" class="img-fluid mt-2" style="height: 200px; width: 300px; object-fit: cover; border-radius: 10px;" />
            </div>

            <div class="mb-3">
                <label for="inputDescription" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="inputDescription" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('inputImage').addEventListener('change', function(event) {
            const file = event.target.files[0]; // Lấy tệp hình ảnh đầu tiên
            if (file) {
                const reader = new FileReader(); // Tạo một FileReader
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result; // Cập nhật src của img
                };
                reader.readAsDataURL(file); // Đọc tệp hình ảnh dưới dạng URL
            }
        });
    });

    document.getElementById('add').addEventListener('submit', async function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        formData.append('_token', '{{ csrf_token() }}');
        try {
            const response = await fetch("{{ route('addProduct') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            alert(result.message);
            window.location.href = '/';
        } catch (error) {
            alert(`Lỗi: ${error.message}`);
        }
    });
</script>