echo "Enter your repository_name"
read repository_name
git add .
git commit -m"${repository_name}"
if [ -n "$(git status - porcelain)" ];
then
 echo "IT IS CLEAN"
else
 git status
 echo "Pushing data to remote server!!!"
 git push -u origin master
fi