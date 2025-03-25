@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Chi tiết Danh mục</h5>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="200" class="bg-light">ID</th>
                                    <td>{{ $category->id }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Tên danh mục</th>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Mô tả</th>
                                    <td>{{ $category->description ?: 'Không có mô tả' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Ngày tạo</th>
                                    <td>{{ $category->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Cập nhật lần cuối</th>
                                    <td>{{ $category->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit"></i> Sửa danh mục
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                <i class="fas fa-trash"></i> Xóa danh mục
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection