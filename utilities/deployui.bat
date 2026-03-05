set API_URL=http://localhost:8081
cd /D "%~dp0"
robocopy "..\adhdappserver\src" "C:\httpd\Apache24\htdocs" /MIR /S
echo Files Copied. Loading Apache server...
cd /D "C:\httpd\Apache24\bin"
httpd.exe