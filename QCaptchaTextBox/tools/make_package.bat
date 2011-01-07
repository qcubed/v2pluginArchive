@echo off
@REM from http://www.tech-recipes.com/rx/956/windows-batch-file-bat-to-get-current-date-in-mmddyyyy-format/
@REM Sets up the %date variable
@REM First parses month, day, and year into mm , dd, yyyy formats and then combines to be YYYY_MM_DD

FOR /F "TOKENS=1* DELIMS= " %%A IN ('DATE/T') DO SET CDATE=%%B
FOR /F "TOKENS=1,2 eol=/ DELIMS=/ " %%A IN ('DATE/T') DO SET mm=%%B
FOR /F "TOKENS=1,2 DELIMS=/ eol=/" %%A IN ('echo %CDATE%') DO SET dd=%%B
FOR /F "TOKENS=2,3 DELIMS=/ " %%A IN ('echo %CDATE%') DO SET yyyy=%%B
SET date=%yyyy%_%mm%_%dd%

cp -r ../source ../releases
cd ../releases/source

echo Deleting .svn files from the re-distributable..
for /f "tokens=* delims=" %%i in ('dir /s /b /a:d *svn') do (
rd /s /q "%%i"
)

echo Creating a zip archive..
SET filename=%date%.zip
zip -q -r %filename% *
mv %filename% ../
cd ..

echo Cleaning up..
rm -rf source

echo.
echo All done, saved as %filename%
echo.
pause