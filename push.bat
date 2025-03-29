@echo off
cd /d "C:\path\to\labTask\self_practise"
git pull origin main --rebase
git add --all
git commit -m "Auto commit - %date% %time%"
git push origin main
