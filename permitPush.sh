#!bin/bash
#
#Description:
#Pushes commited changes and gives appropriate permissions to newly created files

echo Pushing Changes
echo -----------------------
git push
echo -----------------------
echo Pulling from Repository
echo -----------------------
git pull
echo -----------------------
echo Giving Permissions
echo -----------------------
bash permit.sh
exit 0
