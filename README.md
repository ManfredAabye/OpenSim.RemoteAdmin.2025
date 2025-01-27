# OpenSim.RemoteAdmin.2025

## Overview
OpenSim RemoteAdmin 2025 is a PHP-based remote administration tool for OpenSimulator.

## Requirements
- PHP <>= 8.3 or higher
- OpenSimulator 0.9.3.x or higher
- A web server (e.g., Apache, Nginx)
- Internet access for remote administration

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/ManfredAabye/OpenSim.RemoteAdmin.2025.git
   ```

## How to Setup the Remote Admin interface

First you should enable the remote admin interface to do so just add the following lines to your OpenSim.ini file Port should be set to a nonzero value to have the remote admin on a different port

As of r/16843 you can limit access to remote admin to specific IP addresses by using the optional access_ip_addresses. You can list all IP's allowed to access remote admin by seperating each IP by a comma. If access_ip_addresses isn't set, then all IP addresses can access RemoteAdmin.

```bash
[RemoteAdmin]
enabled = true
access_password = secret
enabled_methods = all
```

See OpenSim.ini.example in the OpenSimulator distribution for more details. 

