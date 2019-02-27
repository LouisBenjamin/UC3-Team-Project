@echo off
rem simple copy and test
ECHO ==========================================================================
echo ****WARNING THIS WILL DELETE CONTENTS OF HTDOCS FROM XAMPP******
echo This allows you to copy the Git Project into htdocs. 
echo -
echo IMPORTANT Always save your work-in-progress in git directory
echo not in htdocs
echo Press enter to confirm or CNTRL-C to cancel and exit
echo==========================================================================
del C:\xampp\htdocs\tato\*.* /f
xcopy *.* C:\xampp\htdocs\tato /s 
pause