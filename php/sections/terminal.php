<section id="terminal" class="py-5">
    <div class="container" data-aos="fade-up">
        <h2 class="text-center mb-5 fw-bold position-relative">
            <span class="position-relative">Security Console
                <span class="position-absolute w-50 h-2 bg-primary" style="bottom: -8px; left: 25%; height: 3px;"></span>
            </span>
        </h2>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="terminal-window card border-0 shadow-lg">
                    <div class="card-header bg-dark d-flex justify-content-between align-items-center p-2">
                        <div class="terminal-dots">
                            <span class="dot bg-danger"></span>
                            <span class="dot bg-warning"></span>
                            <span class="dot bg-success"></span>
                        </div>
                        <div class="terminal-title text-light small">security@lenagibson:~</div>
                        <div></div>
                    </div>
                    <div class="card-body p-3 bg-dark">
                        <div id="terminal-content" class="text-light font-monospace">
                            <div class="terminal-line"><span class="text-success">lena@security</span>:<span class="text-primary">~</span>$ whoami</div>
                            <div class="terminal-line">lena.gibson - Cyber Security Infrastructure Specialist</div>
                            <div class="terminal-line"><span class="text-success">lena@security</span>:<span class="text-primary">~</span>$ ls -la skills/</div>
                            <div class="terminal-line">total 8</div>
                            <div class="terminal-line">drwxr-xr-x  2 lena security 4096 Jun 14 08:23 azure_security/</div>
                            <div class="terminal-line">drwxr-xr-x  2 lena security 4096 Jun 14 08:23 sentinel/</div>
                            <div class="terminal-line">drwxr-xr-x  2 lena security 4096 Jun 14 08:23 defender/</div>
                            <div class="terminal-line">drwxr-xr-x  2 lena security 4096 Jun 14 08:23 entra_id/</div>
                            <div class="terminal-line"><span class="text-success">lena@security</span>:<span class="text-primary">~</span>$ <span id="terminal-cursor">_</span></div>
                        </div>
                        <div class="terminal-input-area mt-2">
                            <div class="input-group">
                                <span class="input-group-text bg-dark text-light border-0"><span class="text-success">lena@security</span>:<span class="text-primary">~</span>$</span>
                                <input type="text" id="terminal-command" class="form-control bg-dark text-light border-0" placeholder="Type 'help' for available commands">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="terminal-help text-center mt-3">
                    <small class="text-muted">Try commands: help, skills, about, projects, contact</small>
                </div>
            </div>
        </div>
    </div>
</section>
