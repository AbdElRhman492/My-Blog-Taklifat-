        <header class="header">
            <div class="header__container">
                <img src="#" alt="profile img" class="header__img">

                <a href="dashboard.php" class="header__logo">Admin Dashboard</a>
    
                <div class="header__toggle">
                    <i class='bx bx-menu' id="header-toggle"></i>
                </div>
            </div>
        </header>

        <div class="nav" id="navbar">
            <nav class="nav__container">
                <div>
                    <a href="index.php" class="nav__link nav__logo">
                        <i class='bx bxs-disc nav__icon' ></i>
                        <span class="nav__logo-name">Admin Dashboard</span>
                    </a>
    
                    <div class="nav__list">
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Tools</h3>
    
                            <a href="index.php" class="nav__link active">
                                <i class="fa-solid fa-house nav__icon"></i>
                                <span class="nav__name">Home</span>
                            </a>
                            
                            <div class="nav__dropdown">
                                <p class="nav__link">
                                    <i class="fa-solid fa-users nav__icon"></i>
                                    <span class="nav__name">Members</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </p>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="members.php?do=manage" class="nav__dropdown-item">All Members</a>
                                        <a href="members.php?do=add" class="nav__dropdown-item">Add Member</a>
                                        <a href="members.php?do=manage&page=pending" class="nav__dropdown-item">Pending Members</a>
                                    </div>
                                </div>
                            </div>

                            <div class="nav__dropdown">
                                <p class="nav__link">
                                    <i class='bx bx-user nav__icon' ></i>
                                    <span class="nav__name">Categories</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </p>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="categories.php" class="nav__dropdown-item">All Categories</a>
                                        <a href="categories.php?do=add" class="nav__dropdown-item">Add Category</a>
                                        <a href="categories.php?do=manage&page=pending" class="nav__dropdown-item">Pending Categories</a>
                                    </div>
                                </div>
                            </div>

                            <div class="nav__dropdown">
                                <p class="nav__link">
                                    <i class='bx bx-user nav__icon' ></i>
                                    <span class="nav__name">Articles</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </p>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="#" class="nav__dropdown-item">All Articles</a>
                                        <a href="#" class="nav__dropdown-item">Add Articles</a>
                                        <a href="#" class="nav__dropdown-item">Pending Articles</a>
                                    </div>
                                </div>
                            </div>

                        </div>
    
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Setting</h3>
    
                            <div class="nav__dropdown">
                                <p class="nav__link">
                                    <i class='bx bx-bell nav__icon' ></i>
                                    <span class="nav__name">Profile</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </p>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="members.php?do=edit&userID=<?php echo $_SESSION['ID'] ?>" class="nav__dropdown-item">Edit Profile</a>
                                        <a href="#" class="nav__dropdown-item">Publish</a>
                                        <a href="#" class="nav__dropdown-item">Program</a>
                                    </div>
                                </div>

                            </div>

                            <a href="#" class="nav__link">
                                <i class='bx bx-compass nav__icon' ></i>
                                <span class="nav__name">Explore</span>
                            </a>
                            <a href="#" class="nav__link">
                                <i class='bx bx-bookmark nav__icon' ></i>
                                <span class="nav__name">Saved</span>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="logout.php" class="nav__link nav__logout">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>