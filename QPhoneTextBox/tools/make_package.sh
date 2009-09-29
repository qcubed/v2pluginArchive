#! /bin/bash

#Copy current source to create the release
cp -r ../source ../releases/
cd ../releases/source

#Remove them all at once
find ./ -name .svn -print0 | xargs -0 rm -rf

#Creating zip archive
echo "Creating a zip archive.."
#Format date
date=`date +%Y-%m-%d`
#Package variables
version=`cat install.php  | grep "strVersion" | grep -oE '[0-9].[0-9]'`
platform=`cat install.php  | grep "strPlatformVersion" | grep -oE '[0-9].[0-9]'`
package=`cat install.php  | grep "strName" | grep -oE '\"[A-Za-z]*\"' | tr -s '"' '\0'`

filename=$package"_"$version"_"$platform"_"$date".zip"

zip -rq ../$filename ./*
cd ..

rm -Rf source

echo ""
echo "All done, saved as $filename"
echo ""
read
