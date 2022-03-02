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
    <h2>Danh Sách Học Sinh</h2>
    <table class="table">
        <tr>
            <th>Họ và tên </th>
            <th>Ngày sinh</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Giới tính</th>
            <th>Niên khóa</th>
            <th>Tên bố</th>
            <th>Tên mẹ</th>
            <th>SĐT Bố</th>
            <th>SĐT Mẹ</th>
        </tr>
            @foreach($students as $student)
        <tr>
            <td>{{ $student->last_name }} {{ $student->first_name }}</td>
            <td>{{ $student->dateOfBirth }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->address }}</td>
            <td>
                @if ($student->gender == 1)
                        Nam
                        @else
                        Nữ
                    @endif
            </td>
            <td>{{  $student->batches->batch_name }}</td>
            <td>
                {{ $student->father_name }}
            </td>
            <td>{{ $student->mother_name }}</td>
            <td>{{ $student->father_number }}</td>
            <td>{{ $student->mother_number }}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>
