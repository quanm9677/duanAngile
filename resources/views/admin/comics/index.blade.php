@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách Sản phẩm</h1>
    <a href="{{ route('comics.create') }}" class="btn btn-primary">Thêm Sản phẩm</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Tác giả</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comics as $comic)
            <tr>
                <td>{{ $comic->id }}</td>
                <td>{{ $comic->title }}</td>
                <td>{{ $comic->author->name ?? 'Chưa có' }}</td>
                <td>{{ $comic->category->name ?? 'Chưa có' }}</td>
                <td>{{ number_format($comic->price, 2) }} VNĐ</td>
                <td>
                    <a href="{{ route('comics.edit', $comic) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('comics.destroy', $comic) }}" method="POST" style="display:inline;">
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