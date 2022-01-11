<template>
    <li class="nav-item dropdown notification_dropdown">
        <a
            class="nav-link bell ai-icon"
            href="#"
            role="button"
            data-toggle="dropdown"
        >
            <svg
                id="icon-user"
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewbox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-bell"
            >
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <span class="badge badge-danger">3</span>
            {{--
            <div class="pulse-css"></div>
            --}}
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <ul class="list-unstyled">
                <li class="media dropdown-item">
                    <div class="media-body">
                        <a href="#">
                            <p>
                                <strong>David</strong> purchased Light Dashboard
                                1.0.
                            </p>
                        </a>
                    </div>
                    <span class="notify-time">3:20 am</span>
                </li>
            </ul>
            <a class="all-notification" href="#"
                >See all notifications <i class="ti-arrow-right"></i
            ></a>
        </div>
    </li>
</template>

<script>
export default {};
</script>

<style></style>
