<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Danh sách hoc sinh</title>
    <style>
        *{ font-family: DejaVu Sans !important;}
        h2 {
            margin-left: 370px;
        }
        .table{
            border-collapse: collapse;
            width: 100%;
        }
        .table td , .table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Trường Tiểu Học Xuân Phương</h1>
        <h5>Địa chỉ : Xóm 3 Xã Xuân Phương Huyện Xuân Trường Tỉnh Nam Định</h5>
        <h6>Email : tieuhocxuanphuong@gmail.com</h6>
        <h6>Phone : 012345679</h6>
    </div>
    <h2>Danh Sách Giáo Viên</h2>
    <table class="table">
        <tr>
            <th>Họ và tên </th>
            <th>Ngày sinh</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Giới tính</th>
            <th>Chuyên môn</th>
        </tr>
            @foreach($teachers as $teacher)
        <tr>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->dob }}</td>
            <td>{{ $teacher->phone }}</td>
            <td>{{ $teacher->email }}</td>
            <td>{{ $teacher->address }}</td>
            <td>
                @if ($teacher->gender == 0)
                        Nam
                        @else
                        Nữ
                    @endif
            </td>
            <td>
                {{ $teacher->special }}
            </td>
        </tr>
        @endforeach
    </table>

</body>
</html>
