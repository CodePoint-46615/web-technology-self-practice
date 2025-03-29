@echo off
cd /d "C:\path\to\labTask\self_practise"

:: Exclude the batch file from being added
set BATCH_FILE=%~f0

:: Pull the latest changes from the repository
git pull origin main --rebase

:: Add all files except the batch file
git ls-files --exclude-standard -o | findstr /v /i "%BATCH_FILE%" > temp_files.txt
git add --all
for /f "delims=" %%i in (temp_files.txt) do git add "%%i"

:: Commit the changes with the current date and time
git commit -m "Auto commit - %date% %time%"

:: Push the changes to the remote repository
git push origin main

:: Clean up temporary file
del temp_files.txt
