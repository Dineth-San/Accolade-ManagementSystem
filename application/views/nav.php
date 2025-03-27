<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand">Accolade Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <?php
                if (isset($this->session->userdata['logged_in'])) {
                    $username = ($this->session->userdata['logged_in']['username']);

                    echo "<div class=\"dropdown \">
                    
                            <a href=\"#\" class=\"nav-link dropdown-toggle\" role=\"button\"  data-toggle=\"dropdown\" >";
                                echo "Hi " . ucwords($username);
                                echo "<span class=\"caret\"></span>
                            </a>
                            <div class=\"dropdown-menu\" >
                                <a class=\"dropdown-item\" href=\" " . base_url() . "user_authentication/logout\">Logout</a>
                            </ul>
                        </div>";
                }
                
                ?>
            </li>
        </ul>
    </div>
</nav>