<aside id="sidebar" class="side">
    <div class="h-100">
        <div class="sidebar_logo d-flex align-items-end">

            <a href="#" class="nav-link text-white-50">Dashboard</a>

        </div>

        <ul class="sidebar_nav">
            <li class="sidebar_item<?php if ($currPath === 'dashboard') echo ' active' ?>" style="width: 100%;">
                <a href="/jobify/dashboard" class="sidebar_link"> <img src="views/img/1. overview.svg" alt="icon">Overview</a>
            </li>
            <li class="sidebar_item<?php if ($currPath === 'job') echo ' active' ?>">
                <a href="/jobify/job" class="sidebar_link"> <img src="views/img/task.svg" alt="icon">Job</a>
            </li>
            <li class="sidebar_item<?php if ($currPath === 'app') echo ' active' ?>">
                <a href="/jobify/application" class="sidebar_link"> <img src="views/img/task.svg" alt="icon">Application</a>
            </li>
            <li class="sidebar_item<?php if ($currPath === 'contact') echo ' active' ?>">
                <a href="/jobify/contact" class="sidebar_link"><img src="views/img/agent.svg" alt="icon">Contact</a>
            </li>
            <li class="sidebar_item<?php if ($currPath === 'article') echo ' active' ?>">
                <a href="#" class="sidebar_link"><img src="views/img/articles.svg" alt="icon">Articles</a>
            </li>

        </ul>
        <div class="line"></div>
        <a href="#" class="sidebar_link"><img src="views/img/settings.svg" alt="">Settings</a>


    </div>
</aside>