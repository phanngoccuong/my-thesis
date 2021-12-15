@if (Auth::user()->role_name == 'Admin')

<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-user-plus"></i>
                    <span class="nav-text">Management</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('userManagement') }}">All Users</a></li>
                </ul>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-user"></i>
                    <span class="nav-text">Teachers</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('teacher/list') }}">All Teachers</a></li>
                    <li><a href="{{ route('teacher/add') }}">Add Teacher</a></li>
                    {{-- <li><a href="{{ route('teacher/show') }}">Teachers Profile</a></li> --}}
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-calendar-o"></i>
                    <span class="nav-text">Lessons</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('lesson/list') }}">All Lessons</a></li>
                    <li><a href="{{ route('lesson/add') }}">Add Lessons</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Students</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('student/list') }}">All Students</a></li>
                    <li><a href="{{ route('student/add') }}">Add Students</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-graduation-cap"></i>
                    <span class="nav-text">Classes</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('classes/list') }}">All Classes</a></li>
                    <li><a href="{{ route('classes/add') }}">Add Classes</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-building"></i>
                    <span class="nav-text">Classroom</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('classroom/list') }}">All Room</a></li>
                    <li><a href="{{ route('classroom/add') }}">Add Room</a></li>
                </ul>
            </li>

            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-university"></i>
                    <span class="nav-text">Courses</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('course/list') }}">All Courses</a></li>
                    <li><a href="{{ route('course/add') }}">Add Course</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Batches</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('batch/list') }}">All Batches</a></li>
                    <li><a href="{{ route('batch/add') }}">Add Batch</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-certificate"></i>
                    <span class="nav-text">Semester</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('semester/list') }}">All Semester</a></li>
                    <li><a href="{{ route('semester/add') }}">Add Semester</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-cloud"></i>
                    <span class="nav-text">Day</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('day/list') }}">All days</a></li>
                    <li><a href="{{ route('day/add') }}">Add day</a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-history"></i>
                    <span class="nav-text">Time</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('time/list') }}">All Times</a></li>
                    <li><a href="{{ route('time/add') }}">Add Time</a></li>
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
                    {{-- <li><a href="{{ route('classroom/add') }}">Học lực</a></li> --}}
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
                    <li><a href="{{ route('teacher.class.list') }}">Thông tin lớp quản lý</a></li>
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
