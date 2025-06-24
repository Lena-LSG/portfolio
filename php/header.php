<header class="bg-white py-3 sticky-top">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="index.php" class="text-decoration-none">
                <h1 class="mb-0 h4 fw-bold text-primary">Lena Gibson</h1>
                <p class="mb-0 small text-muted">Cyber Security Infrastructure Specialist</p>
            </a>
            
            <!-- Desktop Navigation -->
            <nav class="d-none d-md-flex align-items-center">
                <ul class="nav me-3">
                    <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#skills" class="nav-link">Skills</a></li>
                    <li class="nav-item"><a href="#projects" class="nav-link">Projects</a></li>
                    <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                </ul>
                <button id="darkModeToggle" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-moon"></i>
                </button>
            </nav>
            
            <!-- Mobile Menu Button -->
            <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav" aria-expanded="false" aria-controls="mobileNav">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <!-- Mobile Navigation (hidden by default) -->
        <div class="collapse d-md-none mt-3" id="mobileNav">
            <nav>
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#skills" class="nav-link">Skills</a></li>
                    <li class="nav-item"><a href="#projects" class="nav-link">Projects</a></li>
                    <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                    <li class="nav-item mt-2">
                        <button id="darkModeToggleMobile" class="btn btn-sm btn-outline-secondary w-100">
                            <i class="fas fa-moon"></i> Toggle Dark Mode
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>