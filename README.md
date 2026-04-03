# vigilara-websec-joomla
A modern, modular security dashboard and event‑monitoring plugin for Joomla
Vigilara WebSec – Advanced Security Monitoring for Joomla 6
A modern, modular security dashboard and event‑monitoring plugin for Joomla.
Vigilara WebSec is a next‑generation security monitoring plugin designed for Joomla 6.
It provides administrators with a clean, real‑time overview of their site’s security posture through event logging, system checks, permission analysis, and a dynamic dashboard widget.
The plugin focuses on clarity, performance, and extensibility — making it ideal for both everyday administrators and developers who want deeper insight into their Joomla installation.

Features:

Real‑Time Security Event Logging
• 	Captures critical security‑related events such as:
• 	Failed logins

• 	User account changes

• 	Administrative actions

• 	Stores events in a dedicated database table

• 	Uses structured JSON data for flexible processing and analysis

Security Score Engine:

Evaluates the overall security posture based on:
• 	PHP configuration

• 	Joomla security settings

• 	File permission checks

• 	Recent critical events

Produces:

• 	A 0–100 security score

• 	A status label: Secure, Warning, or Critical

System & PHP Security Checks

• 	Analyzes PHP settings relevant to security

• 	Evaluates Joomla configuration

• 	Provides a clear, categorized status overview

Permission Scanner
• 	Scans file and directory permissions

• 	Flags insecure or dangerous permission levels

• 	Integrates into the security score calculation

Unified AJAX API
All dashboard data is delivered through a single AJAX endpoint:
/index.php?option=com_ajax&plugin=vigilara_websec&format=json
Optimized for:

• 	Fast dashboard loading

• 	Live updates

• 	Low server overhead

Dashboard Integration
Includes a fully integrated Joomla Administrator Dashboard widget:

• 	Security gauge

• 	Tabs for system, PHP, permissions, and event logs

• 	Live event feed

• 	Responsive layout

Architecture Overview
The plugin follows a clean, modular structure:
plugins/system/vigilara_websec/

│

├── src/

│   ├── Event/Listener.php

│   ├── Dashboard/VigilaraWidget.php

│   ├── Service/SystemInfo.php

│   ├── Security/PermissionsChecker.php
│   └── ...

│

├── tmpl/dashboard/default.php

├── vigilara_websec.php

└── vigilara_websec.xml

Key design principles:

• 	PSR‑4 autoloading

• 	Event‑subscriber architecture

• 	Service‑oriented design

• 	Separation of logic, rendering, and data

Project Status
Vigilara WebSec is currently in active development.
It is stable enough for testing and experimentation, but no official release has been published yet.

Planned enhancements:

• 	Advanced premium dashboard

• 	Real‑time charts

• 	IP reputation checks

• 	Firewall module

• 	Export/import tools

• 	Multi‑site monitoring

License
Licensed under the GNU General Public License v3 (GPL‑3.0).

Contributing
Contributions, bug reports, and feature suggestions are welcome.
This project is open to developers who want to help shape a modern Joomla security toolkit.
