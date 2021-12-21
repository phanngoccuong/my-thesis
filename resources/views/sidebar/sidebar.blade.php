@if (Auth::user()->role_name == 'Admin')

<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-user-plus"></i>
                    <span class="nav-text">Quản lý</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('userManagement') }}">Quản lý tài khoản</a></li>
                </ul>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-user"></i>
                    <span class="nav-text">Giáo viên</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('teacher/list') }}">Quản lý giáo viên</a></li>
                    <li><a href="{{ route('teacher/add') }}">Thêm giáo viên</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-calendar-o"></i>
                    <span class="nav-text">Thời khóa biểu</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('lesson/list') }}">Quản lý thời khóa biểu</a></li>
                    <li><a href="{{ route('lesson/add') }}">Thêm tiết học</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Học sinh</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('student/list') }}">Quản lý học sinh</a></li>
                    <li><a href="{{ route('student/add') }}">Thêm học sinh</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-graduation-cap"></i>
                    <span class="nav-text">Lớp</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('classes/list') }}">Quản lý lớp</a></li>
                    <li><a href="{{ route('classes/add') }}">Thêm lớp</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-building"></i>
                    <span class="nav-text">Phòng học</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('classroom/list') }}">Quản lý phòng học</a></li>
                    <li><a href="{{ route('classroom/add') }}">Thêm phòng học</a></li>
                </ul>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-university"></i>
                    <span class="nav-text">Môn học</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('course/list') }}">Quản lý môn học</a></li>
                    <li><a href="{{ route('course/add') }}">Thêm môn học</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Niên khóa</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('batch/list') }}">Quản lý niên khóa</a></li>
                    <li><a href="{{ route('batch/add') }}">Thêm niên khóa</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-certificate"></i>
                    <span class="nav-text">Kì học</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('semester/list') }}">Quản lý kì học</a></li>
                    <li><a href="{{ route('semester/add') }}">Thêm kì học</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-cloud"></i>
                    <span class="nav-text">Ngày học</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('day/list') }}">Quản lý ngày học</a></li>
                    <li><a href="{{ route('day/add') }}">Thêm ngày học</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-history"></i>
                    <span class="nav-text">Giờ học</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('time/list') }}">Quản lý giờ học</a></li>
                    <li><a href="{{ route('time/add') }}">Thêm giờ học</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@endif

{{-- Student Role --}}
@if (Auth::user()->role_name == 'Student')
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Quản lý hồ sơ học sinh</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('studentProfile') }}">Thông tin học sinh</a></li>
                    <li><a href="{{ route('studentClassInfo') }}">Thông tin lớp học sinh</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-calendar-o"></i>
                    <span class="nav-text">Kế hoạch học tập</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('studentTimetable') }}">Thời khóa biểu</a></li>
                    <li><a href="{{ route('timetableDetails') }}">Các môn đang học</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-certificate"></i>
                    <span class="nav-text">Kết quả học tập</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('student.mark.view') }}">Bảng điểm cá nhân</a></li>
                     <li><a href="{{ route('student.attendance.show') }}">Thông tin điểm danh</a></li>
                </ul>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-university"></i>
                    <span class="nav-text">Học phí</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('course/list') }}">Thông tin công nợ học phí</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@endif
{{-- Teacher Role --}}
@if (Auth::user()->role_name == 'Teacher')
<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow" href="{{ route('teacher.timetable.search') }}" aria-expanded="false">
                    <i class="la la-calendar-o"></i>
                    <span class="nav-text">Thời khóa biểu</span>
                </a>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Quản lý lớp</span>
                </a>
                <ul aria-expanded="false">
                    {{-- <li><a href="{{ route('classShow') }}">Lớp chủ nhiệm</a></li> --}}
                    <li><a href="{{ route('attendance.add') }}">Điểm danh</a></li>
                    <li><a href="{{ route('attendance.details') }}">Thông tin điểm danh</a></li>
                </ul>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-certificate"></i>
                    <span class="nav-text">Quản lý điểm</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('mark.add') }}">Nhập điểm</a></li>
                    <li><a href="{{ route('mark.edit') }}">Xem điểm</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@endif
