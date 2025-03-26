@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Danh Sách Sản Phẩm</h1>
    <a href="{{ route('admin.comics.create') }}" class="btn btn-primary">Thêm Sản Phẩm</a>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Tiêu Đề</th>
                <th>Danh Mục</th>
                <th>Giá</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comics as $comic)
            <tr>
                <td><a href="{{ route('admin.comics.show', $comic) }}">{{ $comic->title }}</a></td>
                <td>{{ $comic->category->name ?? 'N/A' }}</td>
                <td>{{ $comic->price }}</td>
                <td>
                    <a href="{{ route('admin.comics.show', $comic) }}" class="btn btn-warning">xem </a>
                    <a href="{{ route('admin.comics.edit', $comic) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('admin.comics.destroy', $comic) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection