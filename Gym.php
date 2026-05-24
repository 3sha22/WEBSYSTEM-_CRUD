<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FITMATE | GYMManagement Dashboard</title>
    <link rel="stylesheet" href="Gym.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<script src="Gym.js"></script>
<body>

    <div class="admin-container">
        
        <aside class="sidebar">
            <div class="sidebar-brand">
                <i class="fa-solid fa-dumbbell"></i> FIT<span>MATE</span>
            </div>
            <nav class="sidebar-menu">
                <p class="menu-label">Core Operations</p>
                <ul>
                    <li class="menu-item active" data-target="dashboard-view"><a href="#"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                    <li class="menu-item" data-target="members-view"><a href="#"><i class="fa-solid fa-users"></i> Members</a></li>
                    <li class="menu-item" data-target="subscriptions-view"><a href="#"><i class="fa-solid fa-id-card"></i> Subscriptions</a></li>
                    <li class="menu-item" data-target="plans-view"><a href="#"><i class="fa-solid fa-layer-group"></i> Membership Plans</a></li>
                    <li class="menu-item" data-target="payments-view"><a href="#"><i class="fa-solid fa-credit-card"></i> Payments</a></li>
                </ul>

                <p class="menu-label">Human Resources</p>
                <ul>
                    <li class="menu-item" data-target="trainers-view"><a href="#"><i class="fa-solid fa-user-tie"></i> Trainers</a></li>
                    <li class="menu-item" data-target="staff-view"><a href="#"><i class="fa-solid fa-user-shield"></i> Gym Staff</a></li>
                    <li class="menu-item" data-target="attendance-view"><a href="#"><i class="fa-solid fa-calendar-check"></i> Attendance</a></li>
                    <li class="menu-item" data-target="applications-view"><a href="#"><i class="fa-solid fa-file-signature"></i> Applications</a></li>
                </ul>

                <p class="menu-label">Facilities & Fitness</p>
                <ul>
                    <li class="menu-item" data-target="programs-view"><a href="#"><i class="fa-solid fa-calendar-days"></i> Programs</a></li>
                    <li class="menu-item" data-target="progress-view"><a href="#"><i class="fa-solid fa-bars-progress"></i> Progress Tracking</a></li>
                    <li class="menu-item" data-target="equipment-view"><a href="#"><i class="fa-solid fa-screwdriver-wrench"></i> Equipment</a></li>
                    <li class="menu-item" data-target="maintenance-view"><a href="#"><i class="fa-solid fa-triangle-exclamation"></i> Maintenance</a></li>
                    <li class="menu-item" data-target="emergency-view"><a href="#"><i class="fa-solid fa-phone-flip"></i> Emergency Contacts</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            
            <header class="topbar">
                <div class="search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search members, equipment, payments...">
                </div>
                <div class="admin-profile">
                    <i class="fa-solid fa-bell notification-badge"></i>
                    
                    <div class="profile-dropdown" id="profileDropdown">
                        <div class="profile-info">
                            <span class="admin-name">Miko Ocfemia</span>
                            <span class="admin-role">General Manager <i class="fa-solid fa-chevron-down dropdown-caret"></i></span>
                        </div>
                        
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa-solid fa-user-gear"></i> Account Settings</a></li>
                            <li><a href="#"><i class="fa-solid fa-clock-rotate-left"></i> System Logs</a></li>
                            <li class="divider"></li>
                            <li><a href="#" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
                        </ul>
                    </div>

                </div>
            </header>

            <div class="dashboard-viewport">
                
                <div id="dashboard-view" class="view-panel active">
                    <div class="metrics-grid">
                        <div class="metric-card">
                            <div class="metric-icon primary"><i class="fa-solid fa-user-plus"></i></div>
                            <div class="metric-data"><h3>1,248</h3><p>Active Members</p></div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-icon success"><i class="fa-solid fa-dollar-sign"></i></div>
                            <div class="metric-data"><h3>$1M</h3><p>Payments (Month)</p></div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-icon warning"><i class="fa-solid fa-clipboard-user"></i></div>
                            <div class="metric-data"><h3>100%</h3><p>Attendance Today</p></div>
                        </div>
                        <div class="metric-card">
                            <div class="metric-icon danger"><i class="fa-solid fa-wrench"></i></div>
                            <div class="metric-data"><h3>0 Items</h3><p>Pending Repairs</p></div>
                        </div>
                    </div>

                    <div class="content-grid">
                        <div class="panel">
                            <div class="panel-header">
                                <h2>Active Member Subscriptions & Progress</h2>
                                <button class="panel-btn trigger-modal" data-action="add-member"><i class="fa-solid fa-plus"></i> Add Member</button>
                            </div>
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Member</th>
                                        <th>Membership Plan</th>
                                        <th>Status</th>
                                        <th>Goal Progress</th>
                                        <th>Actions</th> <!--Trisha part , i addded this for action for delete -->
                                    </tr>
                                </thead>
                               <tbody>
<?php
$sql = "SELECT * FROM members";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
?>
<tr>
    <td><strong><?php echo $row['FirstName'] . " " . $row['LastName']; ?></strong></td>
    <td><?php echo $row['MembershipPlan'] ?? 'N/A'; ?></td>
    <td>
        <span class="badge badge-success">
            <?php echo $row['Status'] ?? 'Active'; ?>
        </span>
    </td>
    <td>
        <div class="progress-bar-container">
            <div class="progress-bar" style="width: <?php echo $row['Progress'] ?? 50; ?>%;"></div>
        </div>
    </td>
</tr>
<?php } ?>
</tbody>
                            </table>
                        </div>

                        <div class="panel">
                            <div class="panel-header">
                                <h2>Recent System Actions & Fault Logs</h2>
                            </div>
                            <div class="logistics-list">
                                <div class="log-item">
                                    <div class="log-indicator danger"></div>
                                    <div class="log-details">
                                        <h4>Treadmill #4 Malfunction</h4>
                                        <p>Assigned to: Maintenance Staff | Status: Pending</p>
                                    </div>
                                </div>
                                <div class="log-item">
                                    <div class="log-indicator primary"></div>
                                    <div class="log-details">
                                        <h4>Emergency Contacts Checked</h4>
                                        <p>Database synchronization protocol verification successful.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="members-view" class="view-panel">
                    <div class="panel">
                        <div class="panel-header">
                            <h2>Legal Members Database</h2>
                            <button class="panel-btn trigger-modal" data-action="add-member"><i class="fa-solid fa-plus"></i> Add New Member</button>
                        </div>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Full indexing and administrative profile parameters for gym members list records.</p>
                    </div>
                </div>

                <div id="subscriptions-view" class="view-panel">
                    <div class="panel">
                        <h2>Active Membership Subscriptions</h2>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Track ongoing payment loops, renew dates, and system lockout flags.</p>
                    </div>
                </div>

                <div id="plans-view" class="view-panel">
                    <div class="panel">
                        <h2>Configured Membership Plans</h2>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Define corporate rates, day pass access caps, and seasonal tiers.</p>
                    </div>
                </div>

                <div id="payments-view" class="view-panel">
                    <div class="panel">
                        <h2>Invoices & Payment Transactions</h2>
                        <p style="color: var(--text-muted); margin-top: 1rem;">View real-time point-of-sale logs, payout metrics, and billing errors.</p>
                    </div>
                </div>

                <div id="trainers-view" class="view-panel">
                    <div class="panel">
                        <h2>Personal Fitness Trainers Registry</h2>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Manage coach payroll, roster shifts, assigned trainees, and bio blocks.</p>
                    </div>
                </div>

                <div id="staff-view" class="view-panel">
                    <div class="panel">
                        <h2>Internal Gym Staff Accounts</h2>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Front desk, cleaning crews, and access authority authorization parameters.</p>
                    </div>
                </div>

                <div id="attendance-view" class="view-panel">
                    <div class="panel">
                        <h2>Check-In & Attendance Tracking Logs</h2>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Daily bar code scan statistics, timestamps, and capacity thresholds.</p>
                    </div>
                </div>

                <div id="applications-view" class="view-panel">
                    <div class="panel">
                        <h2>Job & Membership Applications Inbox</h2>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Review onboarding documents, digital forms, and resumes.</p>
                    </div>
                </div>

                <div id="programs-view" class="view-panel">
                    <div class="panel">
                        <h2>Group Fitness Class Programs Schedule</h2>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Time slots for Yoga, High-Intensity Cardio Circuits, and Spin classes.</p>
                    </div>
                </div>

                <div id="progress-view" class="view-panel">
                    <div class="panel">
                        <h2>Member Biometrics & Progress Metrics</h2>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Log lean mass ratios, weighing scales timelines, and fitness benchmarks.</p>
                    </div>
                </div>

                <div id="equipment-view" class="view-panel">
                    <div class="panel">
                        <div class="panel-header">
                            <h2>Gym Floor Asset Inventory & Equipment</h2>
                            <button class="panel-btn trigger-modal" data-action="report-maintenance" style="background: var(--accent-danger); color: white;"><i class="fa-solid fa-triangle-exclamation"></i> Flag Defective Unit</button>
                        </div>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Warranty tags, procurement dates, and structural equipment serial indices.</p>
                    </div>
                </div>

                <div id="maintenance-view" class="view-panel">
                    <div class="panel">
                        <h2>Facilities Maintenance Tickets Queue</h2>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Urgent engineering tasks, facility breakdowns, and architectural updates.</p>
                    </div>
                </div>

                <div id="emergency-view" class="view-panel">
                    <div class="panel">
                        <div class="panel-header">
                            <h2>Critical Medical Records & Emergency Contacts</h2>
                            <button class="panel-btn trigger-modal" data-action="emergency-protocol" style="background: var(--accent-warning); color: #000;"><i class="fa-solid fa-phone"></i> View Emergency Script</button>
                        </div>
                        <p style="color: var(--text-muted); margin-top: 1rem;">Primary physicians contacts, healthcare allergy notices, and phone numbers.</p>
                    </div>
                </div>

            </div> 
        </main>
    </div>

    <div id="system-modal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="modal-title">Administrative Input Action</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body" id="modal-body-content">
            </div>
        </div>
    </div>

    

    

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            
            // --- FUNCTION 1: VIEW NAVIGATION CONTROLLER ---
            const menuItems = document.querySelectorAll(".sidebar-menu .menu-item");
            const viewPanels = document.querySelectorAll(".view-panel");

            menuItems.forEach(item => {
                item.addEventListener("click", (e) => {
                    e.preventDefault();
                    
                    // Clear structural navigation tags
                    menuItems.forEach(i => i.classList.remove("active"));
                    item.classList.add("active");

                    // Hide current active panels, show requested pane
                    const targetView = item.getAttribute("data-target");
                    viewPanels.forEach(panel => {
                        if (panel.id === targetView) {
                            panel.classList.add("active");
                        } else {
                            panel.classList.remove("active");
                        }
                    });
                });
            });

            // --- FUNCTION 2: POPUP INTERACTIVE TEMPLATES ---
            const modal = document.getElementById("system-modal");
            const modalTitle = document.getElementById("modal-title");
            const modalBodyContent = document.getElementById("modal-body-content");
            const closeBtn = document.querySelector(".close-modal");

            const formTemplates = {
                "add-member": {
                    title: "Register New Member System Account",
                    html: `
                        <form id="modal-form-element">
                            <div class="form-group">
                                <label>Full Legal Name</label>
                                <input type="text" placeholder="Jane Doe" required>
                            </div>
                            <div class="form-group">
                                <label>Selection Plan Tier</label>
                                <select>
                                    <option>Standard Tier Plan</option>
                                    <option>VIP Elite (Monthly Pass)</option>
                                    <option>Basic Cardio Pack</option>
                                </select>
                            </div>
                            <button type="submit" class="panel-btn" style="background: var(--accent-success); color: white; width: 100%; padding: 0.75rem; border:none; margin-top:1rem; border-radius:6px; font-weight:600; cursor:pointer;">Complete Enrolment Matrix</button>
                        </form>
                    `
                },
                "report-maintenance": {
                    title: "Log Structural Equipment Breakdown",
                    html: `
                        <form id="modal-form-element">
                            <div class="form-group">
                                <label>Defective Machine Name & Code</label>
                                <input type="text" placeholder="e.g., Rowers Station #3" required>
                            </div>
                            <div class="form-group">
                                <label>Mechanical Error Breakdown Description</label>
                                <input type="text" placeholder="Hydraulic valve leakage / Loose bolts" required>
                            </div>
                            <button type="submit" class="panel-btn" style="background: var(--accent-danger); color: white; width: 100%; padding: 0.75rem; border:none; margin-top:1rem; border-radius:6px; font-weight:600; cursor:pointer;">Dispatch Maintenance Crew</button>
                        </form>
                    `
                },
                "emergency-protocol": {
                    title: "Immediate Critical Safety Directives",
                    html: `
                        <div style="font-size: 0.9rem; line-height: 1.5;">
                            <p style="color: var(--accent-danger); font-weight: 700; margin-bottom: 0.5rem;"><i class="fa-solid fa-circle-exclamation"></i> CRITICAL FIRST RESPONSE LINE: 911</p>
                            <p style="margin-bottom: 1rem;">Facility Address: <strong>100 Fitness Force Way, Suite A, Main District</strong></p>
                            <hr style="border: 0; border-top: 1px solid var(--border-color); margin-bottom:1rem;">
                            <button type="button" class="panel-btn close-modal-btn" style="background: var(--text-dark); color: white; width: 100%; padding: 0.5rem; border:none; border-radius:6px; cursor:pointer;">Dismiss Log</button>
                        </div>
                    `
                }
            };

            // Global Button Click Event Lister Hook
            document.body.addEventListener("click", (e) => {
                const triggerButton = e.target.closest(".trigger-modal");
                if (triggerButton) {
                    const action = triggerButton.getAttribute("data-action");
                    const targetTemplate = formTemplates[action];

                    if (targetTemplate) {
                        modalTitle.innerText = targetTemplate.title;
                        modalBodyContent.innerHTML = targetTemplate.html;
                        modal.classList.add("open");
                    }
                }

                // Internal inline popup dismiss button listener handles
                if (e.target.classList.contains("close-modal-btn")) {
                    dismissModal();
                }
            });

            const dismissModal = () => modal.classList.remove("open");
            closeBtn.addEventListener("click", dismissModal);
            window.addEventListener("click", (e) => { if (e.target === modal) dismissModal(); });

            modalBodyContent.addEventListener("submit", (e) => {
                e.preventDefault();
                alert("Database state committed. The dashboard telemetry metrics updated successfully.");
                dismissModal();
            });

            // --- NEW FUNCTION 3: ADMINISTRATIVE PROFILE DROPDOWN MENU ---
            const profileDropdown = document.getElementById("profileDropdown");
            
            profileDropdown.addEventListener("click", (e) => {
                // Toggle active menu state configuration
                profileDropdown.classList.toggle("open");
                e.stopPropagation();
            });

            // Handle clean closing mechanics when clicking elsewhere in viewport
            window.addEventListener("click", () => {
                if (profileDropdown.classList.contains("open")) {
                    profileDropdown.classList.remove("open");
                }
            });

            
        });
    </script>
</body>
</html>