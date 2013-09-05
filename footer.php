            <a href="contact">
                <div data-role="footer" data-theme="a">
                        <?php
                            if (isset($_SESSION['username'])) {
                                echo "<h1>Logged in as: " . $_SESSION['username'] . "</h1>";
                            } else {
                                echo "<h1>You are not logged in</h1>";
                            }
                        ?>
                        <h1>Contact Us</h1>
                </div>
            </a>
